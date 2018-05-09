<?php
class Posts_model extends CI_Model {


        public function __construct()
        {
			parent::__construct();
			$this->load->database();
        }


		/**
		 * sélectionne les revues de presses par catégorie
		 * @param  [type] $where le nom de la catégorie
		 * @param  [type] $limit  le nombre de résultt à renvoyer
		 * @param  [type] $offset offset
		 * @return [type]         [description]
		 */
		public function getPosts($where, $limit = NULL, $offset = NULL)
		{
			$sql =
						$this->db->select( 'postId, postTitle, postSlug, postAudio, countryName, categoryName, postDate, writerFirstName, writerLastName, writerAvatar' )
						->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
						->join('countries', 'countries.countryId = posts.postCountry', 'inner')
						->join('writers', 'writers.writerId = posts.postWriter', 'inner')
						->where(array('categoryName' => $where))
						->order_by('postDate DESC')
						->get("posts", $limit, $offset);
			return $sql;
		}
		/**
		 * sélectionne les dernières revues de presses
		 * @param  [type] $limit le nombre de résultat
		 * @return [type]        [description]
		 */
		public function recentPosts($limit)
		{
			$sql = $this->db->select('postId, postTitle, postSlug,  categoryName')
							->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
							->order_by('postDate DESC')
							->limit($limit)
							->get("posts");
			return $sql;
		}

		/**
		 * sélectinne les analyses des experts
		 * @param  [type] $limit le nombre de resultat à renvoyer
		 * @return [type]        [description]
		 */
		public function decodageActu($limit)
		{
			$sql = $this->db->where('posted = 1')
									->order_by('postedAt DESC')
									->get('decodage_actu', $limit);
			return $sql;
		}

		public function getOneActu($slug)
		{
			return $this->db->get_where("decodage_actu", array("slug" => $slug));
		}

		/**
		 * sélectionne tous les articles d'une table et les classe par date de publication décroissante
		 * @param  Array  $params paramètre de la requête sql
		 * @param  String $table  nom de la table cible de la requête
		 * @return Objet         [description]
		 */
		// public function getArchives(Array $params, String $table)
		// {
		// 	$sql = $this->db->select($params['select'])
		// 					->join($params['join1'], $params['on1'], $params['inner1'])
		// 					->join($params['join2'], $params['on2'], $params['inner2'])
		// 					->join($params['join3'], $params['on3'], $params['inner3'])
		// 					->order_by($params['order'])
		// 					->get($table);
		// 	return $sql;
		// }

		public function getArchives($table, $type, $limit=NULL, $offset=NULL)
		{
			$sql =
						$this->db->select($type.'Id, ' . $type.'Title, ' . $type.'Slug, countryName, categoryName, ' . $type.'Date,  writerFirstName, writerLastName')
						->join('categories',  'categories.categoryId =' . $type.'s.' . $type.'Category', 'inner')
						->join('countries', 'countries.countryId =' . $type.'s.' . $type.'Country', 'inner')
						->join('writers', 'writers.writerId =' . $type.'s.'. $type.'Writer', 'inner')
						->order_by($type.'Date  DESC')
						->get($table, $limit, $offset);
					return $sql;
		}


		/**
		 * permet de selectionner les infos de chaque slide
		 * @param  String $table nom de la table
		 * @return Objet        [description]
		 */
		public function getCarousel()
		{
			$sql = $this->db->get('carousel');
			return $sql;
		}


		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		// public function getSinglePost(Array $params, string $table)
		// {
		// 	$query = $this->db->select($params['select'])
		// 						->join($params['join1'], $params['on1'], $params['inner1'])
		// 						->join($params['join2'], $params['on2'], $params['inner2'])
		// 						->join($params['join3'], $params['on3'], $params['inner3'])
		// 						->where($params['where'])
		// 						->get($table);
		// 	return  $query;
		// }

		public function getOnePost($slug)
		{
			$sql =
						$this->db->select( 'postId, postTitle, postSlug, postContent, postSource, postAudio, 	 countryName, categoryName, postDate, writerFirstName, writerLastName, writerAvatar' )
						->join('categories', 'categories.categoryId = posts.postCategory', 'inner')
						->join('countries', 'countries.countryId = posts.postCountry', 'inner')
						->join('writers', 'writers.writerId = posts.postWriter', 'inner')
						->where(array('postSlug' => $slug))
						->get("posts");
			return $sql;
		}

		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		// public function getChronic(Array $params, string $table)
		// {
		// 	$query = $this->db->join($params['join1'], $params['on1'], $params['inner1'])
		// 				->join($params['join2'], $params['on2'], $params['inner2'])
		// 				->join($params['join3'], $params['on3'], $params['inner3'])
		// 				->where($params['where'])
		// 				->limit($params['limit'])
		// 				->order_by($params['order'])
		// 				->get($table);
		// 	return $query;
		// }
		public function getOneChronic($where)
		{
			$sql = $this->db->select( 'chronicId, chronicTitle, chronicSlug, chronicContent, countryName, categoryName, chronicDate, writerFirstName, writerLastName, writerAvatar' )
			->join('categories', 'categories.categoryId = chronics.chronicCategory', 'inner')
			->join('countries', 'countries.countryId = chronics.chronicCountry', 'inner')
			->join('writers', 'writers.writerId = chronics.chronicWriter', 'inner')
			->where($where)
			->limit(1)
			->order_by('chronicDate DESC')
			->get("chronics");
			return $sql;
		}

		/**
		 * selectionne la description de tous les débats qui sont publiés
		 * @param  [type] $limit  [description]
		 * @param  [type] $offset [description]
		 * @return [type]         [description]
		 */
		public function getDebatsInfos($limit=NULL, $offset=NULL)
		{
			$sql =
				$this->db->select('id, title, slug, description, person_1, person_2, avatar_1, avatar_2, posted_at')
				//->join('questions_answers', 'debat.id = questions_answers.debat_id', 'inner')
				->where(array('posted' => 1))
				->order_by('posted_at DESC')
				->get('debat', $limit, $offset);
			return $sql;
		}

		public function getOneDebatInfos($slug)
		{
			$sql =
				$this->db->select('id, title, description, posted_at')
				->where(array('slug' => $slug))
				->get('debat');
			return $sql;
		}
		/**
		 * selectionne tout le contenu d'un débat précis
		 * @param  [type] $slug [description]
		 * @return [type]       [description]
		 */
		public function getOneDebatContent($slug)
		{
			$sql =
				$this->db->select('person_1, person_2, avatar_1, avatar_2, question, answer_1, answer_2')
				->join('questions_answers', 'debat.id = questions_answers.debat_id', 'inner')
				->where(array('slug' => $slug))
				->get('debat');
			return $sql;
		}
		/**
		 * compte le nombre de lignes retourné par la requête
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @param String $table le nom de la table sur laquelle la requête est exécutée
		 * @return Integer le nombre de résultat renvoyé par la requête
		*/
		// public function countPosts(Array $params, String $table)
		// {
		// 	$sql = $this->db->join($params['join1'], $params['on1'], $params['inner1'])
		// 					->where($params['where'])
		// 					->get_compiled_select($table);
		//
		// 	return $this->db->query($sql)->num_rows();
		// }

		/**
		 * Compte le nombre de ligne retourné par la requête
		 * @param  String $table  nom dela table
		 * @param  Array  $params paramêtres de la requête sql
		 * @return Int         nombre de resultat retourné par la requête
		 */
		public function countFavorites(Array $params, String $table):int
		{
			$sql = $this->db->where($params['where'])
							->get($table);
			return $sql->num_rows();
		}

		/**
		 * Insère un nouvel enregistrement dans une table
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
		 * Insère une revue dans la table posts_favoris
		 * @param String $table Nom de la table
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
		 * Selectionne toutes les revues favoris pour un utilisateur donné.
		 * @param  Array  $params    paramètres de la requête
		 * @param  String $table nom de la table
		 * @return Objet            un objet
		 */
		// public function getFavorites(Array $params, String $table)
		// {
		// 	$sql = $this->db->select($params['select'])
		// 					->join($params['join1'], $params['on1'], $params['inner1'])
		// 					->join($params['join2'], $params['on2'], $params['inner2'])
		// 					->join($params['join3'], $params['on3'], $params['inner3'])
		// 					->where($params['where'])
		// 					->get_compiled_select($table);
		// 	return	$this->db->query($sql);
		//
		// }


		/**
		 * Selectionne tous les postId de la table posts_favorites pour un utilisateur donné.
		 * @param  Array  $params    paramêtres de la requête sql
		 * @param  String $table nom de la table
		 * @return Objet            un objet
		 */
		public function getPostIdFromFavorites($id)
		{
			$sql = $this->db->select ('postId')
							->where(array('userId' => $id))
							->get("posts_favorites");
			return $sql;
		}
		/**
		 * selectionne les chronic favoris
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function getChronicIdFromFavorites($id)
		{
			$sql = $this->db->select ('chronicId')
							->where(array('userId' => $id))
							->get("chronics_favorites");
			return $sql;
		}

		/**
		 * Supprime un favoris
		 * @param  Array  $params paramètres de la requête sql
		 * @param  String $table  nom de la table
		 */
		public function deleteFavorite(Array $params, String $table)
		{
			$this->db->delete($table, $params);
		}

		/**
		 * selectione les commentaires parents
		 * @param  Array  $params paramètres de la requête sql
		 * @param  String $table  nom de la table
		 * @return Objet         [description]
		 */
		// public function getComments(Array $params, String $table, int $limit=null, int $offset=null)
		// {
		// 	$sql = $this->db->select($params['select'])
		// 					->join($params['join1'], $params['on1'], $params['inner1'])
		// 					->where($params['where'])
		// 					->order_by($params['order'])
		// 					->limit($limit, $offset)
		// 					->get($table);
		// 					//die($sql);
		// 	return $sql;
		// }
		/**
		 * selectionne les commentaires des revues de presse
		 * @param  [type] $id     [description]
		 * @param  [type] $limit  [description]
		 * @param  [type] $offset [description]
		 * @return [type]         [description]
		 */
		public function getPostsComments($id, $limit = NULL, $offset = NULL)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'posts_comments.userId = users.userId', 'inner')
						->where(array('postId' => $id))
						->order_by('commentDate DESC')
						->limit($limit, $offset)
						->get("posts_comments");
				return $sql;
		}
		/**
		 * selectionne les commentaires des chroniques
		 * @param  [type] $id     [description]
		 * @param  [type] $limit  [description]
		 * @param  [type] $offset [description]
		 * @return [type]         [description]
		 */
		public function getChronicsComments($id, $limit = NULL, $offset = NULL)
		{
			$sql =
						$this->db->select( 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar')
						->join('users', 'chronics_comments.userId = users.userId', 'inner')
						->where(array('chronicId' => $id))
						->order_by('commentDate DESC')
						->limit($limit, $offset)
						->get("chronics_comments");
				return $sql;
		}

		public function getHome(String $title)
		{
			return  $this->db->get_where("home", array("title"=>$title));
		}
		/**
		 * sélectionne les réponses des commentaires
		 * @param  Array  $params          paramètre de la requête sql
		 * @param  String $table           nom de la table
		 * @param  Int    $parentCommentId l'id du commentaire parent
		 * @return Objet                  [description]
		 */
		// public function getCommentsReply(Array $params, String $table, Int $parentCommentId)
		// {
		// 	$sql = $this->db->select($params['select'])
		// 					->join($params['join1'], $params['on1'], $params['inner1'])
		// 					->where(array('parentCommentId' => $parentCommentId))
		// 					->order_by($params['order'])
		// 					->get($table);
		// 	//die($sql);
		// 	return $sql;
		// }

}
