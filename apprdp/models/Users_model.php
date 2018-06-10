<?php
class Users_model extends CI_Model {



        public function __construct()
        {
			parent::__construct();
			$this->load->database();
        }


		/**
		 * Insère un nouvel utilisateur dans une table users
		 * @param  String $tableName nom de la table
		 * @param Array   $params tableau associatif contenant les données à enregistrer
		 */
		public function saveNew( $table, $params)
		{
			foreach ($params as $key => $value) {
				$this->db->set($key, $value);
			}
			return $this->db->insert($table);
		}


		/**
		 * requête de mise à jour des infos de l'utilisateur
		 * @param  string $table  [description]
		 * @param  array  $params [description]
		 * @param  [type] $where  [description]
		 * @return [type]         [description]
		 */
		public function updateData( $table,  $params, $where)
		{
			$this->db->update($table, $params, $where);
		}

		/**
		 * selectionne un utilisateur
		 * @param  string $table nom de la table
		 * @param  array  $id    tableau associatif contenant le nom du champ comme clé et sa valeur
		 * @return [type]        un objet DB_CI
		 */
		public function getUser(string $table, $where)
		{
			return $this->db->get_where($table, $where);
		}

		/**
		 * Vérifie les donnéesentréespar l'utilisateur lors de la connexion et renvoie les données de l'utilisateur (en cas de succès) ou une erreur (en cas d'échec)
		 * @param  Array  $params tableau associatif contenant la clause where pour la recherche de l'email, le mot de passe saisi par l'utilisateur dans le formulaire de connexion et le nom de la table sur laquelle la requête est exécutée
		 * @return String/Object         un objet contenant les infos de l'utilisateur en cas de succès ou une chaîne de caractère représentant le message d'erreur en cas d'échec
		 */
		public function userExist(Array $params)
		{
			//requête sql. sélectionne toutes les infos correspondant à l'utilisateur l'email est saisi
			$sql = $this->db->where($params['where1'])
							->get('users');

			//vérifie si le résultat est supérieur ou égal à 1
		 	if ($sql->result() != null)
			{
				foreach ($sql->result() as $row)
				{
					$hash = $row->userPassword; //on recupère le password hashé
				}

				if (password_verify($params['password'], $hash) == TRUE)
				{
					return $sql;
				}
			}
		}

		/**
		 * supprime un utlisateur
		 * @param  String $table [description]
		 * @param  Int    $id    [description]
		 * @return [type]        [description]
		 */
		public function deleteUser($table, $id)
		{
			return $this->db->delete($table, $id);
		}



		/**
		 * selectionne tous les partners
		 * @return [type] [description]
		 */
		public function getPartners()
		{
			return $this->db->get("partners");
		}


}
