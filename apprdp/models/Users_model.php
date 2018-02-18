<?php
class Users_model extends CI_Model {



        public function __construct()
        {
                $this->load->database();
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
