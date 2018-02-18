<?php
class Posts_model extends CI_Model {



        public function __construct()
        {
                $this->load->database();
        }

		/**
		 * selectionne tous les articles dela table posts et qui appartiennent à la rubrique Culture
		 * @param Array $params tableau associatif contenant les différentes clauses de la requête
		 * @return Objet   objet  représentant la requête non exécutée
		 */
		public function get_posts(Array $params)
		{
			$query = $this->db->select($params['select'])
					->from($params['from'])
					->join($params['join1'], $params['on1'], $params['inner1'])
					->join($params['join2'], $params['on2'], $params['inner2'])
					->join($params['join3'], $params['on3'], $params['inner3'])
					->where($params['where'])
					->limit($params['limit'], $params['offset'])
					->order_by($params['order'])
					->get();
			  return $query;
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
		 * @param String $tableName le nom de la table sur laquelle la requête est exécutée
		 * @return Integer le nombre de résultat renvoyé par la requête
		*/
		public function count_posts(Array $params, String $tableName)
		{
			$this->db->join($params['join1'], $params['on1'], $params['inner1']);
			$this->db->where($params['where']);

			return count($this->db->get($tableName)->result());
		}

		/**
		 * Insère un nouvel enregistrement dans une table
		 * @param  String $tableName nom de la table
		 * @param Array   $params tableau associatif contenant les données à enregistrer
		 */
		public function saveNew(String $tableName, Array $params)
		{
			foreach ($params as $key => $value) {
				$this->db->set($key, $value);
			}
			$this->db->insert($tableName);
		}






}
