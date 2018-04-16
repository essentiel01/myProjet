<?php
class Posts_model extends CI_Model {


        public function __construct()
        {
			parent::__construct();
			$this->load->database();
        }

		/**
		 * selectionne tous les articles dela table posts et qui appartiennent à la rubrique Culture
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête
		 * @return Objet   objet  représentant la requête non exécutée
		 */
		public function getPosts(Array $params, $table, $limit = NULL, $offset=NULL)
		{
			$this->db->select($params['select']);
			$this->db->join($params['join1'], $params['on1'], $params['inner1']);
			$this->db->join($params['join2'], $params['on2'], $params['inner2']);
			$this->db->join($params['join3'], $params['on3'], $params['inner3']);
			$this->db->where($params['where']);
			$this->db->order_by($params['order']);
			return $this->db->get($table, $limit, $offset);
		}
		/**
		 * sélectionne tous les articles d'une table et les classe par date de publication décroissante
		 * @param  Array  $params paramètre de la requête sql
		 * @param  String $table  nom de la table cible de la requête
		 * @return Objet         [description]
		 */
		public function getArchives(Array $params, String $table)
		{
			$sql = $this->db->select($params['select'])
							->join($params['join1'], $params['on1'], $params['inner1'])
							->join($params['join2'], $params['on2'], $params['inner2'])
							->join($params['join3'], $params['on3'], $params['inner3'])
							->order_by($params['order'])
							->get($table);
			return $sql;
		}


		/**
		 * permet de selectionner les infos de chaque slide
		 * @param  String $table nom de la table
		 * @return Objet        [description]
		 */
		public function getCarousel(String $table)
		{
			$sql = $this->db->get($table);
			return $sql;
		}


		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		public function getSinglePost(Array $params, string $table)
		{
			$query = $this->db->select($params['select'])
								->join($params['join1'], $params['on1'], $params['inner1'])
								->join($params['join2'], $params['on2'], $params['inner2'])
								->join($params['join3'], $params['on3'], $params['inner3'])
								->where($params['where'])
								->get($table);
			return  $query;
		}

		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		public function getChronic(Array $params, string $table)
		{
			$query = $this->db->join($params['join1'], $params['on1'], $params['inner1'])
						->join($params['join2'], $params['on2'], $params['inner2'])
						->join($params['join3'], $params['on3'], $params['inner3'])
						->where($params['where'])
						->limit($params['limit'])
						->order_by($params['order'])
						->get($table);
			return $query;
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
		public function getPostIdFromFavorites(Array $params, String $table)
		{
			$sql = $this->db->select($params['select'])
							->where($params['where'])
						->get_compiled_select($table);
			return $this->db->query($sql);
		}

		/**
		 * Supprime de la table un enregistrement
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
		public function getComments(Array $params, String $table, int $limit=null, int $offset=null)
		{
			$sql = $this->db->select($params['select'])
							->join($params['join1'], $params['on1'], $params['inner1'])
							->where($params['where'])
							->order_by($params['order'])
							->limit($limit, $offset)
							->get($table);
							//die($sql);

			return $sql;
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
