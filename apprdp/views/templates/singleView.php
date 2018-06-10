<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url($post->categoryName) ?>"><?= $post->categoryName ?></a></li>
			<li class="breadcrumb-item active" aria-current="page">
			<?= $post->postTitle ?>
			</li>
		</ol>
	</nav>
	<main class="main main-post">
		<!-- Button trigger favorisModal -->
		<div class="favoris">
			<button type="button" class="btn btn-lg btn-sm btn-favoris" data-toggle="modal" data-target="#favorisModal<?= $post->postId ?>">
				Favoris
			</button>
		</div>

		<!-- favorisModal -->
		<div class="modal fade fModal" id="favorisModal<?= $post->postId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header header">
						<h5 class="modal-title" id="exampleModalLabel">Ajouter aux favoris</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body body">
						<p>Pays: <?= $post->countryName ?></p>
						<p>Rubrique: <?= $post->categoryName ?></p>
						<h2><?= $post->postTitle ?></h2>
					</div>
					<div class="modal-footer footer">
						<button type="button" id="modalCancel" class="btn btn-secondary btn-lg btn-sm" data-dismiss="modal">Annuler</button>
						<a  id="addPostFavorite" class="btn btn-success btn-lg btn-sm" role="button" aria-pressed="true" href="<?= base_url('connexion/formulaire') ?>" data-postId="<?= $post->postId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Ajouter</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /modal -->

		<div class="singlePost">
			<h1><?= $post->postTitle ?>
				<?php if (isset($favoritesList)) {
					foreach ($favoritesList as $row1):
						if ($post->postId == $row1->postId) : ?>
						<!-- icone favoris -->
						<i class="fa fa-heart coeur"></i>
						<?php endIf; ?>
					<?php endforeach;
				} ?>
			</h1>
			<p><?= strtoupper($post->countryName) ?> - <?= $post->categoryName ?></p>
			<p>Publié le <?= $post->postDate ?></p>
			<img src="/myProjet/webroot/images/web_medias/<?= $post->image ?>" alt="post image">

			<p class="postContent"><?= $post->postContent ?></p>
			<div class="auteur">
				<img class="avatar"  src=<?= '/myProjet/webroot/images/usersAvatar/' . $post->userAvatar ?> alt="avatar">
				<p><?= $post->userFirstName." ".$post->userLastName ?></p>
			</div>
			<div class="source">
				<h2>Sources de la revue</h2>
				<p class="sourceItems"><?= $post->postSource ?></p>
			</div>
		</div>

		<!-- formulaire de commentaire -->
		<form class="comment" action="" method="post">
			<div class="">
				<label for="comment">Ajouter un commentaire</label>
			</div>
			<textarea id="comment" name="comment" rows="4" cols="70"></textarea>
			<input type="hidden" id="parentCommentId" name="parentCommentId" value="0">
			<div class="btn-addPostComment">
				<a id="addPostComment" class="btn btn-lg btn-primary" href="<?= base_url('connexion/formulaire') ?>" data-postId="<?= $post->postId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Valider</a>
			</div>
		</form>

		<!-- liste des commentaires -->
		<div id="displayPostComments" class="displayComments">

		</div>
		<div id="moreComments" class="moreComments"><a id="morePostComments" href="#">Plus de commentaires</a></div>
	</main>
</div>
