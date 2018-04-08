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
		if (isset($_SESSION['userData'])) {

			//données à envoyer à la vue
			$data['favoris'] = array(
				'headerTitle' => 'Favoris'
			);
			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/index', $data['favoris']);
		} else {
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
		if (isset($_SESSION['userData'])) {
			//offset de la clause limit
			$start = $this->uri->segment(3,0);
			// initialisation de la pagination
			$config = $this->configPagination('espace-personnel/mes-revues-de-presse-favoris/', $this->postFavoriteQueryParams(), 'posts_favorites');
			$this->pagination->initialize($config);



			//données à envoyer à la vue
			$favoriteList = $this->posts_model->getPosts($this->postFavoriteQueryParams(), 'posts_favorites', $config['per_page'], $start)->result();

			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de revue de presse',
				'favoritesList' => $favoriteList,
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/postsFavoritesView', $data['favoris']);
		} else {
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

	private function configPagination(String $url, Array $queryParams, String $table):array
	{
		// url de base auquel va être ajouté le numero de la page
		$config['base_url'] =  base_url($url)  ;
		// nombre total de revues de presse favoris pour un utilisateur donné
		$config['total_rows'] = $this->posts_model->getPosts($queryParams, $table)->num_rows();
		// nombre d'articles par page
		$config['per_page'] = 5;
		// pour signifier que c'est le deuxième segment de l'url qui correspond au numéro dela page
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = '<nav aria-label="..."><ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class ="page-link">';
		$config['cur_tag_close'] = '</span></li>';

		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;

		$config['num_tag_open'] = '<li class="page-item "><span class ="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Précédent';
		$config['prev_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Suivant';
		$config['next_tag_close'] = '</li>';

		return $config;
	}


	private function postFavoriteQueryParams():array
	{
		//paramêtres de la requête permettant de selectioner toutes les revues de presse faavoris d'un utilisateur
		return array(
			'select' => 'posts.postId, postTitle, postSlug, postAudio, countryName, categoryName, postDate',

			'join1' => 'posts',
			'on1' => 'posts.postId = posts_favorites.postId',
			'inner1' => 'inner',

			'join2' => 'categories',
			'on2' => 'categories.categoryId = posts.postCategory',
			'inner2' => 'inner',

			'join3' => 'countries',
			'on3' => 'countries.countryId = posts.postCountry',
			'inner3' => 'inner',

			'where' => array('userId' => $_SESSION['userData']->userId),

			'order' => 'categoryName '
		);

	}
	private function chronicFavoriteQueryParams():array
	{
		//paramêtres de la requête permettant de selectioner toutes les revues de presse faavoris d'un utilisateur
		return array(
			'select' => 'chronics.chronicId, chronicTitle, chronicSlug, countryName, categoryName, chronicDate',

			'join1' => 'chronics',
			'on1' => 'chronics.chronicId = chronics_favorites.chronicId',
			'inner1' => 'inner',

			'join2' => 'categories',
			'on2' => 'categories.categoryId = chronics.chronicCategory',
			'inner2' => 'inner',

			'join3' => 'countries',
			'on3' => 'countries.countryId = chronics.chronicCountry',
			'inner3' => 'inner',

			'where' => array('userId' => $_SESSION['userData']->userId),

			'order' => 'categoryName '
		);
	}
	/**
	 * Affiche la liste des chroniques favoris pour un utilisateur donné.
	 */
	public function chronicsFavorites()
	{
		if (isset($_SESSION['userData'])) {

			//offset de la close limit
			$start = $this->uri->segment(3,0);

			// initialisation de la pagination
			$config = $this->configPagination('espace-personnel/mes-chroniques-favoris/', $this->chronicFavoriteQueryParams(), 'chronics_favorites');
			$this->pagination->initialize($config);

			//données à envoyer à la vue
			$favoriteList = $this->posts_model->getPosts($this->chronicFavoriteQueryParams(), 'chronics_favorites', $config['per_page'], $start)->result();

			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de chroniques',
				'favoritesList' => $favoriteList,
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			$this->load->view('templates/headerLogged', $data['favoris']);
			$this->load->view('favorites/chronicsFavoritesView', $data['favoris']);
		} else {
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
