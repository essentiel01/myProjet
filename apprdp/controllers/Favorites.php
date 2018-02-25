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
	}

	/**
	 * Affiche la page d'accueil des favoris
	 */
	public function index()
	{
		//données à envoyer à la vue
		$data['favoris'] = array(
			'headerTitle' => 'Favoris'
		);

		if (isset($_SESSION['userData'])) {
			//headerLogged
			$this->load->view('templates/headerLogged', $data['favoris']);
		} else {
			//header
			$this->load->view('templates/header', $data['favoris']);
		}
		//liste des favoris
		$this->load->view('favorites/index', $data['favoris']);
		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * Affiche la liste des revues de presse favoris pour un utilisateur donné.
	 */
	public function postsFavorites()
	{
		$queryParams = array(
			'select' => 'posts.postId, postTitle, postSlug, countryName, categoryName, postPublishingDate',

			'join1' => 'posts',
			'on1' => 'posts.postId = posts_favorites.postId',
			'inner1' => 'inner',

			'join2' => 'categories',
			'on2' => 'categories.categoryId = posts.postCategory',
			'inner2' => 'inner',

			'join3' => 'countries',
			'on3' => 'countries.countryId = posts.postCountry',
			'inner3' => 'inner',

			'where' => array('userId' => $_SESSION['userData']->userId)
		);

		//données à envoyer à la vue
		$data['favoris'] = array(
			'headerTitle' => 'Favoris',
			'mainTitle' => 'Ma sélection de revue de presse',
			'favoritesList' => $this->posts_model->getFavorites('posts_favorites', $queryParams)->result()
		);

		if (isset($_SESSION['userData'])) {
			//headerLogged
			$this->load->view('templates/headerLogged', $data['favoris']);
		} else {
			//header
			$this->load->view('templates/header', $data['favoris']);
		}
		//liste des favoris
		$this->load->view('favorites/postsFavoritesView', $data['favoris']);
		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * Traitement des données envoyées par la requête ajax
	 */
	public function addPosts()
	{
			//données à insérer dans la table des favoris
			$dataToSave = array(
				'userId' => $_POST['userId'],
				'postId' => $_POST['postId']
			);
			//insertion des données dans la table
			$this->posts_model->addFavorite('posts_favorites',  $dataToSave );
	}
}

 ?>
