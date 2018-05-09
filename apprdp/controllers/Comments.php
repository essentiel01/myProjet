<?php
/**
 *
 */
class Comments extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// $this->load->model('posts_model');
	}


/**
 * permet d'afficher tous les commentaires d'un article via une requête ajax.
 */
	public function postComments()
	{
		$postId = $_SESSION["post"]["post_id"];
		$_SESSION['comment']['offset'] = 0;
		$_SESSION['comment']['count'] = count($this->posts_model->getPostsComments($postId)->result());

		$comments = $this->posts_model->getPostsComments($postId, 2, 0)->result();

		$commentById = [];

		foreach ($comments as  $comment) {
			$commentById[$comment->commentId] = $comment;
		}

		foreach ($comments as $key=>$comment) {
			if ($comment->parentCommentId != 0){
				$commentById[$comment->parentCommentId]->children[] = $comment;
				unset($comments[$key]);
			}
		}
		echo json_encode($comments);
	}

	/**
	 * affiche les commentaires par lot
	 * @return [type] [description]
	 */
	public function morePostComments()
    {
		$postId = $_SESSION["post"]["post_id"];
		$count = $_SESSION['comment']['count'];
		$offset = $_SESSION['comment']['offset']+=2;
		// var_dump($_SESSION['comment']);
		if ($_SESSION['comment']['offset'] >= ($_SESSION['comment']['count'] - 2)) {
			exit;
		}
    	$comments = $this->posts_model->getPostsComments($postId, 2, $offset)->result();

		$commentById = [];

		foreach ($comments as  $comment) {
			$commentById[$comment->commentId] = $comment;
		}

		foreach ($comments as $key=>$comment) {
			if ($comment->parentCommentId != 0){
				$commentById[$comment->parentCommentId]->children[] = $comment;
				unset($comments[$key]);
			}
		}
		echo json_encode($comments);
    }


	/**
	 * Affiche les commentaires des chroniques par lot
	 * @return [type] [description]
	 */
	public function moreChronicComments()
	{
		$chronicId = $_SESSION["post"]["chronic_id"];
		if ($_SESSION['comment']['offset'] >= ($_SESSION['comment']['count'] - 2)) {
			exit;
		}
		$offset = $_SESSION['comment']['offset']+=2;
		$comments = $this->posts_model->getChronicsComments($chronicId, 2, $offset)->result();

		$commentById = [];

		foreach ($comments as  $comment) {
			$commentById[$comment->commentId] = $comment;
		}
		foreach ($comments as $key=>$comment) {
			if ($comment->parentCommentId != 0){
				$commentById[$comment->parentCommentId]->children[] = $comment;
				unset($comments[$key]);
			}
		}
		echo json_encode($comments);
	}
	/**
	 * permet d'afficher tous les commentaires d'une chronique via une requête ajax.
	 */
		public function chronicComments()
		{
			$chronicId = $_SESSION["post"]["chronic_id"];
			$_SESSION['comment']['offset'] = 0;
			$_SESSION['comment']['count'] = count($this->posts_model->getChronicsComments($chronicId)->result());

			$comments = $this->posts_model->getChronicsComments($chronicId, 2, 0)->result();

			$commentById = [];

			foreach ($comments as  $comment) {
				$commentById[$comment->commentId] = $comment;
			}
			foreach ($comments as $key=>$comment) {
				if ($comment->parentCommentId != 0){
					$commentById[$comment->parentCommentId]->children[] = $comment;
					unset($comments[$key]);
				}
			}
			echo json_encode($comments);

		}

	/**
	 * traitement des données envoyées par la requête ajaxet insertion du commentaire dans la base de données.
	 */
	public function addPostComment()
	{
		if (isset($_POST['comment']) && trim($_POST['comment'], '') != ''){
			$dataToSave = array(
				'commentContent' => $_POST['comment'],
				'parentCommentId' => $_POST['parentCommentId'],
				'postId' => $_POST['postId'],
				'userId' => $_POST['userId']
			);

			$this->posts_model->saveNew($dataToSave, 'posts_comments');
		}

	}


	/**
	 * traitement des données envoyées par la requête ajaxet insertion du commentaire des chroniques dans la base de données.
	 */
	public function addChronicComment()
	{
		if (isset($_POST['comment']) && trim($_POST['comment'], '') != ''){
			$dataToSave = array(
				'commentContent' => htmlentities($_POST['comment']),
				'parentCommentId' => $_POST['parentCommentId'],
				'chronicId' => $_POST['chronicId'],
				'userId' => $_POST['userId']
			);

			$this->posts_model->saveNew($dataToSave, 'chronics_comments');
		}

	}
}

 ?>
