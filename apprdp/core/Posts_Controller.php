<?php
/**
 * Controller de la page culture. Le prefixe Posts du posts_controller peut être modifié dans le config.php
 */
class Posts_Controller extends CI_Controller
{
	protected $page;

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * permet d'afficher tous les articles de la page
	 */
	public function index()
	{
		// url de redirection après sa connexion.
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

		$total_rows = $this->posts_model->getPosts($this->page)->num_rows();
		$config = array(
			'base_url' =>  base_url(strtolower($this->page) . '/'),
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
		$offset = $this->uri->segment(2,0);
		// initialisation de la pagination
		$this->pagination->initialize($config);

		//les variables à transmettre à la vue
		$chronic = $this->posts_model->getOneChronic(array('categoryName' => $this->page))->row();
		$posts = $this->posts_model->getPosts($this->page, $limit, $offset)->result();
		$headerTitle = 'Rubrique ' . $this->page;
		$main_title = 'Nos dernières revues publiées dans la rubrique ' . $this->page;
		$slides = $this->posts_model->getCarousel()->result();
		$decodage_actu = $this->posts_model->decodageActu(5)->result();
		//$posts = null;
		//$slides = null;
		//$chronic = null;
		$data = array(
			'headerTitle' => $headerTitle,
			'mainTitle'=> $main_title,
			'posts'=>  $posts,
			'emptyData' => 'Désolé ! aucun articles disponible pour le moment.',
			'chronic'=> $chronic,
			'slides' => $slides,
			'allPostsCount' => $this->postsArchiveCount(),
			'allChronicsCount' => $this->chronicsArchiveCount(),
			'decodage_actu' => $decodage_actu,
			'indisponible' => 'Indisponible'
		);

		// si un utilisateur est connecté on recupère tous les favoris de sa liste de favoris qu'on renvoie à la vue
		if (isset($_SESSION['userData'])){
			$userId = $_SESSION['userData']->userId;
			$favoritesList = $this->posts_model->getPostIdFromFavorites($userId)->result();
			$data['favoritesList'] = $favoritesList;
		}

		if (isset($_SESSION['userData'])){
			$this->load->view('templates/headerLogged', $data);
		}
		else {
			$this->load->view('templates/header', $data);
		}
		$this->load->view('templates/index', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * sélectionne toutes les revues de presse de la table posts
	 */
	 public function postsArchive()
	 {
		 $total_rows = $this->postsArchiveCount();
		 $config = array(
 			'base_url' =>  base_url('revues-de-presse/archive/'),
 			'total_rows' => $total_rows,
 			'per_page' => 4,
 			'uri_segment' => 3,  //deuxième segment de l'url
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
 		$offset = $this->uri->segment(3, 0);
 		// initialisation de la pagination
 		$this->pagination->initialize($config);

		 $allPosts = $this->posts_model->getArchives("posts", "post", $limit, $offset)->result();
		 $data = array(
			 'headerTitle' => 'Archives',
			 'mainTitle'=> 'Toutes nos revues de presse',
			 'allPosts' => $allPosts,
			 'noPosts' => "Archive revue de presse vide"
		 );

		 if (isset($_SESSION['userData'])){
			 $this->load->view('templates/headerLogged', $data);
		 }
		 else {
			 $this->load->view('templates/header', $data);
		 }
		 $this->load->view('templates/postsArchiveView', $data);
		 $this->load->view('templates/footer');
	 }


	 /**
	  * Affioche les articles sur le décodage de l'actualité
	  * @return [type] [description]
	  */
	 public function decodageActualite()
	 {
		 // decoupe l'url en segment sur la base du séparateur '/'
 		$uriSegment = explode('/', uri_string());
		if($uriSegment[1] != null) {
			$slug = $uriSegment[1];
		}

		 $decodage_actu = $this->posts_model->getOneActu($slug)->row();
		 //$decodage_actu = null;
		 $data = array(
			 'headerTitle' => 'Actualité',
			 'decodage_actu' => $decodage_actu
		 );

		 if ( isset($_SESSION[ "userData" ]) )
		 {
			 $this->load->view('templates/headerLogged.php', $data);
		 }
		 else
		 {
			 $this->load->view('templates/header.php', $data);
		 }
		 if ( $decodage_actu != null)
		 {
			 $this->load->view('templates/actualiteView.php', $data);
			 $this->load->view('templates/footer.php');
		 }
		 else
		 {
			show_error('Cet article n\'existe pas ou a été supprimé');
		 }

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
	 * sélectionne toutes les chroniques de la table chronics
	 */
	public function chronicsArchive()
	{
		$total_rows = $this->chronicsArchiveCount();
		$config = array(
		   'base_url' =>  base_url('chroniques/archive/'),
		   'total_rows' => $total_rows,
		   'per_page' => 4,
		   'uri_segment' => 3,  //deuxième segment de l'url
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
		$offset = $this->uri->segment(3, 0);
		// initialisation de la pagination
		$this->pagination->initialize($config);


		$allChronics = $this->posts_model->getArchives('chronics', 'chronic', $limit, $offset)->result();
		//$allChronics = null;
		$data['chronicArchive'] = array(
			'headerTitle' => 'Archives',
			'mainTitle'=> 'Toutes nos chroniques',
			'allChronics' => $allChronics,
			'noChronics' => 'Archives chroniques vide'
		);

		if (isset($_SESSION['userData'])){
			$this->load->view('templates/headerLogged', $data['chronicArchive']);
		} else {
			$this->load->view('templates/header', $data['chronicArchive']);
		}
		$this->load->view('templates/chronicsArchiveView', $data['chronicArchive']);
		$this->load->view('templates/footer');
	}


	/**
	 * compte et retourne le nombre total de chroniques dans la table chronics. cette function est utilisée dans la méthode index() de la présente class pour renvoyer à la vue le nombre de chroniques
	 * @return Int nombre de chroniques
	 */
	public function chronicsArchiveCount():Int
	{
		return $this->posts_model->getArchives('chronics', 'chronic')->num_rows();
	}



	/**
	 * affiche un article tout seul
	*/
	public function singleView()
	{
		// url de redirection apres login
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());
		if($uriSegment[3] != null) {
			$slug = $uriSegment[3];
		}
		// variables à transmettre à la vue
		$post = $this->posts_model->getOnePost($slug)->row();
		if ($post != null) {
			$_SESSION['post']['post_id'] = $post->postId;
		}
		$headerTitle = $uriSegment[3] . ' / Rubrique ' . $this->page;

		$data = array(
			'headerTitle' => $headerTitle,
			'post'=> $post
		);

		// si un tutilisateur est connectéon on recupère tous les postId de sa liste de favoris
		if (isset($_SESSION['userData'])){
			// on ajoute à $data les id de toutes les revues ajoutées aux favoris par un utilisateur donné. Ces id sont utilisés dans la page singleView ajouter un petit coeur aux revues favorites de l'utilisateur
			$userId = $_SESSION['userData']->userId;
			$favoritesList = $this->posts_model->getPostIdFromFavorites($userId)->result();

			$data['favoritesList'] = $favoritesList;
		}

		if (isset($_SESSION['userData']))
		{
			$this->load->view('templates/headerLogged', $data);
		}
		else
		{
			$this->load->view('templates/header', $data);
		}
		if ($post != null)
		{
			$this->load->view('templates/singleView', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			show_error('Cet article n\'existe pas ou a été supprimé');
		}
	}

	/**
	 * affiche une chronique toute seule
	*/
	public function chronicView()
	{
		// url de redirection apres login
		if (!isset($_SESSION['userData'])) {
			$_SESSION['urlRedirect'] = $_SERVER['PATH_INFO'];
		}

		// decoupe l'url en segment sur la base du séparateur '/'
		$uriSegment = explode('/', uri_string());
		if($uriSegment[3] != null) {
			$slug = $uriSegment[3];
		}
		//variables à transmetre à la vue
		$chronic = $this->posts_model->getOneChronic(array( 'chronicSlug' => $slug ))->row();
		if ($chronic != null) {
			$_SESSION['post']['chronic_id'] = $chronic->chronicId;
		}
		$headerTitle = $uriSegment[3] . ' / Rubrique ' . $this->page;

		$data = array(
			'headerTitle' => $headerTitle,
			'chronic'=> $chronic
		);

		// si un utilisateur est connecté  on recupère tous les chronicId de sa liste de favoris
		if (isset($_SESSION['userData'])){

			$userId = $_SESSION['userData']->userId;

			$favoritesList = $this->posts_model->getChronicIdFromFavorites($userId)->result();

			$data['favoritesList'] = $favoritesList;
		}

		if (isset($_SESSION['userData'])) {
			$this->load->view('templates/headerLogged', $data);
		}
		else {
			$this->load->view('templates/header', $data);
		}
		if ($chronic != null )
		{
			$this->load->view('templates/chronicView', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			show_error('Cet article n\'existe pas ou a été supprimé');
		}
	}


}


 ?>
