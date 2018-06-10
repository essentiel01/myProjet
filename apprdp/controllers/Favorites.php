<?php
/**
 *
 */
class Favorites extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// $this->load->model('posts_model');
		//$this->load->library('pagination');

	}

	/**
	 * Affiche la page d'accueil des favoris
	 */
	public function index()
	{
		if (isset($_SESSION['userData'])) 
		{

			//données à envoyer à la vue
			$data['favoris'] = array(
				'headerTitle' => 'Favoris'
			);
			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/index', $data['favoris']);
		} 
		else 
		{
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			$this->load->view('templates/header', $data['error']);
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
		$this->load->view('templates/footer');
	}


	/**
	 * Affiche la liste des revues de presse favoris pour un utilisateur donné.
	 */
	public function postsFavorites()
	{
		if (isset($_SESSION['userData'])) 
		{
			$userId = $_SESSION['userData']->userId;
			$total_rows = $this->posts_model->getPostFavorites($userId)->num_rows();
			$config = array(
				'base_url' =>  base_url('espace-personnel/mes-revues-de-presse-favoris/'),
				'total_rows' => $total_rows,
				'per_page' => 4,
				'uri_segment' => 2,  //deuxième segment de l'url
				'full_tag_open' =>  '<nav aria-label="..."><ul class="pagination pagination-lg">',
				'full_tag_close' =>  '</ul></nav>',
				'cur_tag_open' =>  '<li class="page-item active"><span class ="page-link">',
				'cur_tag_close' => '</span></li>',
				'first_link' => FALSE,
				'last_link' => FALSE,
				'num_tag_open' => '<li class="page-item "><span class ="page-link">',
				'num_tag_close' =>  '</span></li>',
				'prev_tag_open' => '<li>',
				'prev_link' =>  'Précédent',
				'prev_tag_close' => '</li>',
				'next_tag_open' => '<li>',
				'next_link' => 'Suivant',
				'next_tag_close' =>  '</li>'
			);
			$limit = $config['per_page'];
			$offset = $this->uri->segment(3,0);
			// initialisation de la pagination
			$this->pagination->initialize($config);


			//données à envoyer à la vue
			$favoriteList = $this->posts_model->getPostFavorites($userId, $limit, $offset)->result();

			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de revue de presse',
				'favoritesList' => $favoriteList,
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/postsFavoritesView', $data['favoris']);
		}
		else 
		{
			//données à envoyer à la vue
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			$this->load->view('templates/header', $data['error']);
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
		$this->load->view('templates/footer');
	}

	
	
	/**
	 * Affiche la liste des chroniques favoris pour un utilisateur donné.
	 */
	public function chronicsFavorites()
	{
		if (isset($_SESSION['userData'])) 
		{

			$userId = $_SESSION['userData']->userId;
			$total_rows = $this->posts_model->getChronicFavorites($userId)->num_rows();
			$config = array(
				'base_url' =>  base_url('espace-personnel/mes-chroniques-favoris/'),
				'total_rows' => $total_rows,
				'per_page' => 4,
				'uri_segment' => 2,  //deuxième segment de l'url
				'full_tag_open' =>  '<nav aria-label="..."><ul class="pagination pagination-lg">',
				'full_tag_close' =>  '</ul></nav>',
				'cur_tag_open' =>  '<li class="page-item active"><span class ="page-link">',
				'cur_tag_close' => '</span></li>',
				'first_link' => FALSE,
				'last_link' => FALSE,
				'num_tag_open' => '<li class="page-item "><span class ="page-link">',
				'num_tag_close' =>  '</span></li>',
				'prev_tag_open' => '<li>',
				'prev_link' =>  'Précédent',
				'prev_tag_close' => '</li>',
				'next_tag_open' => '<li>',
				'next_link' => 'Suivant',
				'next_tag_close' =>  '</li>'
			);
			$limit = $config['per_page'];
			$offset = $this->uri->segment(3,0);
			// initialisation de la pagination
			$this->pagination->initialize($config);

			//données à envoyer à la vue
			$favoriteList = $this->posts_model->getChronicFavorites($userId, $limit, $offset)->result();

			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de chroniques',
				'favoritesList' => $favoriteList,
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/chronicsFavoritesView', $data['favoris']);
		}
		else
		{
			//données à envoyer à la vue
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			$this->load->view('templates/header', $data['error']);
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
		$this->load->view('templates/footer');
	}


	/**
	 * Traitement des données envoyées par la requête ajax
	 */
	public function addPost()
	{
			//données à insérer dans la table des favoris
			$dataToSave = array(
				'userId' => $_POST['userId'],
				'postId' => $_POST['postId']
			);
			//insertion des données dans la table
			$this->posts_model->addFavorite($dataToSave,'posts_favorites');
	}


	/**
	 * Traitement des données envoyées par la requête ajax
	 */
	public function addChronic()
	{
			//données à insérer dans la table des favoris
			$dataToSave = array(
				'userId' => $_POST['userId'],
				'chronicId' => $_POST['chronicId']
			);
			//insertion des données dans la table
			$this->posts_model->addFavorite($dataToSave, 'chronics_favorites');
	}

	/**
	 * Supprime une revue de la liste des favoris
	 */
	public function deletePost()
	{
		$dataToDelete = array(
			'postId' => $_POST['postId'],
			'userId' => $_SESSION['userData']->userId
		);

		$this->posts_model->deleteFavorite($dataToDelete, 'posts_favorites');
		//redirige sur la même page.
		redirect('espace-personnel/mes-revues-de-presse-favoris');
	}

	/**
	 * Supprime une revue de la liste des favoris
	 */
	public function deleteChronic()
	{
		$dataToDelete = array(
			'chronicId' => $_POST['chronicId'],
			'userId' => $_SESSION['userData']->userId
		);

		$this->posts_model->deleteFavorite($dataToDelete, 'chronics_favorites');
		//redirige sur la même page.
		redirect('espace-personnel/mes-chroniques-favoris');
	}
}

 ?>
