<?php
/**
 *
 */
class UsersLog extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// $this->load->model('users_model');
		// $this->load->helper('url');
		// $this->load->library(array('form_validation'));
	}

	/**
	 * affiche le formulaire de connexion des utilsateurs
	 */
	public function index()
	{
		//variables à transmettre à la vue
		$data['login'] = array(
			'headerTitle' => 'Formulaire de Connexion'
		);

		$this->load->view('templates/header', $data['login']);
		$this->load->view('userslog/loginView');
		$this->load->view('templates/footer');
	}

	/**
	 * Valide les données du formulaire de connexion et vérifie si l'utilisateur a un compte dans la base de données. Si les données du formulaire ne respectent pas les règles de validation le formulaire est réaffiché avec les messages d'erreur de validation. Si les données respectent les règles de validation et que l'utilisateur existe dans la base de données alors une page de succès est affichée. Si l'utilisateur n'existe pas dans la base de données ou que le mot de passe qu'il a saisi est incorrecte alors le formulaire est réaffiché avec un message d'erreur
	 */
	public function logIn()
	{

		//les règles de validation sont stockées dans le dossier apprdp/config/form_validation.php. le chemin controller/method est utilisé comme clé des règles de validation ce qui permet de les charger automatiquement quand la methode correspondante est appelée sans être obligé de préciser àla méthode run() les règles à vérifier.
		if($this->form_validation->run() == FALSE) {
			// si toutes les rules ne sont pas validés on réaffiche le formulaire en l'hydratant avec les valeurs correctes et en laissant vide les champs incorrect et les mots de passe

			//variables à transmettre à la vue
			$data['registerError'] = array(
				'headerTitle' => 'Données incorrectes / formulaire de connexion' // titre du header
			);

			$this->load->view('templates/header', $data['registerError']);
			$this->load->view('userslog/loginView');
			$this->load->view('templates/footer');

		} else {
			// les identifiants de l'utilisateur à vérfier dans la base
			$email = $_POST['email'];
			$password = $_POST['password'];
			$queryParams = array(
				'from' => 'users',
				'where1' => array('userEmail' => trim($email)),
				'password' => trim($password)
			);

			// si la requête renvoie un objet on le stocke dans $_SESSION
			if (is_object($this->users_model->userAuthentificate($queryParams))) {
				$_SESSION['userData'] = $this->users_model->userAuthentificate($queryParams);
			} else { // sinon on affiche le message d'erreur
				$loginError = $this->users_model->userAuthentificate($queryParams);
				$this->session->set_flashdata('loginError', $loginError);
			}

			if (isset($_SESSION['userData'])){
				// variable à transmettre à la vue
				$data['user'] = array(
					'headerTitle' => 'Connexion réussie'
				);

				$this->load->view('templates/headerLogged', $data['user']);
				if (isset($_SESSION['urlRedirect'])) {
					redirect($_SESSION['urlRedirect']);
				} else {
					$this->load->view('userslog/success');
				}
				$this->load->view('templates/footer');

			} else { // si personne n'est connectée on load le header et on réaffiche le formulaire de connexion.

				// variable à transmettre à la vue
				$data['user'] = array(
					'headerTitle' => 'Données incorrectes / formulaire de connexion'
				);

				$this->load->view('templates/header', $data['user']);
				$this->load->view('userslog/loginView');
				$this->load->view('templates/footer');
			}
		}
	}


	/**
	 * Déconnexion de l'utilisateur
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('culture'); // TODO la redirection doit être faite vers l'accueil
	}


	/**
	 * affiche l'espace personnel de l'utilisateur connecté
	*/
	public function userDashboard()
	{
		if (isset($_SESSION['userData'])) {
			// variable à transmettre à la vue
			$data['user'] = array(
				'headerTitle' => 'Espace personnel',
			);

			$this->load->view('templates/headerLogged', $data['user']);
			$this->load->view('userslog/espacePersonnelView');
			$this->load->view('templates/footer');
		} else {
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à votre espace personnel veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
	}
}

 ?>
