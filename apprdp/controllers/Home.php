<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$welcome = "Toute l'actualité en quelques lignes";
		$home_1 = $this->posts_model->getHome("la revue de presse")->row();
		$home_2 = $this->posts_model->getHome("le décodage de l'actualité")->row();
		$home_3 = $this->posts_model->getHome("Le débat")->row();
		$slides = $this->posts_model->getCarousel()->result();
		$posts = $this->posts_model->recentPosts(4)->result();
		$decodage_actu = $this->posts_model->getDecodageActus(5)->result();

		$data = array(
			"headerTitle" => "Accueil",
			"welcome"=> $welcome,
			"home_1" => $home_1,
			"home_2" => $home_2,
			"home_3" => $home_3,
			"slides" => $slides,
			'allPostsCount' => $this->postsArchiveCount(),
			'allChronicsCount' => $this->chronicsArchiveCount(),
			'recentPosts' => $posts,
			'decodage_actu' => $decodage_actu,
			'indisponible' => 'Contnenu indisponible'
		);

		if ( isset($_SESSION[ "userData" ]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('homeView.php', $data );
		$this->load->view('templates/footer.php');
	}

	/**
	 * compte et retourne le nombre total de revues de presse dans la table posts. cette function est utilisée dans la méthode index() de la présente class pour renvoyer à la vue le nombre de revues
	 * @return Int nombre de revues de presse
	 */
	 private function postsArchiveCount()
	 {
		 return $this->posts_model->getArchives('posts', 'post')->num_rows();
	 }
/**
	 * compte et retourne le nombre total de chroniques dans la table chronics. cette function est utilisée dans la méthode index() de la présente class pour renvoyer à la vue le nombre de chroniques
	 * @return Int nombre de chroniques
	 */
	public function chronicsArchiveCount()
	{
		return $this->posts_model->getArchives('chronics', 'chronic')->num_rows();
	}

	/**
	 * Enregistre une adressse email pour la newsletter
	 * @return [type] [description]
	 */
	public function emailForNewsletter()
	{
		$email = $_POST["email"];
		if($this->form_validation->run() == FALSE)
		{
			echo json_encode([ "validation_error" => "Echec ! email invalide" ]);
		}
		else
		{
				$data_to_save = array(
					'email' => $email
				);
				$save = $this->users_model->saveNew( "newsletter", $data_to_save );
				if ( $save )
				{
					echo json_encode( [ "success" => "Email enregistré. Merci" ]);
				}
				else
				{
					echo json_encode( [ "fail" => "Echec de l'enregistrement ! Réessayez" ]);
				}
		}
	}

	/**
	 * affiche la page comment ça marche
	 * @return [type] [description]
	 */
	public function howItWork()
	{
		$data = array(
			"headerTitle" => "Comment ça marche"
		);

		if (isset($_SESSION[ 'userData' ]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('templates/howItWork.php');
		$this->load->view('templates/footer.php');
	}

	/**
	 * affiche la liste des membres de l'équipe
	 * @return [type] [description]
	 */
	public function team()
	{
		$teams = $this->users_model->getUser('users', array('role' => 'team'))->result();

		$data = array(
			"headerTitle" => "Notre équipe",
			"teams" => $teams
		);

		if (isset($_SESSION[ 'userData' ]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('templates/teamView.php', $data);
		$this->load->view('templates/footer.php');
	}

	/**
	 * affiche la liste des partenaires
	 * @return [type] [description]
	 */
	public function partners()
	{
		$partners = $this->users_model->getPartners()->result();

		$data = array(
				'headerTitle' => 'Partenaires',
				'partners' => $partners
		);

		if (isset($_SESSION[ 'userData' ]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('templates/partnersView.php', $data);
		$this->load->view('templates/footer.php');
	}

	/**
	 * affiche le formulaire de contact.
	 * @return [type] [description]
	 */
	public function contactForm()
	{
		$data = array(
				'headerTitle' => 'Nous contacter'
		);

		if (isset($_SESSION[ 'userData' ]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('templates/contactForm.php', $data);
		$this->load->view('templates/footer.php');
	}

	/**
	 * traitement du message du formulaire de contact
	 * @return [type] [description]
	 */
	public function contactUs()
	{

	}
}
