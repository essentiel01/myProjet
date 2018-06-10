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
		$postId = $_SESSION["post_id"];
		
		$limit = 3;
		$offset = ($_POST['page']-1) * $limit;

		$comments = $this->posts_model->getPostsComments($postId, $limit, $offset)->result();


		foreach ($comments as  $comment) {
			//$commentById[$comment->commentId] = $comment;
			$comment_child = $this->posts_model->getPostsCommentsChild($postId, $comment->commentId)->result();
			foreach ($comment_child as $child) {
				$comment->children[] = $child;
			}
		}
		
		echo json_encode($comments);
	}



	
	/**
	 * permet d'afficher tous les commentaires d'une chronique via une requête ajax.
	 */
		public function chronicComments()
		{
			$chronicId = $_SESSION["chronic_id"];
			$limit = 3;
			$offset = ($_POST['page']-1) * $limit;

			$comments = $this->posts_model->getChronicsComments($chronicId, $limit, $offset)->result();

			foreach ($comments as  $comment) {
				$comment_child = $this->posts_model->getChronicsCommentsChild($chronicId, $comment->commentId)->result();
				foreach ($comment_child as $child) {
					$comment->children[] = $child;
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
