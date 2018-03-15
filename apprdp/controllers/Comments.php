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
	public function index()
	{
		//paramètres de la requête sql permettant de sélectioner les commentaires liés à un artice donné.
		$queryParams = array(
			'select' => 'commentId, commentContent, parentCommentId, commentDate, userFirstName, userLastName, userAvatar',

			'join1' => 'users',
			'on1' => 'posts_comments.userId = users.userId',
			'inner1' => 'inner',

			'where' => array('postId' => $_GET['postId']),

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

		echo json_encode($comments);

	}

	/**
	 * traitement des données envoyées par la requête ajaxet insertion du commentaire dans la base de données.
	 */
	public function addComment()
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
}

 ?>
