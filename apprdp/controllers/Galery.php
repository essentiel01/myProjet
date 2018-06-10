<?php
/**
 *
 */
class Galery extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * affiche la galerie de medias
	 * @return [type] [description]
	 */
	public function showImages()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$medias = $this->posts_model->getImages()->result();
			$data = array(
				'medias' => $medias
			);

			$this->load->view('galery/header.php', $data);
			$this->load->view('galery/indexImages.php', $data);
			$this->load->view('admin/footer.php');
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	public function showAudios()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$audios = $this->posts_model->getAudios()->result();
			$data = array(
				'audios' => $audios
			);

			$this->load->view('galery/header.php', $data);
			$this->load->view('galery/indexAudios.php', $data);
			$this->load->view('admin/footer.php');
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

}
