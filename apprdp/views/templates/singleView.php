<div class="content">
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
					<p><strong>Pays:</strong> <?= $post->countryName ?></p>
					<p><strong>Rubrique:</strong> <?= $post->categoryName ?></p>
					<!-- icone favoris -->
					<h2><?= $post->postTitle ?>
						<?php if (isset($favoritesList)) {
							foreach ($favoritesList as $row1):
								if ($post->postId == $row1->postId) : ?>
								<i class="fa fa-heart fa-coeur"></i>
								<?php endIf; ?>
							<?php endforeach;
						} ?>
					</h2>

					<div class="auteur">
						<p><strong>Par</strong></p>
						<p><img class="avatar"  src=<?= '/myProjet/webroot/images/usersAvatar/' . $post->writerAvatar ?> alt="avatar"></p>
						<p><?= $post->writerFirstName." ".$post->writerLastName ?> <strong>le</strong> <?= $post->postDate ?></p>
					</div>
					<p class="postContent"><?= $post->postContent ?></p>
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
	</main>
</div>
