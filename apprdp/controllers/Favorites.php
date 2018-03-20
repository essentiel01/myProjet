<?php
/**
 *
 */
class Favorites extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
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

			//headerLogged
			$this->load->view('templates/headerLogged', $data['favoris']);
			//liste des favoris
			$this->load->view('favorites/index', $data['favoris']);
		} else {
			//données à envoyer à la vue
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			//header
			$this->load->view('templates/header', $data['error']);
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}

		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * Affiche la liste des revues de presse favoris pour un utilisateur donné.
	 */
	public function postsFavorites()
	{
		if (isset($_SESSION['userData'])) {

			//offset de la close limit
			$start = $this->uri->segment(3,0);

			//param^tres de la requête permettant de retourner le nombre de revues de presse favoris
			$queryParams1 = array(
				//clause where. permettant de selectionner toutes les revues favoris d'un utilsateur donné.
				'where' => array('userId' => $_SESSION['userData']->userId)
			);

			//configuration de la pagination avec bootstrap
			// url de base auquel va être ajouté le numero de la page
			$config['base_url'] =  base_url('espace-personnel/mes-revues-de-presse-favoris/')  ;

			// nombre total de revues de presse favoris pour un utilisateur donné
			$config['total_rows'] = $this->posts_model->countFavorites('posts_favorites', $queryParams1);

			// nombre d'articles par page
			$config['per_page'] = 3;

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

			// initialisation de la pagination
			$this->pagination->initialize($config);

			//paramêtres de la requête permettant de selectioner toutes les revues de presse faavoris d'un utilisateur
			$queryParams2 = array(
				'select' => 'posts.postId, postTitle, postSlug, postAudio, countryName, categoryName, postDate',

				'from' => 'posts_favorites',

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

				'limit' =>  $config['per_page'],
				'offset' => $start,

				'order' => 'categoryName '
			);

			//données à envoyer à la vue
			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de revue de presse',
				'favoritesList' => $this->posts_model->getPosts($queryParams2)->result(),
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			//chargement des vues
			//headerLogged
			$this->load->view('templates/headerLogged', $data['favoris']);
			//liste des favoris
			$this->load->view('favorites/postsFavoritesView', $data['favoris']);
		} else {
			//données à envoyer à la vue
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			//header
			$this->load->view('templates/header', $data['error']);
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
		//footer
		$this->load->view('templates/footer');
	}

	/**
	 * Affiche la liste des chroniques favoris pour un utilisateur donné.
	 */
	public function chronicsFavorites()
	{
		if (isset($_SESSION['userData'])) {

			//offset de la close limit
			$start = $this->uri->segment(3,0);

			//param^tres de la requête permettant de retourner le nombre de revues de presse favoris
			$queryParams1 = array(
				//clause where. permettant de selectionner toutes les revues favoris d'un utilsateur donné.
				'where' => array('userId' => $_SESSION['userData']->userId)
			);

			//configuration de la pagination avec bootstrap
			// url de base auquel va être ajouté le numero de la page
			$config['base_url'] =  base_url('espace-personnel/mes-chroniques-favoris/')  ;

			// nombre total de revues de presse favoris pour un utilisateur donné
			$config['total_rows'] = $this->posts_model->countFavorites('chronics_favorites', $queryParams1);

			// nombre d'articles par page
			$config['per_page'] = 3;

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

			// initialisation de la pagination
			$this->pagination->initialize($config);

			//paramêtres de la requête permettant de selectioner toutes les revues de presse faavoris d'un utilisateur
			$queryParams2 = array(
				'select' => 'chronics.chronicId, chronicTitle, chronicSlug, countryName, categoryName, chronicDate',

				'from' => 'chronics_favorites',

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

				'limit' =>  $config['per_page'],
				'offset' => $start,

				'order' => 'categoryName '
			);

			//données à envoyer à la vue
			$data['favoris'] = array(
				'headerTitle' => 'Favoris',
				'mainTitle' => 'Ma sélection de chroniques',
				'favoritesList' => $this->posts_model->getPosts($queryParams2)->result(),
				'emptyFavoritesList' => 'Votre liste de favoris est vide'
			);

			//chargement des vues
			//headerLogged
			$this->load->view('templates/headerLogged', $data['favoris']);
			//liste des favoris
			$this->load->view('favorites/chronicsFavoritesView', $data['favoris']);
		} else {
			//données à envoyer à la vue
			$data['error'] = array(
				'headerTitle' => 'Accès refusé'
			);
			//header
			$this->load->view('templates/header', $data['error']);
			//page d'erreur
			show_error('Vous n\'êtes pas connecté. Pour accéder à vos favoris veuillez vous connecter à votre compte. Merci', 500, 'Accès refusé');
		}
		//footer
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
			$this->posts_model->addFavorite('posts_favorites',  $dataToSave );
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
			$this->posts_model->addFavorite('chronics_favorites',  $dataToSave );
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

		$this->posts_model->deleteFavorite('posts_favorites', $dataToDelete);
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

		$this->posts_model->deleteFavorite('chronics_favorites', $dataToDelete);
		//redirige sur la même page.
		redirect('espace-personnel/mes-chroniques-favoris');
	}
}

 ?>
