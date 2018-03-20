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
		// $this->load->library('pagination');
		// $this->load->helper('url');
	}

	/**
	 * permet d'afficher tous les articles de la page
	 */
	public function index()
	{
		// on stocke dans $session l'url de la page lorsque aucun utilisateur n'est connecté. Cette valeur sera utilisée plus tard pour rediriger l'utilisateur vers cette même page après sa connexion.
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

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
		$config['base_url'] =  base_url(strToLower(get_class()) . '/')  ;

		// nombre total de de ligne retourné par la requête
		$config['total_rows'] = $this->posts_model->countPosts('posts', $queryParams1);

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


		//les variables à transmettre à la vue
		$data['culturePage'] = array(
			// affiche dynamiquement la catégorie dans l'entête
			'headerTitle' => 'Rubrique ' . get_class(),
			'mainTitle'=> 'Nos dernières revues publiées sur la culture',
			'result'=>  $this->posts_model->getPosts($this->postQueryParams($config['per_page'], $start))->result(),
			//extrait de la chronique à afficher sur l'index de la page
			'chronic'=> $this->posts_model->get_chronic($this->chronicQueryParams(array('categoryName' => get_class())))->result(),
			'slides' => $this->posts_model->getCarousel('carousel')->result(),
			//le nombre total de revues de presse et de chronique. ces valeurs sont retournées par les functions postsArchives et chronicsArchive
			'allPostsCount' => $this->postsArchiveCount(),
			'allChronicsCount' => $this->chronicsArchiveCount(),
		);


		// si un utilisateur est connecté on recupère tous les postId de sa liste de favoris
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
		$this->load->view(strToLower(get_class()) . '/index', $data['culturePage']);
		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * retourne un tableau assoc représentant les paramètres de la requête sql permettant dafficher la liste des revues de presse sur chaque page. Cette function est utilisée comme argument de la function getPosts() exécutée dans la méthode index() de la présente class.
	 * @param  Int    $limit  le nombre de revues à afficher par page paginéé
	 * @param  Int    $offset offset de la clause limit
	 * @return Array         paramètres de la requête sql
	 */
	private function postQueryParams(Int $limit, Int $offset)
	{
		return array(
			'select' => 'postId, postTitle, postSlug, postAudio, countryName, categoryName, postDate, writerFirstName, writerLastName, writerAvatar',

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

			'limit' =>  $limit,
			'offset' => $offset,

			'order' => 'postDate DESC'
		);

	}


	/**
	 * retourne un tableau associatif représentant les paramètres de la requête sql permettant de sélectionner toutes les revues de presse de la table posts ou toutes les chroniques de la table chronics
	 * @param  String $type le type de données à selectionner au singulier (soit post ou soit chronic)
	 * @return Array      paramètres de la requête sql
	 */
	private function archiveQueryParams(String $type)
	{
		return array(
			'select' => $type.'Id, ' . $type.'Title, ' . $type.'Slug, countryName, categoryName, ' . $type.'Date,  writerFirstName, writerLastName',

			'join1' => 'categories',
			'on1' => 'categories.categoryId =' . $type.'s.' . $type.'Category',
			'inner1' => 'inner',

			'join2' => 'countries',
			'on2' => 'countries.countryId =' . $type.'s.' . $type.'Country',
			'inner2' => 'inner',

			'join3' => 'writers',
			'on3' => 'writers.writerId =' . $type.'s.'. $type.'Writer',
			'inner3' => 'inner',

			'order' => $type.'Date  DESC'
		);
	}


	/**
	 * retourne un tableau associatif représentant les paramètres de la requête sql permettant de sélectionner la chronique à afficher sur la page index de chaque catégorie et sur la page chronicView. Cette function est utilisée comme argument de la function get_chronic() exécutée dans les méthodes index() et chronicView() de la présente classe
	 * @param  Array  $where tableau assoc représentant la valeur de la clé 'where'
	 * @return Array        paramètres de la requête sql
	 */
	private function chronicQueryParams(Array $where)
	{
		return array(
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


			'where' => $where,

			'limit' => 1,

			'order' => 'chronicDate DESC'
		);
	}


	/**
	 * sélectionne toutes les revues de presse de la table posts
	 */
	 public function postsArchive()
	 {

		 $data['postArchive'] = array(
			 'headerTitle' => 'Archives',
			 'mainTitle'=> 'Toutes nos revues de presse',
			 'allPosts' => $this->posts_model->getAllPosts($this->archiveQueryParams('post'), 'posts')->result()
		 );

		 //chargement des vues
		 if (isset($_SESSION['userData'])){

			 //headerLogged
			 $this->load->view('templates/headerLogged', $data['postArchive']);

		 } else {

			 // header
			 $this->load->view('templates/header', $data['postArchive']);

		 }
		 //vue de l'index de la page
		 $this->load->view(strToLower(get_class()) . '/postsArchiveView', $data['postArchive']);
		 //footer
		 $this->load->view('templates/footer');
	 }

	/**
	 * compte et retourne le nombre total de revues de presse dans la table posts. cette function est utilisée dans la méthode index() de la présente class pour renvoyer à la vue le nombre de revues
	 * @return Int nombre de revues de presse
	 */
	 public function postsArchiveCount():Int
	 {
		 return $this->posts_model->getAllPosts($this->archiveQueryParams('post'), 'posts')->num_rows();
	 }

	/**
	 * sélectionne toutes les chroniques de la table chronics
	 */
	public function chronicsArchive()
	{

		$data['chronicArchive'] = array(
			'headerTitle' => 'Archives',
			'mainTitle'=> 'Toutes nos chroniques',
			'allChronics' => $this->posts_model->getAllPosts($this->archiveQueryParams('chronic'), 'chronics')->result()
		);

		//chargement des vues
		if (isset($_SESSION['userData'])){

			//headerLogged
			$this->load->view('templates/headerLogged', $data['chronicArchive']);

		} else {

			// header
			$this->load->view('templates/header', $data['chronicArchive']);

		}
		//vue de l'index de la page
		$this->load->view(strToLower(get_class()) . '/chronicsArchiveView', $data['chronicArchive']);
		//footer
		$this->load->view('templates/footer');
	}


	/**
	 * compte et retourne le nombre total de chroniques dans la table chronics. cette function est utilisée dans la méthode index() de la présente class pour renvoyer à la vue le nombre de chroniques
	 * @return Int nombre de chroniques
	 */
	public function chronicsArchiveCount():Int
	{
		return $this->posts_model->getAllPosts($this->archiveQueryParams('chronic'), 'chronics')->num_rows();
	}


	/**
	 * affiche un article tout seul
	*/
	public function singleView()
	{
		// on stocke dans $session l'url de la page lorsque aucun utilisateur n'est connecté. Cette valeur sera utilisée plus tard pour rediriger l'utilisateur vers cette même page après sa connexion.
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());
		// les paramêtres de la requête sql permetant d'afficher un article tout seul
		$queryParams1 = array(
			'select' => 'postId, postTitle, postContent, postSource, countryName, categoryName, postDate, writerFirstName, writerLastName, writerAvatar',

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
		$this->load->view(strToLower(get_class()) . '/singleView', $data['singleView']);
		//footer
		$this->load->view('templates/footer');
	}

	/**
	 * affiche une chronique toute seule
	*/
	public function chronicView()
	{
		// on stocke dans $session l'url de la page lorsque aucun utilisateur n'est connecté. Cette valeur sera utilisée plus tard pour rediriger l'utilisateur vers cette même page après sa connexion.
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());

		//variables à transmetre à la vue
		$data['chronic'] = array(
			//affiche dynamiquement le titre de la chronique dans l'entête.
			'headerTitle' => $uriSegment[3] . ' / Rubrique ' . get_class(),
			//texte intégrale de la chronique affichée à l'index de la page
			'chronic'=> $this->posts_model->get_chronic($this->chronicQueryParams(array('chronicId' => $uriSegment[2])))->result()
		);

		// si un utilisateur est connecté  on recupère tous les chronicId de sa liste de favoris
		if (isset($_SESSION['userData'])){
			// les paramêtres de la requête sql permetant de sélectionner le postId dans la table posts_favorites
			$queryParams2 = array(
				'select' => 'chronicId',
				'where' => array('userId' => $_SESSION['userData']->userId)
			);
			// on ajoute à $data['culturePage'] les id de toutes les chroniques ajoutées aux favoris par un utilisateur donné. Ces id sont utilisés dans la page chronicView pour ajouter un petit coeur aux revues favorites de l'utilisateur
			$data['chronic']['favoritesList'] = $this->posts_model->getPostIdFromFavorites('chronics_favorites', $queryParams2)->result();
		}

		//chargement des vues
		if (isset($_SESSION['userData'])) {
			//headerLogged
			$this->load->view('templates/headerLogged', $data['chronic']);
		} else {
			//header
			$this->load->view('templates/header', $data['chronic']);
		}
		//vue de la chronique toute seule
		$this->load->view(strToLower(get_class()) . '/chronicView', $data['chronic']);
		$this->load->view('templates/footer');
	}


}


 ?>
