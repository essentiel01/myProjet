<?php
/**
 *
 */
class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * affiche le tableau de bord pour les rédacteurs
	 * @return [type] [description]
	 */
	public function teamDashboard()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
		$this->load->view('admin/header.php');
		$this->load->view('admin/dashboard.php');
		$this->load->view('admin/footer.php');
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * affiche le formulaire d'ajout d'une nouvelle revue de presse
	 * @return [type] [description]
	 */
	public function addPostForm()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$categories = $this->posts_model->getCategories()->result();
			$countries = $this->posts_model->getCountries()->result();
			//var_dump($countries);
			$data = array(
				"categories" => $categories,
				"countries" => $countries
			);
			$this->load->view("admin/header.php");
			$this->load->view("admin/addPostForm.php", $data);
			$this->load->view("admin/footer.php");
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * ajoute une revue de presse
	 * @return [type] [description]
	 */
	public function savePost()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$post = array(
					'postTitle' => $_POST['postTitle'],
					'postSlug' => $_POST['postSlug'],
					'image' => $_POST['image'],
					'postAudio' => $_POST['postAudio'],
					'postContent' => $_POST['postContent'],
					'postSource' => $_POST['postSources'],
					'postCategory' => $_POST['postCategory'],
					'postCountry' => $_POST['postCountry'],
					'user_id' => $_POST['user_id']
				);

				try
				{
					$this->posts_model->saveNew($post, 'posts');
				}
				catch (Exception $e)
				{
					var_dump($e);
					//echo $e->getMessage();
				}

				try {
					//recuppère l'id du dernier post enregistré
					if ($this->posts_model->getOnePost($post['postSlug'])->row() != null)
					{
						$post_id = $this->posts_model->getOnePost($post['postSlug'])->row()->postId;
					}

					$image_url_segment = explode('/', $post['image']);
					$image_name = explode('"', $image_url_segment[5])[0];
					if ($this->posts_model->getOneImage(array('name' => $image_name))->row() != null)
					{
						$image_id = $this->posts_model->getOneImage(array('name' => $image_name))->row()->id;
					}

					$dataToPostsImages = array(
						'post_id' => $post_id,
						'image_id' => $image_id
					);
					$this->posts_model->saveNew($dataToPostsImages, 'posts_images');
				}
				 catch (\Exception $e) {

				}
				redirect('inside/team/revue-de-presse/ajouter');
			}
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * affiche le formulaire d'ajout de chronique
	 * @var [type]
	 */
	public function addChronicForm()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$categories = $this->posts_model->getCategories()->result();
			$countries = $this->posts_model->getCountries()->result();
			//var_dump($countries);
			$data = array(
				"categories" => $categories,
				"countries" => $countries
			);
			$this->load->view("admin/header.php");
			$this->load->view("admin/addChronicForm.php", $data);
			$this->load->view("admin/footer.php");
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * enregistre une nouvelle chronique
	 * @return [type] [description]
	 */
	public function saveChronic()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$chronic = array(
					'chronicTitle' => $_POST['chronicTitle'],
					'chronicSlug' => $_POST['chronicSlug'],
					'chronicContent' => $_POST['chronicContent'],
					'chronicCategory' => $_POST['chronicCategory'],
					'chronicCountry' => $_POST['chronicCountry'],
					'user_id' => $_POST['user_id']
				);

				try
				{
					$this->posts_model->saveNew($chronic, 'chronics');
				}
				catch (Exception $e)
				{
					var_dump($e);
					//echo $e->getMessage();
				}
				redirect('inside/team/chronique/ajouter');
			}
		}
	}

	/**
	 * affiche leformulaire d'ajout des analyses de l'actualité
	 */
	public function addDecodageActuForm()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$this->load->view("admin/header.php");
			$this->load->view("admin/addDecodageActuForm.php");
			$this->load->view("admin/footer.php");
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * enregistre une nouvelle analyse de l'actu
	 * @return [type] [description]
	 */
	public function saveDecoActu()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$deco_actu = array(
					'title' => $_POST['title'],
					'slug' => $_POST['slug'],
					'content' => $_POST['content'],
					'user_id' => $_POST['user_id']
				);

				try
				{
					$this->posts_model->saveNew($deco_actu, 'decodage_actu');
				}
				catch (Exception $e)
				{
					var_dump($e);
					//echo $e->getMessage();
				}
				redirect('inside/team/analyse-actualite/ajouter');
			}
		}
	}

	/**
	 * affiche le formulaire d'ajout d'un débat
	 */
	public function addDebatForm()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$this->load->view("admin/header.php");
			$this->load->view("admin/addDebatForm.php");
			$this->load->view("admin/footer.php");
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * enregistre un nouveau debat
	 * @return [type] [description]
	 */
	public function saveDebat()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$debat = array(
					'title' => $_POST['title'],
					'slug' => $_POST['slug'],
					'description' => $_POST['description'],
					'person_1' => $_POST['person_1'],
					'avatar_1' => $_POST['avatar_1'],
					'person_2' => $_POST['person_2'],
					'avatar_2' => $_POST['avatar_2'],
					'user_id' => $_POST['user_id']
				);

				try
				{
					$this->posts_model->saveNew($debat, 'debats');
				}
				catch (Exception $e)
				{
					var_dump($e);
					//echo $e->getMessage();
				}
				redirect('inside/team/debat/ajouter');
			}
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * affichela liste des débats en attente de publication
	 * @return [type] [description]
	 */
	public function debatsOffLine()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$debats_offline = $this->posts_model->getDebatsInfos()->result();
			$data = array(
				'debats_off_line' => $debats_offline
			);
			$this->load->view('admin/header.php');
			$this->load->view('admin/debatsOfflineView.php', $data);
			$this->load->view('admin/footer.php');
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * affiche le formulaire d'ajout de contenu au débat
	 */
	public function addQuestionsAnswersForm()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$debat_id = explode('/', uri_string())[4];
			$data = array(
				'debat_id' => $debat_id
			);
			$this->load->view('admin/header.php');
			$this->load->view('admin/addQuestionsAnswersForm.php', $data);
			$this->load->view('admin/footer.php');
		}
		else
		{
			show_error('Accès refusé !');
		}
	}

	/**
	 * enregistre ls questions et réponses du débat
	 * @return [type] [description]
	 */
	public function saveQuestionsAnswers()
	{
		if (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$question_answer = array(
				'question' => $_POST['question'],
				'answer_1' => $_POST['answer_1'],
				'answer_2' => $_POST['answer_2'],
				'debat_id' => $_POST['debat_id']
			);
			$this->posts_model->saveNew($question_answer, 'questions_answers');
			redirect('inside/team/debat/debats-en-attente/' . $question_answer['debat_id'] . '/ajout-de-contenu');
		}
	}

	/**
	 * affiche les revues de presse en attente de publication
	 * @return [type] [description]
	 */
	public function postsOffline()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$posts_offline = $this->posts_model->getPostsOfflineOrOnline()->result();
			$data = array(
				'posts_offline' => $posts_offline
			);

			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/postsOfflineView.php', $data);
			$this->load->view('admin/footer.php');
		}
	}

	/**
	 * affiche les chroniques en attente de publication
	 * @return [type] [description]
	 */
	public function chronicsOffline()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$chronics_offline = $this->posts_model->getChronicsOfflineOrOnline()->result();
			$data = array(
				'chronics_offline' => $chronics_offline
			);

			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/chronicsOfflineView.php', $data);
			$this->load->view('admin/footer.php');
		}

	}
	/**
	 * publie une revue de presse
	 * @return [type] [description]
	 */
	public function publishPost()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$post_id = $_POST['postId'];
				try
				{
					$this->posts_model->posted('posts', 1, array('postId' => $post_id));
					redirect('inside/team/revue-de-presse/en-attente-de-publication');
				}
				catch(Exception $e)
				{

				}
			}
		}
	}

	/**
	 * publie une chronique
	 * @return [type] [description]
	 */
	public function publishChronic()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			if (isset($_POST))
			{
				$chronic_id = $_POST['chronicId'];
				try
				{
					$this->posts_model->posted('chronics', 1, array('chronicId' => $chronic_id));
					redirect('inside/team/chronique/en-attente-de-publication');
				}
				catch(Exception $e)
				{

				}
			}
		}
	}


	/**
	 * affiche les revues de presse publiées
	 * @return [type] [description]
	 */
	public function postsOnline()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$posts_online = $this->posts_model->getPostsOfflineOrOnline(NULL, NULL, 1)->result();
			$data = array(
				'posts_online' => $posts_online
			);

			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/postsOnlineView.php', $data);
			$this->load->view('admin/footer.php');
		}
	}
	/**
	 * affiche les chroniques publiées
	 * @return [type] [description]
	 */
	public function chronicsOnline()
	{
		if  (isset($_SESSION['userData']) AND $_SESSION['userData']->role == 'team')
		{
			$chronics_online = $this->posts_model->getchronicsOfflineOrOnline(NULL, NULL, 1)->result();
			$data = array(
				'chronics_online' => $chronics_online
			);

			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/chronicsOnlineView.php', $data);
			$this->load->view('admin/footer.php');
		}
	}
}
