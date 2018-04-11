<div class="content">
	<main class="main main-post">
		<?php if (!empty($post)) {
			 	foreach ($post as $row) : ?>
				<!-- Button trigger favorisModal -->
				<div class="favoris">
					<button type="button" class="btn btn-lg btn-sm btn-favoris" data-toggle="modal" data-target="#favorisModal<?= $row->postId ?>">
						Favoris
					</button>
				</div>

				<!-- favorisModal -->
				<div class="modal fade fModal" id="favorisModal<?= $row->postId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header header">
								<h5 class="modal-title" id="exampleModalLabel">Ajouter aux favoris</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body body">
								<p>Pays: <?= $row->countryName ?></p>
								<p>Rubrique: <?= $row->categoryName ?></p>
								<h2><?= $row->postTitle ?></h2>
							</div>
							<div class="modal-footer footer">
								<button type="button" id="modalCancel" class="btn btn-secondary btn-lg btn-sm" data-dismiss="modal">Annuler</button>
								<a  id="addPostFavorite" class="btn btn-success btn-lg btn-sm" role="button" aria-pressed="true" href="<?= base_url('connexion/formulaire') ?>" data-postId="<?= $row->postId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Ajouter</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /modal -->

				<div class="singlePost">
					<p><strong>Pays:</strong> <?= $row->countryName ?></p>
					<p><strong>Rubrique:</strong> <?= $row->categoryName ?></p>
					<!-- icone favoris -->
					<h2><?= $row->postTitle ?>
						<?php if (isset($favoritesList)) {
							foreach ($favoritesList as $row1):
								if ($row->postId == $row1->postId) : ?>
								<i class="fa fa-heart fa-coeur"></i>
								<?php endIf; ?>
							<?php endforeach;
						} ?>
					</h2>

					<div class="auteur">
						<p><strong>Par</strong></p>
						<p><img class="avatar"  src=<?= '/myProjet/webroot/images/usersAvatar/' . $row->writerAvatar ?> alt="avatar"></p>
						<p><?= $row->writerFirstName." ".$row->writerLastName ?> <strong>le</strong> <?= $row->postDate ?></p>
					</div>
					<p class="postContent"><?= $row->postContent ?></p>
					<div class="source">
						<h2>Sources de la revue</h2>
						<p class="sourceItems"><?= $row->postSource ?></p>
					</div>
				</div>

				<!-- formulaire de commentaire -->
				<form class="comment" action="" method="post">
					<label for="comment">Ajouter un commentaire</label>
					<textarea id="comment" name="comment" rows="2" cols="70"></textarea>
					<input type="hidden" id="parentCommentId" name="parentCommentId" value="0">
				</form>
				<a id="addPostComment" class="btn btn-lg btn-sm btn-primary" href="<?= base_url('connexion/formulaire') ?>" data-postId="<?= $row->postId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Valider</a>
				<!-- liste des commentaires -->
				<div id="displayPostComments" class="displayComments">

				</div>
			<?php endforeach;
		} else //si la requête renvoie aucun article on redirige vers la liste des articles
		{
			redirect('culture');
		} ?>
	</main>
</div>
