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
		public function getPosts(Array $params)
		{
			$sql = $this->db->select($params['select'])
								->from($params['from'])
								->join($params['join1'], $params['on1'], $params['inner1'])
								->join($params['join2'], $params['on2'], $params['inner2'])
								->join($params['join3'], $params['on3'], $params['inner3'])
								->where($params['where'])
								->limit($params['limit'], $params['offset'])
								->order_by($params['order'])
								->get_compiled_select();
			  return $this->db->query($sql);
		}

		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		public function get_single_post(Array $params)
		{
			$query = $this->db->select($params['select'])
								->from($params['from'])
								->join($params['join1'], $params['on1'], $params['inner1'])
								->join($params['join2'], $params['on2'], $params['inner2'])
								->join($params['join3'], $params['on3'], $params['inner3'])
								->where($params['where'])
								->get();
			return  $query;
		}

		/**
		 * sélectionne la dernière chronique de la rubrique
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @return Objet [objet pdo représentant
		 */
		public function get_chronic(Array $params)
		{
			$query = $this->db->join($params['join1'], $params['on1'], $params['inner1'])
						->join($params['join2'], $params['on2'], $params['inner2'])
						->join($params['join3'], $params['on3'], $params['inner3'])
						->where($params['where'])
						->limit($params['limit'])
						->order_by($params['order'])
						->get($params['from']);
			return $query;
		}

		/**
		 * compte le nombre de lignes retourné par la requête
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête sql
		 * @param String $table le nom de la table sur laquelle la requête est exécutée
		 * @return Integer le nombre de résultat renvoyé par la requête
		*/
		public function countPosts(String $table, Array $params)
		{
			$sql = $this->db->join($params['join1'], $params['on1'], $params['inner1'])
								->where($params['where'])
								->get_compiled_select($table);

			return $this->db->query($sql)->num_rows();
		}

		/**
		 * Compte le nombre de ligne retourné par la requête
		 * @param  String $table  nom dela table
		 * @param  Array  $params paramêtres de la requête sql
		 * @return Int         nombre de resultat retourné par la requête
		 */
		public function countFavorites(String $table, Array $params)
		{
			$sql = $this->db->where($params['where'])
					->get_compiled_select($table);
			return $this->db->query($sql)->num_rows();
		}

		/**
		 * Insère un nouvel enregistrement dans une table
		 * @param  String $table nom de la table
		 * @param Array   $params tableau associatif contenant les données à enregistrer
		 */
		public function saveNew(String $table, Array $params)
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
		public function addFavorite(String $table, Array $params)
		{
			$sql = $this->db->where($params)
					->get_compiled_select($table);
			if ($this->db->query($sql)->num_rows() == 0) {
				$this->db->insert($table, $params);
			}
		}

		/**
		 * Selectionne toutes les revues favoris pour un utilisateur donné.
		 * @param  String $table nom de la table
		 * @param  Array  $params    paramètres de la requête
		 * @return Objet            un objet
		 */
		public function getFavorites(String $table, Array $params)
		{
			$sql = $this->db->select($params['select'])
							->join($params['join1'], $params['on1'], $params['inner1'])
							->join($params['join2'], $params['on2'], $params['inner2'])
							->join($params['join3'], $params['on3'], $params['inner3'])
							->where($params['where'])
							->get_compiled_select($table);
			return	$this->db->query($sql);

		}


		/**
		 * Selectionne tous les postId de la table posts_favorites pour un utilisateur donné.
		 * @param  String $table nom de la table
		 * @param  Array  $params    paramêtres de la requête sql
		 * @return Objet            un objet
		 */
		public function getPostIdFromFavorites(String $table, Array $params)
		{
			$sql = $this->db->select($params['select'])
							->where($params['where'])
						->get_compiled_select($table);
			return $this->db->query($sql);
		}

		/**
		 * Supprime de la table un enregistrement
		 * @param  String $table  nom de la table
		 * @param  Array  $params paramètres de la requête sql
		 */
		public function deleteFavorite(String $table, Array $params)
		{
			$this->db->delete($table, $params);
		}

		/**
		 * selectione les commentaires parents
		 * @param  String $table  nom de la table
		 * @param  Array  $params paramètres de la requête sql
		 * @return Objet         [description]
		 */
		public function getComments(String $table, Array $params)
		{
			$sql = $this->db->select($params['select'])
							->join($params['join1'], $params['on1'], $params['inner1'])
							->where($params['where'])
							->order_by($params['order'])
							->get_compiled_select($table);
							//die($sql);

			return $this->db->query($sql);
		}

		/**
		 * sélectionne les réponses des commentaires
		 * @param  String $table           nom de la table
		 * @param  Array  $params          paramètre de la requête sql
		 * @param  Int    $parentCommentId l'id du commentaire parent
		 * @return Objet                  [description]
		 */
		public function getCommentsReply(String $table, Array $params, Int $parentCommentId)
		{
			$sql = $this->db->select($params['select'])
							->join($params['join1'], $params['on1'], $params['inner1'])
							->where(array('parentCommentId' => $parentCommentId))
							->order_by($params['order'])
							->get_compiled_select($table);
			//die($sql);
			return $this->db->query($sql);
		}

}
