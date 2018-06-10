<?php
/**
 *
 */
class Debat extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * affiche la vue de l'accueil de débat
	 * @return [type] [description]
	 */
	public function index()
	{
		$total_rows = $this->posts_model->getDebatsInfos()->num_rows();
		$config = array(
		   'base_url' =>  base_url('debat/'),
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
		$offset = $this->uri->segment(2, 0);
		// initialisation de la pagination
		$this->pagination->initialize($config);

		$debats = $this->posts_model->getDebatsInfos($limit, $offset, 1)->result();
		//$debats = null;
		$data = array(
			'headerTitle' => 'Débat',
			'debats' => $debats,
			'noDebats' => 'Aucun débat disponible'
		);

		if (isset($_SESSION["userData"]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		$this->load->view('templates/debatIndex.php', $data);
		$this->load->view('templates/footer.php');
	}

/**
 * affiche la vue d'un débat
 * @return [type] [description]
 */
	public function showDebat()
	{
		$segment = explode('/', uri_string());
		$slug = $segment[1];

		$debat_infos = $this->posts_model->getOneDebatInfos($slug)->row();
		$question_answer = $this->posts_model->getOneDebatContent($slug)->result();
		//$question_answer = null;

		$data = array(
				'headerTitle' => 'Débat',
				'debat_infos' => $debat_infos,
				'question_answer'	=> $question_answer
		);

		if (isset($_SESSION["userData"]))
		{
			$this->load->view('templates/headerLogged.php', $data);
		}
		else
		{
			$this->load->view('templates/header.php', $data);
		}
		if ($question_answer != null)
		{
			$this->load->view('templates/singleDebatView.php', $data);
			$this->load->view('templates/footer.php');
		}
		else
		{
			show_error('Cet article n\'existe pas ou a été supprimé');
		}
	}
}
