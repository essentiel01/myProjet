<?php
/**
 *
 */
class UsersLog extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('url');
		$this->load->library(array('form_validation', 'session'));
	}

	public function index()
	{
		$data['login'] = array(
			'headerTitle' => 'Connexion espace personnel'
		);
		$this->load->view('templates/header', $data['login']);
		$this->load->view('userslog/loginView');
		$this->load->view('templates/footer');
	}

	public function logIn()
	{

		//les règles de validation sont stockées dans le dossier apprdp/config/form_validation.php. le chemin controller/method est utilisé comme clé des règles de validation ce qui permet de les charger automatiquement quand la methode correspondante est appelée sans être obligé de préciser àla méthode run() les règles à vérifier.
		if($this->form_validation->run() == FALSE) {
			// si toutes les rules ne sont pas validés on réaffiche le formulaire en l'hydratant avec les valeurs correctes et en laissant vide les champs incorrect et les mots de passe

			//variables à transmettre à la vue
			$data['registerError'] = array(
				'headerTitle' => 'Données incorrectes / formulaire de connexion'
			);

			//chargement des vues
			$this->load->view('templates/header', $data['registerError']);
			$this->load->view('userslog/loginView');

		} else {
			// tableau des données à enregistrer
			$queryParams = array(
				'from' => 'users',
				'where1' => array('userEmail' => $_POST['email']),
				'password' => $_POST['password']
			);

			$result = $this->users_model->userAuthentificate($queryParams);
			//var_dump($result);
				//var_dump($_SESSION);
			if (is_array($result)) {
				$_SESSION['userData'] = $result;
			}else {
				echo $result;
			}

		}
	}
}

 ?>
