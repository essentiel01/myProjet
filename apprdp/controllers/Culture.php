<<?php
/**
 * Controller de la page culture
 */
class Culture extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
		$this->load->library('pagination');
		$this->load->helper('url');
	}

	/**
	 * permet d'afficher tous les articles de la page
	 */
	public function index()
	{
		// offset de la close limit
		$start = $this->uri->segment(2,0);

		//param^tres de la requête permettant de retourner le
		$queryParams1 = array(
			//clause inner join
			'join1' => 'categories',
			'on1' => 'categories.categoryId = posts.postCategory',
			'inner1' => 'inner',
			//clause where. le nom cette classe correspond u nom de la catégorie
			'where' => array('categoryName' => get_class()),
		);

		//configuration de la pagination avec bootstrap
		// url de base auquel va être ajouté le numero de la page
		$config['base_url'] =  base_url('culture/')  ;

		// nombre total de de ligne retourné par la requête
		$config['total_rows'] = $this->posts_model->count_posts($queryParams1, 'posts');

		// nombre d'articles par page
		$config['per_page'] = 4;

		// pour signifier que c'est le deuxième segment de l'url qui correspond au numéro dela page
		$config['uri_segment'] = 2;

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

		// les paramêtres de la requ^te sql permetant de sélectionner les articles pour chaque catégorie
		$queryParams2 = array(
			'select' => 'postId, postTitle, postSlug, countryName, categoryName, postPublishingDate, 	  writerFirstName, writerLastName, writerAvatar',
			'from' => 'posts',

			'join1' => 'categories',
			'on1' => 'categories.categoryId = posts.postCategory',
			'inner1' => 'inner',

			'join2' => 'countries',
			'on2' => 'countries.countryId = posts.postCountry',
			'inner2' => 'inner',

			'join3' => 'writers',
			'on3' => 'writers.writerId = posts.postWriter',
			'inner3' => 'inner',

			// le nom de la catégorie correspond au nom de la class
			'where' => array('categoryName' => get_class()),

			'limit' =>  $config['per_page'],
			'offset' => $start,

			'order' => 'postPublishingDate DESC'
		);

		// les paramêtres de la requête sql permetant de sélectionner la chronique pour une catégorie
		$queryParams3 = array(
			'from' => 'chronics',
			'join1' => 'categories',
			'on1' => 'categories.categoryId = chronics.chronicCategory',
			'inner1' => 'inner',

			'join2' => 'countries',
			'on2' => 'countries.countryId = chronics.chronicCountry',
			'inner2' => 'inner',

			'join3' => 'writers',
			'on3' => 'writers.writerId = chronics.chronicWriter',
			'inner3' => 'inner',
			// le nom de la catégorie correspond au nom de la class
			'where' => array('categoryName' => get_class()),

			'limit' => 1,

			'order' => 'chronicDate DESC'
		);



		//les variables à transmettre à la vue
		$data['culturePage'] = array(
			// affiche dynamiquement la catégorie dans l'entête
			'headerTitle' => 'Rubrique ' . get_class(),
			'mainTitle'=> 'Nos dernières revues publiées sur la culture',
			'result'=>  $this->posts_model->get_posts($queryParams2)->result(),
			//extrait de la chronique à afficher sur l'index de la page
			'chronic'=> $this->posts_model->get_chronic($queryParams3)->result()

		);

		// si un tutilisateur est connectéon on recupère tous les postId de sa liste de favoris
		if (isset($_SESSION['userData'])){
			// les paramêtres de la requête sql permetant de sélectionner le postId dans la table posts_favorites
			$queryParams4 = array(
				'select' => 'postId',
				'where' => array('userId' => $_SESSION['userData']->userId)
			);
			// on ajoute à $data['culturePage'] les id de toutes les revues ajoutées aux favoris par un utilisateur donné. Ces id sont utilisés dans la page index de chaque catégorie pour identifier les revues favorites de l'utilisateur
			$data['culturePage']['favoritesList'] = $this->posts_model->getPostIdFromFavorites('posts_favorites', $queryParams4)->result();
		}

		//chargement des vues
		if (isset($_SESSION['userData'])){

			//headerLogged
			$this->load->view('templates/headerLogged', $data['culturePage']);

		} else {
			// header
			$this->load->view('templates/header', $data['culturePage']);

		}
		//vue de l'index de la page
		$this->load->view('culture/index', $data['culturePage']);
		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * affiche un article tout seul
	*/
	public function singleView()
	{
		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());
		// les paramêtres de la requête sql permetant d'afficher un article tout seul
		$queryParams1 = array(
			'select' => 'postId, postTitle, postContent, postSource, countryName, categoryName, postPublishingDate, writerFirstName, writerLastName, writerAvatar',

			'from' => 'posts',

			'join1' => 'categories',
			'on1' => 'categories.categoryId = posts.postCategory',
			'inner1' => 'inner',

			'join2' => 'countries',
			'on2' => 'countries.countryId = posts.postCountry',
			'inner2' => 'inner',

			'join3' => 'writers',
			'on3' => 'writers.writerId = posts.postWriter',
			'inner3' => 'inner',
			// on passe le troisième segment de l'url(ce qui représente l'id de l'article) à la clause where
			'where' => array('postId' => $uriSegment[2]),
		);


		// variables à transmettre à la vue
		$data['singleView'] = array(
			//affiche dynamiquement le titre de la revue de presse dans l'entête.
			'headerTitle' => $uriSegment[3] . ' / Rubrique ' . get_class(),
			'post'=> $this->posts_model->get_single_post($queryParams1)->result()
		);

		// si un tutilisateur est connectéon on recupère tous les postId de sa liste de favoris
		if (isset($_SESSION['userData'])){
			// les paramêtres de la requête sql permetant de sélectionner le postId dans la table posts_favorites
			$queryParams2 = array(
				'select' => 'postId',
				'where' => array('userId' => $_SESSION['userData']->userId)
			);
			// on ajoute à $data['culturePage'] les id de toutes les revues ajoutées aux favoris par un utilisateur donné. Ces id sont utilisés dans la page singleView ajouter un petit coeur aux revues favorites de l'utilisateur
			$data['singleView']['favoritesList'] = $this->posts_model->getPostIdFromFavorites('posts_favorites', $queryParams2)->result();
		}

		// chargement des vues
		if (isset($_SESSION['userData'])) {
			//headerLogged
			$this->load->view('templates/headerLogged', $data['singleView']);
		} else {
			//header
			$this->load->view('templates/header', $data['singleView']);
		}
		//vue d'un article tout seul
		$this->load->view('culture/singleView', $data['singleView']);
		//footer
		$this->load->view('templates/footer');
	}

	/**
	 * affiche une chronique toute seule
	*/
	public function chronicView()
	{
		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());

		// les paramêtres de la requête sql permetant d'afficher une chronique toute seule
		$queryParams = array(
			'from' => 'chronics',
			'join1' => 'categories',
			'on1' => 'categories.categoryId = chronics.chronicCategory',
			'inner1' => 'inner',

			'join2' => 'countries',
			'on2' => 'countries.countryId = chronics.chronicCountry',
			'inner2' => 'inner',

			'join3' => 'writers',
			'on3' => 'writers.writerId = chronics.chronicWriter',
			'inner3' => 'inner',
			// on passe le troisième segment de l'url (qui représente l'id de la chronique) à la clause where
			'where' => array('chronicId' => $uriSegment[2]),

			'limit' => 1,

			'order' => 'chronicDate DESC'
		);

		//variables à transmetre à la vue
		$data['chronic'] = array(
			//affiche dynamiquement le titre de la chronique dans l'entête.
			'headerTitle' => $uriSegment[3] . ' / Rubrique ' . get_class(),
			//texte intégrale de la chronique affichée à l'index de la page
			'chronic'=> $this->posts_model->get_chronic($queryParams)->result()
		);

		//chargement des vues
		if (isset($_SESSION['userData'])) {
			//headerLogged
			$this->load->view('templates/headerLogged', $data['chronic']);
		} else {
			//header
			$this->load->view('templates/header', $data['chronic']);
		}
		//vue de la chronique toute seule
		$this->load->view('culture/chronicView', $data['chronic']);
		$this->load->view('templates/footer');
	}
}


 ?>
