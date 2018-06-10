<?php
/**
 *
 */
class Users extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * affiche le formulaire d'inscription
 	*/
	public function formRegister()
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
	 * vérifie les contraintes de validation du formulaire et enregistre l'utilisateur
	 * @return [type] [description]
	 */
	public function register()
	{

		//les règles de validation sont stockées dans le dossier apprdp/config/form_validation.php. le chemin controller/method est utilisé comme clé des règles de validation ce qui permet de les charger automatiquement quand la methode correspondante est appelée sans être obligé de préciser à la méthode run() les règles à vérifier.
		if($this->form_validation->run() == FALSE) {

			$data['error'] = array(
				'headerTitle' => 'Données incorrectes / formulaire d\'inscription'
			);
			$this->load->view('templates/header', $data['error']);
			$this->load->view('usersRegister/registerFormView');

		} else {
			// tableau des données à enregistrer
			$post = $this->dataClean($_POST);
			$user = array(
				'userFirstName' => $post['firstName'],
				'userLastName' => $post['lastName'],
				'userLogin' => $post['login'],
				'userEmail' => $post['email'],
				'userPassword' => password_hash($_POST['password'], PASSWORD_BCRYPT), // mot de passe hashé
				'country' => $post['country']
			);

			$this->users_model->saveNew('users', $user);

			$data['success'] = array(
				'headerTitle' => 'Inscription réussie'
			);

			$this->load->view('templates/header', $data['success']);
			$this->load->view('usersRegister/successView');
		}
		$this->load->view('templates/footer');
	}

	/**
	 * affiche le formulaire de connexion des utilsateurs
	 */
	public function loginForm()
	{
		$data['login'] = array(
			'headerTitle' => 'Formulaire de Connexion'
		);

		$this->load->view('templates/header', $data['login']);
		$this->load->view('userslog/loginView');
		$this->load->view('templates/footer');
	}

	/**
	 * vérifie les contraintes de validation du formulaire et connecte l'utilisateur s'il existe dans la base de données
	 */
	public function login()
	{
		//les règles de validation sont stockées dans le dossier apprdp/config/form_validation.php.
		if ($this->form_validation->run() == FALSE)
		{

			$data = array(
				'headerTitle' => 'Données incorrectes / formulaire de connexion' // titre du head
			);
			$this->load->view('templates/header', $data);
			$this->load->view('userslog/loginView');
			$this->load->view('templates/footer');
			// redirect('connexion/formulaire');
		}
		else
		{
			//les identifiants de l'utilisateur à vérfier dans la base
			$post = $this->dataClean($_POST);
			$email = $post['email'];
			$password = $post['password'];

			$params = array(
				'where1' => array('userEmail' => $email),
				'password' => $password
			);
			// si la requête renvoie un objet on le stocke dans $_SESSION
			if ($this->users_model->userExist($params))
			{
				$user = $this->users_model->userExist($params)->row();
				// foreach ($user as $row) {
					$_SESSION['userData'] = $user;
				// }
			}
			else
			{ // sinon on affiche le message d'erreur
				$this->session->set_flashdata('loginError', 'Email et/ou mot de passe incorrecte');
				redirect('connexion/formulaire');
			}

			if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'user')
			{
				$data['user'] = array(
					'headerTitle' => 'Connexion réussie'
				);

				$this->load->view('templates/headerLogged', $data['user']);

				if (isset($_SESSION['urlRedirect']))
				{
					redirect($_SESSION['urlRedirect']);
				}
				else
				{
					$this->load->view('userslog/success');// TODO: remplacer cette url par celle de l'accueil
				}

				$this->load->view('templates/footer');
			}
			elseif (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
			{
				redirect('inside/team/dashboard');
			}
		}
	}


	/**
	 * Déconnexion de l'utilisateur
	*/
	public function logout()
	{
		unset($_SESSION['userData']);
		redirect('culture'); // TODO la redirection doit être faite vers l'accueil
	}


	/**
	 * affiche l'espace personnel de l'utilisateur connecté
	*/
	public function profil()
	{
		if (isset($_SESSION['userData']))
		{
			$data['user'] = array(
				'headerTitle' => 'Espace personnel',
			);

			$this->load->view('templates/headerLogged', $data['user']);
			$this->load->view('userslog/profilView');
			$this->load->view('templates/footer');
		}
		else
		{
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à votre espace personnel veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
	}

	/**
	 * vérifie et nettoie les données saisies par l'utilisateur
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	private function dataClean($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $value)
			{
				$data[$key] = trim($value);
				$data[$key] = htmlspecialchars($data[$key]);
			}
		}
		else
		{
			$data = trim($data);
			$data = htmlspecialchars($data);
		}

		return $data;
	}

	/**
	 * Met à jour les informations du profil
	 * @return [type] [description]
	 */
	public function updateProfil()
	{
		if (isset($_SESSION['userData']))
		{
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = array(
					'headerTitle' => 'Données incorrectes / formulaire d\'inscription'
				);
				$this->load->view('templates/headerLogged', $data['error']);
				$this->load->view('userslog/profilView');
				$this->load->view('templates/footer');
			}
			else
			{
				$post = $this->dataClean($_POST);

				$newProfil = array(
					'userFirstName' => $post['firstName'],
					'userLastName' => $post['lastName'],
					'userLogin' => $post['login'],
					'userEmail' => $post['email'],
					'country' => $post['country']
				);

				$userId = $_SESSION['userData']->userId;
				$newEmail = $post['email'];
				$newLogin = $post['login'];
				$where = "(userId != $userId AND userLogin = '$newLogin') OR (userId != $userId AND userEmail = '$newEmail')";
				//vérifie si un autre user 'a pas déja les meme email et pseudo
				$verify = $this->users_model->getUser( 'users', $where )->row();

				if ( $verify == null )
				{
					//persist les nouvelles infos dans la base
					$this->users_model->updateData( 'users', $newProfil, array("userId" => $userId) );
					//actualise lesinfosutilisateurs dans la session
					$user = $this->users_model->getUser( 'users', array("userId" => $userId) )->row();
					$_SESSION['userData'] = $user;

					redirect("espace-personnel/profil");
				}
				else
				{
					$this->session->set_flashdata( 'updating_error', 'Cet email et(ou) ce login ne sont peuvent être utilisés. Veuillez réessayer!' );

					redirect("espace-personnel/profil");
				}
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Change la photo de profil
	 * @return [type] [description]
	 */
	public function do_upload()
	{
		if ( isset( $_SESSION[ "userData" ] ) )
		{
			//config du fichier à charger
			$config['upload_path']          = './webroot/images/usersAvatar/';
			$config['allowed_types']        = 'jpeg|jpg|png';
			$config['file_name']        = bin2hex(random_bytes(16));
			$config['max_size']             = 1024;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			//initialisation
			$this->load->library("upload", $config);
			//ancien avatar
			$old_avatar =  $_SESSION['userData']->userAvatar;

			if ( !$this->upload->do_upload('userfile') )
			{
				$this->session->set_flashdata( "uploading_error", $this->upload->display_errors() );
				$data['head_title'] = array( 'headerTitle' => 'Données incorrectes' );

				$this->load->view('templates/headerLogged', $data['head_title']);
				$this->load->view('userslog/profilView');
				$this->load->view('templates/footer');
			}
			else
			{
				//supprime l'ancien avatar du server
				if ( $old_avatar != "default.png" )
				{
					unlink("./webroot/images/usersAvatar/$old_avatar");
				}
				//persist lenouvel avatar dans la base de données
				$userId = $_SESSION['userData']->userId;
				$this->users_model->updateData( "users", array( "userAvatar" => $this->upload->data("file_name") ), array( "userId" => $userId ) );
				//actualise lesinfosutilisateurs dans la session
				$user = $this->users_model->getUser( 'users', array("userId" => $userId) )->row();
				$_SESSION['userData'] = $user;

				redirect("espace-personnel/profil");
			}
		}
		else
		{
			show_404();
		}
	}
	/**
	 * supprime la photo de profil
	 * @return [type] [description]
	 */
	public function deleteAvatar()
	{
		if ( isset( $_SESSION[ "userData" ] ) )
		{
			//ancien avatar
			$old_avatar =  $_SESSION['userData']->userAvatar;

			$userId = $_SESSION[ "userData" ] ->userId;
			$this->users_model->updateData( "users", array( "userAvatar" => "default.png" ), array( "userId" => $userId ) );

			//supprime l'ancien avatar du server
			if ( $old_avatar != "default.png" )
			{
				unlink("./webroot/images/usersAvatar/$old_avatar");
			}

			//actualise lesinfosutilisateurs dans la session
			$user = $this->users_model->getUser( 'users', array("userId" => $userId) )->row();
			$_SESSION['userData'] = $user;

			redirect("espace-personnel/profil");
		}
		else
		{
			show_404();
		}
	}

	/**
	 * modifie le mot de passe
	 */
	public function resetPassword()
	{
		if ( isset( $_SESSION[ "userData" ] ) )
		{
			$userId = $_SESSION[ "userData" ]->userId;
			$old_password = $_POST[ "old_password" ];
			$password = $_POST[ "password" ];
			$password_confirm = $_POST[ "password_confirm" ];

			if ( password_verify( $old_password, $_SESSION[ "userData" ]->userPassword ) )
			{
				 if  ($this->form_validation->run() == FALSE)
				{
					$data['error'] = array(
						'headerTitle' => 'Données incorrectes / formulaire d\'inscription'
					);
					$this->load->view('templates/headerLogged', $data['error']);
					$this->load->view('userslog/profilView');
					$this->load->view('templates/footer');
				}
				else
				{
					$hash = password_hash( $password, PASSWORD_BCRYPT );
					$this->users_model->updateData( "users", array( "userPassword" => $hash ), array( "userId" => $userId ) );

					//actualise lesinfosutilisateurs dans la session
					$user = $this->users_model->getUser( 'users', array("userId" => $userId) )->row();
					$_SESSION['userData'] = $user;

					redirect("espace-personnel/profil");
				}
			}
			else
			{
				$password_error = "Mot de passe incorrecte";
				$data = array(
					 'headerTitle' => 'Données incorrectes' ,
					 'password_error' => $password_error
				 );

				$this->load->view('templates/headerLogged', $data );
				$this->load->view('userslog/profilView', $data );
				$this->load->view('templates/footer');
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * supprime le compte d'un utilisateur
	 * @return [type] [description]
	 */
	public function deleteProfil()
	{
		if ( isset( $_SESSION[ "userData" ] ) )
		{
			$userId = $_SESSION[ "userData" ]->userId;
			$old_avatar = $_SESSION[ "userData" ]->userAvatar;
			//on supprime le compte
			$this->users_model->deleteUser( "users", $userId );

			//supprime l'avatar du server
			if ( $old_avatar != "default.png" )
			{
				unlink("./webroot/images/usersAvatar/$old_avatar");
			}
			//on le déconnecte
			unset( $_SESSION[ "userData" ] );
			//on redirige sur l'acceuil
			redirect( "culture" ); // TODO: rediriger vers la page de l'accueil
		}
		else
		{
			show_404();
		}
	}


	public function forgottenPassword()
	{
		$data = array(
			'headerTitle' => 'Mot de passe oublié'
		);
		$this->load->view('templates/header.php', $data);
		$this->load->view('usersLog/forgottenpasswordView.php');
		$this->load->view('templates/footer.php');
	}



}


 ?>
