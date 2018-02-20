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
		public function saveNew(String $tableName, Array $params)
		{
			foreach ($params as $key => $value) {
				$this->db->set($key, $value);
			}
			$this->db->insert($tableName);
		}


		/**
		 * Vérifie les donnéesentréespar l'utilisateur lors de la connexion et renvoie les données de l'utilisateur (en cas de succès) ou une erreur (en cas d'échec)
		 * @param  Array  $params tableau associatif contenant la clause where pour la recherche de l'email, le mot de passe saisi par l'utilisateur dans le formulaire de connexion et le nom de la table sur laquelle la requête est exécutée
		 * @return String/Object         un objet contenant les infos de l'utilisateur en cas de succès ou une chaîne de caractère représentant le message d'erreur en cas d'échec
		 */
		public function userAuthentificate(Array $params)
		{
			//requête sql. sélectionne toutes les infos correspondant à l'utilisateur l'email est saisi
			$sql = $this->db->where($params['where1'])
				->get_compiled_select($params['from']);
			//vérifie si le résultat est supérieur ou égal à 1
		 	if($this->db->query($sql)->num_rows() >=1) {
				$hashPassword = $this->db->query($sql)->row()->userPassword; // on récupère le mot de passe hashé déjà stocké dans la base de donnée lors de la création de compte.
				// on vérifie ensuite avec la fonction password_verify() que le mot de passe saisi correspond au hash présent dans la base. si c'est le cas on retourne le résultat de la requête.
				if (password_verify($params['password'], $hashPassword) == TRUE) {
					return $this->db->query($sql)->row();
				} else { //on informe l'utilisateur que le mot de passe qu'il a saisi est incorrecte.
					return 'Mot de passe incorrecte. Veuilez réessayer.';
				}
			} else { // si la requête retourne 0 résultat, ça veut dire que l'adresse email saisie n'a pas été trouvé dans la base  de données et dans ce cas on informe l'utilisateur que l'email est incorrecte.
				return 'Adresse email incorrecte. Veuilez réessayer.';
			}

		}





}
