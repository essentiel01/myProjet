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

private function postCommentsQueryParams():array
{
	//paramètres de la requête sql permettant de sélectioner les commentaires liés à un artice donné.
	return array(
		'select' => 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar',

		'join1' => 'users',
		'on1' => 'posts_comments.userId = users.userId',
		'inner1' => 'inner',

		'where' => array('postId' => $_SESSION['post']['post_id']),

		'order' => 'commentDate DESC'

	);
}

/**
 * permet d'afficher tous les commentaires d'un article via une requête ajax.
 */
	public function postComments()
	{
		$_SESSION['comment']['offset'] = 0;
		$_SESSION['comment']['count'] = count($this->posts_model->getComments($this->postCommentsQueryParams(), 'posts_comments')->result());
		$comments = $this->posts_model->getComments($this->postCommentsQueryParams(), 'posts_comments',2, 0)->result();

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

		$output = '<div id="postCommentsBlock" class="commentsBlock">';
		foreach ($comments as $row) {
			$output .= '<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">
						<div class="eachComment">
							<div>
								<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
								<div class="commentContent">' . $row->commentContent . '</div>
							</div>
						</div>
			<div class="btnReply">
				<button type="button" class="reply btn btn-lg btn-primary" data-commentId=' . $row->commentId . '>Répondre</button>
			</div>';
			if (isset($row->children)) {
				foreach ($row->children as $row) {
					$output .= '<div class="eachReply">
						<div>
							<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
							<div class="commentContent">' . $row->commentContent . '</div></div>
						</div>
						<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">';
				}
			}
		}
		$output .= '</div>
		<div class="moreComments">
			<a id="morePostComments" href="#">Plus de commentaires</a>
		</div>';
		echo $output;
	}

	/**
	 * affiche les commentaires par lot
	 * @return [type] [description]
	 */
	public function morePostComments()
    {
		// var_dump($_SESSION['comment']);
		if ($_SESSION['comment']['offset'] >= ($_SESSION['comment']['count'] - 2)) {
			exit;
		}
    	$comments = $this->posts_model->getComments($this->postCommentsQueryParams(), 'posts_comments', 2, $_SESSION['comment']['offset']+=2)->result();

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

		$output = '<div id="postCommentsBlock" class="commentsBlock">';
		foreach ($comments as $row) {
			$output .= '<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">
						<div class="eachComment">
							<div>
								<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
								<div class="commentContent">' . $row->commentContent . '</div>
							</div>
						</div>
			<div class="btnReply">
				<button type="button" class="reply btn btn-lg btn-primary" data-commentId=' . $row->commentId . '>Répondre</button>
			</div>';
			if (isset($row->children)) {
				foreach ($row->children as $row) {
					$output .= '<div class="eachReply">
						<div>
							<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
							<div class="commentContent">' . $row->commentContent . '</div></div>
						</div>
						<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">';
				}
			}
		}
		$output .= '</div>';
		echo $output;

    }

	private function chronicCommentsQueryParams()
	{
		//paramètres de la requête sql permettant de sélectioner les commentaires liés à un artice donné.
		return array(
			'select' => 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar',
			'join1' => 'users',
			'on1' => 'chronics_comments.userId = users.userId',
			'inner1' => 'inner',
			'where' => array('chronicId' => $_SESSION['post']['chronic_id']),
			'order' => 'commentDate DESC'
		);
	}
	/**
	 * Affiche les commentaires des chroniques par lot
	 * @return [type] [description]
	 */
	public function moreChronicComments()
	{
		if ($_SESSION['comment']['offset'] >= ($_SESSION['comment']['count'] - 2)) {
			exit;
		}
		$comments = $this->posts_model->getComments($this->chronicCommentsQueryParams(), 'chronics_comments', 2, $_SESSION['comment']['offset']+=2)->result();

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
		$output = '<div id="chronicCommentsBlock" class="commentsBlock">';
		foreach ($comments as $row) {
			$output .= '<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">
						<div class="eachComment">
							<div>
								<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
								<div class="commentContent">' . $row->commentContent . '</div>
							</div>
						</div>
			<div class="btnReply">
				<button type="button" class="reply btn btn-lg btn-primary" data-commentId=' . $row->commentId . '>Répondre</button>
			</div>';
			if (isset($row->children)) {
				foreach ($row->children as $row) {
					$output .= '<div class="eachReply">
						<div>
							<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
							<div class="commentContent">' . $row->commentContent . '</div></div>
						</div>
						<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">';
				}
			}
		}
		$output .= '</div>';
		echo $output;
	}
	/**
	 * permet d'afficher tous les commentaires d'une chronique via une requête ajax.
	 */
		public function chronicComments()
		{
			$_SESSION['comment']['offset'] = 0;
			$_SESSION['comment']['count'] = count($this->posts_model->getComments($this->chronicCommentsQueryParams(), 'chronics_comments')->result());
			$comments = $this->posts_model->getComments($this->chronicCommentsQueryParams(), 'chronics_comments', 2, 0)->result();

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
			$output = '<div id="chronicCommentsBlock" class="commentsBlock">';
			foreach ($comments as $row) {
				$output .= '<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">
							<div class="eachComment">
								<div>
									<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
									<div class="commentContent">' . $row->commentContent . '</div>
								</div>
							</div>
				<div class="btnReply">
					<button type="button" class="reply btn btn-lg btn-primary" data-commentId=' . $row->commentId . '>Répondre</button>
				</div>';
				if (isset($row->children)) {
					foreach ($row->children as $row) {
						$output .= '<div class="eachReply">
							<div>
								<div class="auteur">' . $row->userFirstName . ' ' . $row->userLastName . ' le ' . $row->commentDate . '</div>
								<div class="commentContent">' . $row->commentContent . '</div></div>
							</div>
							<img class="avatar-mini-comment"  src="/myProjet/webroot/images/usersAvatar/' . $row->userAvatar . '.png" alt="avatar">';
					}
				}
			}
			$output .= '</div>
			<div class="moreComments">
				<a id="moreChronicComments" href="#">Plus de commentaires</a>
			</div>';
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
