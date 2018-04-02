<?php
/**
 *
 */
class Comments extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
	}


/**
 * permet d'afficher tous les commentaires d'un article via une requête ajax.
 */
	public function postComments()
	{
		//paramètres de la requête sql permettant de sélectioner les commentaires liés à un artice donné.
		$queryParams = array(
			'select' => 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar',

			'join1' => 'users',
			'on1' => 'posts_comments.userId = users.userId',
			'inner1' => 'inner',

			'where' => array('postId' => $_POST['postId']),

			'order' => 'commentDate DESC'
		);

		$comments = $this->posts_model->getComments('posts_comments', $queryParams)->result();

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

		//var_dump($comments);
		$output = '';
		foreach ($comments as $row) {
			$output .= '<div class="eachComment"><div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div> <div class="commentContent">' . $row->commentContent . '</div></div><div class="btnReply"><button type="button" class="reply btn btn-lg btn-sm btn-primary" data-commentId=' . $row->commentId . '>Répondre</button></div>';
			if (isset($row->children)) {
				foreach ($row->children as $row) {
					$output .= '<div class="eachReply"><div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div> <div class="commentContent">' . $row->commentContent . '</div></div>';
				}
			}
		}
		echo $output;
	}



	/**
	 * permet d'afficher tous les commentaires d'une chronique via une requête ajax.
	 */
		public function chronicComments()
		{
			//paramètres de la requête sql permettant de sélectioner les commentaires liés à un artice donné.
			$queryParams = array(
				'select' => 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar',

				'join1' => 'users',
				'on1' => 'chronics_comments.userId = users.userId',
				'inner1' => 'inner',

				'where' => array('chronicId' => $_POST['chronicId']),

				'order' => 'commentDate DESC'
			);

			$comments = $this->posts_model->getComments('chronics_comments', $queryParams)->result();

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
			// var_dump($comments);
			$output = '';
			foreach ($comments as $row) {
				$output .= '<div class="eachComment"><div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div> <div class="commentContent">' . $row->commentContent . '</div></div><div class="btnReply"><button type="button" class="reply btn btn-lg btn-sm btn-primary" data-commentId=' . $row->commentId . '>Répondre</button></div>';
				if (isset($row->children)) {
					foreach ($row->children as $row) {
						$output .= '<div class="eachReply";"><div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div> <div class="commentContent">' . $row->commentContent . '</div></div>';
					}
				}
			}
			echo $output;
		}

	/**
	 * traitement des données envoyées par la requête ajaxet insertion du commentaire dans la base de données.
	 */
	public function addPostComment()
	{
		if (isset($_POST['comment']) && trim($_POST['comment'], '') != ''){
			$dataToSave = array(
				'commentContent' => htmlentities($_POST['comment']),
				'parentCommentId' => $_POST['parentCommentId'],
				'postId' => $_POST['postId'],
				'userId' => $_POST['userId']
			);

			$this->posts_model->saveNew('posts_comments', $dataToSave);
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

			$this->posts_model->saveNew('chronics_comments', $dataToSave);
		}

	}
}

 ?>
