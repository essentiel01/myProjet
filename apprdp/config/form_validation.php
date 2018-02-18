<?php
/**
 * tableau associatif de définition des règles devalidation des formulaires. letableau $config contient d'autres tableaux dont les clés représentent le nom du controller / nom de la la méthode qui doit utiliser ces règles de validations. Avec ce système les règles de validation sont automatiquement exécutées lorsque la méthode et le controller correspondant à la clé qui leur ai associée sont appelés.

 */
$config = array(
	'userregister/register' => array(
		array(
			'field' => 'firstName',
			'label'	=> 'Prénom',
			'rules'	=> 'required'
		),
		array(
			'field' => 'lastName',
			'label'	=> 'Nom',
			'rules'	=> 'required'
		),
		array(
			'field' => 'login',
			'label'	=> 'Identifiant',
			'rules'	=> 'required|is_unique[users.userLogin]'
		),
		array(
			'field' => 'email',
			'label'	=> 'Email',
			'rules'	=> 'required|valid_email|is_unique[users.userEmail]'
		),
		array(
			'field' => 'password',
			'label'	=> 'Mot de passe',
			'rules'	=> 'required|min_length[8]|max_length[20]'
		),
		array(
			'field' => 'passconf',
			'label'	=> 'Confirmer le mot de passe',
			'rules'	=> 'required|min_length[8]|max_length[20]|matches[password]'
		),
		array(
			'field' => 'country',
			'label'	=> 'Pays',
			'rules'	=> 'required'
		)
	)
);
 ?>
