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
		$start = $this->uri->segment(2,0); // offset de la close limit

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
		$config['base_url'] =  base_url('culture/')  ; // url de base auquel va être ajouté le numero de la page

		$config['total_rows'] = $this->posts_model->count_posts($queryParams1, 'posts'); // nombre total de de ligne retourné par la requête

		$config['per_page'] = 4; // nombre d'articles par page

		$config['uri_segment'] = 2; // pour signifier que c'est le deuxième segment de l'url qui correspond au numéro dela page

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

		$this->pagination->initialize($config); // initialisation de la pagination

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
		$data['postsList'] = array(
			'headerTitle' => 'Rubrique ' . get_class(), // affiche dynamiquement la catégorie dans l'entête
			'mainTitle'=> 'Nos dernières revues publiées sur la culture',
			'result'=>  $this->posts_model->get_posts($queryParams2)->result(),
			'chronic'=> $this->posts_model->get_chronic($queryParams3)->result()
		);

		//chargement des vues
		$this->load->view('templates/header', $data['postsList']);
		$this->load->view('culture/index', $data['postsList']);
		$this->load->view('templates/footer');
	}


	/**
	 * affiche un article tout seul
	*/
	public function singleView()
	{
		$uriSegment = explode('/', uri_string()); // decoupe l'url en segment sur la base du séparateur '/'
		// les paramêtres de la requête sql permetant d'afficher un article tout seul
		$queryParams = array(
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
		$data['post'] = array(
			'headerTitle' => $uriSegment[3] . ' / Rubrique ' . get_class(), //affiche dynamiquement le titre de la revue de presse dans l'entête.
			'post'=> $this->posts_model->get_single_post($queryParams)->result()
		);

		// chargement des vues
		$this->load->view('templates/header', $data['post']);
		$this->load->view('culture/singleView', $data['post']);
		$this->load->view('templates/footer');
	}

	/**
	 * affiche une chronique toute seule
	*/
	public function chronicView()
	{
		$uriSegment = explode('/', uri_string()); // decoupe l'url en segment sur la base du séparateur '/'

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
			'headerTitle' => $uriSegment[3] . ' / Rubrique ' . get_class(), //affiche dynamiquement le titre de la chronique dans l'entête.
			'chronic'=> $this->posts_model->get_chronic($queryParams)->result()
		);

		//chargement des vues
		$this->load->view('templates/header', $data['chronic']);
		$this->load->view('culture/chronicView', $data['chronic']);
		$this->load->view('templates/footer');
	}
}


 ?>
