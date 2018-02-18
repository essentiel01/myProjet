<?php
/**
 *
 */
class UserRegister extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	/**
	 * affiche le formulaire d'inscription
 	*/
	public function index()
	{
		//variables à transmettre à la vue
		$data['register'] = array(
			'headerTitle' => 'formulaire d\'inscription'
		);
		//chargement des vues
		$this->load->view('templates/header', $data['register']);
		$this->load->view('usersRegister/registerFormView');
		$this->load->view('templates/footer');
	}


	/**
	 * valide les données du formulaire et les enregistre dans la table correspondante si la validation est correcte sinon le formulaire est réaffiché.
	 * @return [type] [description]
	 */
	public function register()
	{

		//les règles de validation sont stockées dans le dossier apprdp/config/form_validation.php. le chemin controller/method est utilisé comme clé des règles de validation ce qui permet de les charger automatiquement quand la methode correspondante est appelée sans être obligé de préciser àla méthode run() les règles à vérifier.
		if($this->form_validation->run() == FALSE) {
			// si toutes les rules ne sont pas validés on réaffiche le formulaire en l'hydratant avec les valeurs correctes et en laissant vide les champs incorrect et les mots de passe

			//variables à transmettre à la vue
			$data['registerError'] = array(
				'headerTitle' => 'Données incorrectes / formulaire d\'inscription'
			);
			//chargement des vues

			$this->load->view('templates/header', $data['registerError']);
			$this->load->view('usersRegister/registerFormView');

		} else {
			// tableau des données à enregistrer
			$data['newUser'] = array(
				'userFirstName' => $_POST['firstName'],
				'userLastName' => $_POST['lastName'],
				'userLogin' => $_POST['login'],
				'userEmail' => $_POST['email'],
				'userPassword' => password_hash($_POST['password'], PASSWORD_BCRYPT), // mot de passe hashé
				'userCountry' => $_POST['country']
			);


			// insertion des données dans la table correspondante
			$this->users_model->saveNew('users', $data['newUser']);

			//variables à transmettre à la vue
			$data['success'] = array(
				'headerTitle' => 'Inscription réussie'
			);

			// affichage d'une page de succès
			$this->load->view('templates/header', $data['success']);
			$this->load->view('usersRegister/successView');
		}
		//affichage du footer
		$this->load->view('templates/footer');
	}
}


 ?>
