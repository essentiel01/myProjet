<div class="content">
	<main class="main">
		<?php if (!empty($chronic)) {
			foreach ($chronic as $row) : ?>
			<!-- Button trigger favorisModal -->
			<div class="favoris">
				<button type="button" class="btn btn-favoris" data-toggle="modal" data-target="#favorisModal<?= $row->chronicId ?>">
					Favoris
				</button>
			</div>

			<!-- favorisModal -->
			<div class="modal fade fModal" id="favorisModal<?= $row->chronicId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<h2><?= $row->chronicTitle ?></h2>
						</div>
						<div class="modal-footer footer">
							<button type="button" id="modalCancel" class="btn btn-secondary btn-lg" data-dismiss="modal">Annuler</button>
							<a  id="addChronicFavorite" class="btn btn-success btn-lg " role="button" aria-pressed="true" href="<?= base_url('connexion/formulaire') ?>" data-chronicId="<?= $row->chronicId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Ajouter</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /modal -->

			<div class="singleChronic">
				<p><strong>Pays:</strong> <?= $row->countryName ?></p>
				<p><strong>Rubrique:</strong> <?= $row->categoryName ?></p>
				<!-- icone favoris -->
				<h2><?= $row->chronicTitle ?>
					<?php if (isset($favoritesList)) {
						foreach ($favoritesList as $row1):
							if ($row->chronicId == $row1->chronicId) : ?>
							<i class="fa fa-heart fa-coeur"></i>
							<?php endIf; ?>
						<?php endforeach;
					} ?>
				</h2>

				<div class="auteur">
					<p><strong>Par</strong></p>
					<p><img width="8%" src=<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?> alt="avatar"></p>
					<p><?= $row->writerFirstName .' '. $row->writerLastName ?> <strong>le</strong> <?= $row->chronicDate ?></p>
				</div>
				<p class="chronicContent"><?= $row->chronicContent ?></p>

			</div>
			<!-- formulaire de commentaire -->
			<form class="comment" action="" method="post">
				<label for="comment">Ajouter un commentaire</label>
				<textarea id="comment" name="comment" rows="2" cols="70"></textarea>
				<input type="hidden" id="parentCommentId" name="parentCommentId" value="0">
			</form>
			<a id="addChronicComment" class="btn btn-lg btn-primary" href="<?= base_url('connexion/formulaire') ?>" data-chronicId="<?= $row->chronicId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Valider</a>
			<!-- liste des commentaires -->
			<h4 class="commentTitle">Commentaires</h4>
			<div id="displayChronicComments" class="displayComments">

			</div>
		<?php endforeach;
		} else {
			redirect('culture');
		}?>
	</main><!--
	--><aside class="asideWrapper">

		<!--  slide -->
		<section class="slide">
			<h2>Slide</h2>
		</section>
		<!-- partenaires -->
		<section class="">
			<h2>Les médias partenaires</h2>
		</section>
		<!-- /partenaires -->
	</aside>
</div>
