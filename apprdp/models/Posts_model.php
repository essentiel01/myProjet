<?php
class Posts_model extends CI_Model {


        public function __construct()
        {
			parent::__construct();
			$this->load->database();
        }


		/**
		 * sélectionne les revues de presses publiée en fonction de la catégorie spécifiée en paramètre. Si $posted vaut 0 la requête renverra toutes les revues de presse non encore publiée en fonctionde la catégories spécifiée en paramètre
		 * @param  String $category le nom de la catégorie
		 * @param  Int $limit  le nombre d'enregistrement à renvoyer
		 * @param  Boolean $posted  defini si la revue est publiée ou non
		 * @param  [type] $offset offset
		 * @return Objet             une instance  de CI_DB
		 */
		public function getPosts($category, $limit = NULL, $offset = NULL, $posted = 1)
		{
			$sql =
						$this->db->select( 'postId, postTitle, postSlug, image, postContent, postAudio, countryName, categoryName, postDate, userFirstName, userLastName, userAvatar' )
						->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
						->join('countries', 'countries.countryId = posts.postCountry', 'inner')
						->join('users', 'users.userId = posts.user_id', 'inner')
						->where(array('categoryName' => $category, 'posted' => $posted))
						->order_by('postDate DESC')
						->get("posts", $limit, $offset);
			return $sql;
		}

		/**
		 * sélectionne les dernières revues de presses pubiées sur le site et renvoie le nombre de résultat spécifié en paramètre classé par ordre du plus récent au plus ancien. Si $posted vaut 0 alors la requête renverra les récentes revues d presse non encore publiées.
		 * @param  Int $limit le nombre d'enregistrement retourné
		 * @param  Boolean $posted defini si la revue est publiée ou non
		 * @return Objet             une instance  de CI_DB
		 */
		public function recentPosts($limit, $posted = 1)
		{
			$sql = $this->db->select('postId, postTitle, postSlug,  categoryName')
							->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
							->where(array('posted' => $posted))
							->order_by('postDate DESC')
							->limit($limit)
							->get("posts");
			return $sql;
		}

		/**
		 * sélectinne toutes les analyses de l'actualité et renvoie le nombre de résultat passé en paramètre
		 * @param  Int $limit le nombre de resultat à renvoyer
		 *  @return Objet             une instance  de CI_DB
		 */
		public function getDecodageActus($limit)
		{
			$sql = $this->db->select('id, title, slug, content, createdAt, updatedAt, postedAt, userId, userFirstName, userLastName')
						->join('users', 'users.userId = decodage_actu.user_id', 'inner')
						->where('posted = 1')
						->order_by('postedAt DESC')
						->get('decodage_actu', $limit);
			return $sql;
		}

		/**
		 * sélectionne  l'analyse de l'actualité dont le slug est passéen paramètre
		 * @param  String $slug slug de l'analyse
		 * @return Objet             une instance  de CI_DB
		 */
		public function getOneActu($slug)
		{
			$sql = $this->db->select('id, title, slug, content, createdAt, updatedAt, postedAt, userId, userFirstName, userLastName')
						->join('users', 'users.userId = decodage_actu.user_id', 'inner')
						->where(array("slug" => $slug))
						->get("decodage_actu");
			return $sql;
		}


		/**
		 * selectionne toutes les revues de presse et chroniques présente sur le site
		 * @param  String $table  nom de la table
		 * @param  String $type   le type d'élément à sélectionner (chronique ou revue de presse)
		 * @param  Int $limit  le nombre d'éléments retourné par la requête
		 * @param  Int $offset [description]
		 * @return Objet             une instance  de CI_DB
		 */
		public function getArchives($table, $type, $limit=NULL, $offset=NULL)
		{
			$sql =
						$this->db->select($type.'Id, ' . $type.'Title, ' . $type.'Audio, '. $type.'Slug, countryName, categoryName, ' . $type.'Date,  userFirstName, userLastName')
						->join('categories',  'categories.categoryId =' . $type.'s.' . $type.'Category', 'inner')
						->join('countries', 'countries.countryId =' . $type.'s.' . $type.'Country', 'inner')
						->join('users', 'users.userId =' . $type.'s.'. 'user_id', 'inner')
						->where(array('posted' => 1))
						->order_by($type.'Date  DESC')
						->get($table, $limit, $offset);
					return $sql;
		}


		/**
		 * selectionner tous les slides
		 * @param  String $table nom de la table
		 * @return Objet             une instance  de CI_DB
		 */
		public function getCarousel()
		{
			$sql = $this->db->get('carousel');
			return $sql;
		}



		/**
		 * selectionne une revue de presse en fonction du slug passé en paramètre
		 * @param  String $slug slug de larevue de presse
		 *@return Objet             une instance  de CI_DB
		 */
		public function getOnePost($slug)
		{
			$sql =
						$this->db->select( 'postId, postTitle, postSlug, image, postContent, postSource, postAudio, 	 countryName, categoryName, postDate, userFirstName, userLastName, userAvatar' )
						->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
						->join('countries', 'countries.countryId = posts.postCountry', 'inner')
						->join('users', 'users.userId = posts.user_id', 'inner')
						->where(array('postSlug' => $slug))
						->get("posts");
			return $sql;
		}

		/**
		 * selectionne une chronique en function des critères passés en paramètre. Si aucune valeur n'est donnée à l'argument $posted le résultat de la requ^te sera une chronique en ligne. Si $posted vaut 0 le résultat sera une chronique hors ligne.
		 * @param  String  $where_key   le nom du champ de a clause where
		 * @param  String  $where_value  la valeur du champ de a clause where
		 * @param  Boolean $posted     défini si la chronique est en ligne ou pas
		 * @return [type]              une instance  de CI_DB
		 */
		public function getOneChronic($where_key, $where_value, $posted = 1)
		{
			$sql = $this->db->select( 'chronicId, chronicTitle, chronicSlug, chronicContent, countryName, categoryName, chronicDate, userFirstName, userLastName, userAvatar' )
						->join('categories', 'categories.categoryId = chronics.chronicCategory', 'inner')
						->join('countries', 'countries.countryId = chronics.chronicCountry', 'inner')
						->join('users', 'users.userId = chronics.user_id', 'inner')
						->where(array($where_key=>$where_value, 'posted' => $posted))
						->limit(1)
						->order_by('chronicDate DESC')
						->get("chronics");
			return $sql;
		}

		/**
		 * selectionne les infos de tous les débats en fonction de son statut (publié ou non). Par défaut tous les débats non publiés sont selectionnés. Si $posted vaut 1 tous les débats en ligne sont sélectionnés.
		 * @param  Int $limit  le nombre d'enregistrement renvoyé par la requête
		 * @param  Int $offset [description]
		 * @param  Boolean $posted défini si le débat est en ligne ou pas
		 * @return Objet             une instance  de CI_DB
		 */
		public function getDebatsInfos($limit=NULL, $offset=NULL, $posted = 0)
		{
			$sql =
				$this->db->select('id, title, slug, description, person_1, person_2, avatar_1, avatar_2, users.created_at, posted_at, userFirstName, userLastName, user_id')
				->join('users', 'users.userId = debats.user_id', 'inner')
				->where(array('posted' => $posted))
				->order_by('posted_at DESC')
				->get('debats', $limit, $offset);
			return $sql;
		}

		/**
		 * selectionne un seul débat en fonction du slug passé en paramètre
		 * @param  String $slug  le slug du débat
		 * @return Objet             une instance  de CI_DB
		 */
		public function getOneDebatInfos($slug)
		{
			$sql =
				$this->db->select('id, title, description, posted_at, userFirstName, userLastName, user_id')
				->join('users', 'users.userId = debats.user_id', 'inner')
				->where(array('slug' => $slug))
				->get('debats');
			return $sql;
		}

		/**
		 * selectionne le contenu du débat dont le slug est passé en paramètre
		 * @param String $slug le slug du débat
		 * @return Objet             une instance  de CI_DB
		 */
		public function getOneDebatContent($slug)
		{
			$sql =
				$this->db->select('person_1, person_2, avatar_1, avatar_2, question, answer_1, answer_2')
				->join('questions_answers', 'debats.id = questions_answers.debat_id', 'inner')
				->where(array('slug' => $slug))
				->get('debats');
			return $sql;
		}

		/**
		 * Compte le nombre d'éléments dans la liste de favoris en fonction des critères passés en paramètre
		 * @param  String $table  nom de la table
		 * @param  Array  $params paramêtres de la requête sql
		 * @return Int         nombre d'enregistrements retourné par la requête
		 */
		public function countFavorites(Array $params, String $table):int
		{
			$sql = $this->db->where($params['where'])
							->get($table);
			return $sql->num_rows();
		}

		/**
		 * Insère un nouvel enregistrement dans la table spécifiée en paramètre
		 * @param  String $table nom de la table
		 * @param Array   $params tableau associatif contenant les données à enregistrer
		 */
		public function saveNew(Array $params, String $table)
		{
			foreach ($params as $key => $value) {
				$this->db->set($key, $value);
			}
			$this->db->insert($table);
		}

		/**
		 * Ajoute un élément  dans la lsite des favoris
		 * @param String $table Nom de la table qui recoit l'enregistrement
		 * @param Array  $params    paramêtres de la requête
		 */
		public function addFavorite(Array $params, String $table)
		{
			$sql = $this->db->where($params)
					->get($table);
			if ($sql->num_rows() == 0) {
				$this->db->insert($table, $params);
			}
		}


		/**
		 * Selectionne tous les Id de la table posts_favorites pour l'utilisateur passé en paramètre
		 * @param  Int  $id    id de l'utilisateur
		 * @return Objet             une instance  de CI_DB
		 */
		public function getPostIdFromFavorites($id)
		{
			$sql = $this->db->select ('postId')
							->where(array('userId' => $id))
							->get("posts_favorites");
			return $sql;
		}

		/**
		 * Sélectionne toutes les revues de presse favoris de l'utilisateur dont l'idest passé en argument.
		 *
		 * @param Int $userId l'id de l'utilisateur connecté
		 *  @return Objet             une instance  de CI_DB
		 */
		public function getPostFavorites($userId, $limit=NULL, $offset=NULL)
		{
			$sql = $this->db->select('posts.postId, postTitle, postSlug, postAudio, countryName, categoryName, postDate')
					->join('posts', 'posts.postId = posts_favorites.postId', 'inner')
					->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
					->join('countries', 'countries.countryId = posts.postCountry', 'inner')
					->where(array('userId' => $userId))
					->limit($limit, $offset)
					->order_by('categoryName')
					->get('posts_favorites');
			return $sql;
		}
		/**
		 * Selectionne tous les Id de la table chronics_favorites pour l'utilisateur passé en paramètre
		 * @param  Int  $id    id de l'utilisateur
		 * @return Objet             une instance  de CI_DB
		 */
		public function getChronicIdFromFavorites($id)
		{
			$sql = $this->db->select ('chronicId')
							->where(array('userId' => $id))
							->get("chronics_favorites");
			return $sql;
		}

		/**
		 * Sélectionne toutes les chroniques favoris de l'utilisateur dont l'idest passé en argument.
		 *
		 * @param Int $userId l'id de l'utilisateur connecté
		 *  @return Objet             une instance  de CI_DB
		 */
		public function getChronicFavorites($userId, $limit=NULL, $offset=NULL)
		{
			$sql = $this->db->select('chronics.chronicId, chronicTitle, chronicSlug, countryName, categoryName, chronicDate')
					->join('chronics', 'chronics.chronicId = chronics_favorites.chronicId', 'inner')
					->join('categories', 'categories.categoryId = chronics.chronicCategory', 'inner')
					->join('countries', 'countries.countryId = chronics.chronicCountry', 'inner')
					->where(array('userId' => $userId))
					->limit($limit, $offset)
					->order_by('categoryName')
					->get('chronics_favorites');
			return $sql;
		}

		/**
		 * Supprime un élément de la liste de favoris en fonction des critères passés en paramètre
		 * @param  Array  $params paramètres de la requête sql
		 * @param  String $table  nom de la table qui contient l'élément à supprimer
		 */
		public function deleteFavorite(Array $params, String $table)
		{
			$this->db->delete($table, $params);
		}


		/**
		 * selectionne les commentaires de la revue de presse dont l'id est passé en paramètre
		 * @param  Int $id     id de la revue de presse
		 * @param  Int $limit  le nombre de commentaires retourné
		 * @param  Int $offset [description]
		 * @return Objet             une instance  de CI_DB
		 */
		public function getPostsComments($id, $limit = NULL, $offset = NULL)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'posts_comments.userId = users.userId', 'inner')
						->where(array('postId' => $id, 'parentCommentId' => 0))
						->order_by('commentDate DESC')
						->limit($limit, $offset)
						->get("posts_comments");
				return $sql;
		}

		/**
		 * sélectionne les réponses des commentaires des revues de presse
		 * @param Int $id l'id de la revue de presse associée au commentaire
		 * @param Int $parentId l'id du commentaire parent
		 * @return Objet             une instance  de CI_DB
		 */
		public function getPostsCommentsChild($id,$parentId)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'posts_comments.userId = users.userId', 'inner')
						->where(array('postId' => $id, 'parentCommentId' => $parentId))
						->order_by('commentDate DESC')
						//->limit($limit, $offset)
						->get("posts_comments");
				return $sql;
		}

		/**
		 * selectionne les commentaires de la chronic dont l'id est passé en paramètre
		 * @param  Int $id     id de la chronique
		 * @param  Int $limit  le nombre de commentaires retourné
		 * @param  Int $offset [description]
		 * @return Objet             une instance  de CI_DB
		 */
		public function getChronicsComments($id, $limit = NULL, $offset = NULL)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'chronics_comments.userId = users.userId', 'inner')
						->where(array('chronicId' => $id, 'parentCommentId' => 0))
						->order_by('commentDate DESC')
						->limit($limit, $offset)
						->get("chronics_comments");
				return $sql;
		}

		/**
		 * sélectionne les réponses des commentaires de chroniques
		 *
		 * @param Int $id l'id de lachronique associée au commentaire
		 * @param Int $parentId l'id du commentaire parent
		 * @return void
		 */
		public function getChronicsCommentsChild($id, $parentId)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'chronics_comments.userId = users.userId', 'inner')
						->where(array('chronicId' => $id, 'parentCommentId' => $parentId))
						->order_by('commentDate DESC')
						->get("chronics_comments");
				return $sql;
		}

		/**
		 * selectionne les éléments de la page d'accueil en fonction du titre passé en paramètre
		 * @param  String $title titre de l'élément
		 * @return Objet             une instance  de CI_DB
		 */
		public function getHome(String $title)
		{
			return  $this->db->get_where("home", array("title"=>$title));
		}


		/**
		 * selectionne toutes les catégories
		 * @return Objet             une instance  de CI_DB
		 */
		public function getCategories()
		{
			return $this->db->get('categories');
		}

		/**
		 * selectionne tous les pays
		 * @return Objet             une instance  de CI_DB
		 */
		public function getCountries()
		{
			return $this->db->get('countries');
		}

		/**
		 * selectionne toutes les images de la table images
		 * @return Objet             une instance  de CI_DB
		 */
		public function getImages()
		{
			return $this->db->get('images');
		}

		/**
		 * selectionne une image dans la galerie en foncton du critère passé en paramètre
		 * @param  [type] $where critère de selection
		 * @return Objet             une instance  de CI_DB
		 */
		public function getOneImage($where)
		{
			return $this->db->get_where('images', $where);
		}

		/**
		 * selectionne tous les audios dans la table audios
		 * @return Objet             une instance  de CI_DB
		 */
		public function getAudios()
		{
			return $this->db->get('audios');
		}



}
