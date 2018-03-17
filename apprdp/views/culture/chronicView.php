<div class="container">
	<main class="mainWrapper">
		<?php if (!empty($chronic) {
			foreach ($chronic as $row) : ?>
			<!-- Button trigger favorisModal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#favorisModal<?= $row->chronicId ?>">
				Favoris
			</button>

			<!-- favorisModal -->
			<div class="modal fade" id="favorisModal<?= $row->chronicId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Ajouter aux favoris</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Pays: <?= $row->countryName ?></p>
							<p>Rubrique: <?= $row->categoryName ?></p>
							<h2><?= $row->chronicTitle ?></h2>
						</div>
						<div class="modal-footer">
							<button type="button" id="modalCancel" class="btn btn-secondary btn-lg" data-dismiss="modal">Annuler</button>
							<a  id="addChronicFavorite" class="btn btn-success btn-lg " role="button" aria-pressed="true" href="<?= base_url('connexion/formulaire') ?>" data-chronicId="<?= $row->chronicId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Ajouter</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /modal -->

			<p>Pays: <?= $row->countryName ?></p>
			<p>Rubrique: <?= $row->categoryName ?></p>
			<h2><?= $row->chronicTitle ?></h2>

			<!-- compare le postId à chaque postId de la liste des revues qui sont dans les favoris. s'il y a un qui correspond alors on ajoute un petit coeur pour signifier que cet article fait déjà partie des favoris  -->
			<?php if (isset($favoritesList)) {
				foreach ($favoritesList as $row1):
					if ($row->chronicId == $row1->chronicId) : ?>
					<i class="fa fa-heart"></i>
					<?php endIf; ?>
				<?php endforeach;
			} ?>

			<p>Publié par:</p>
			<p><img width="8%" src=<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?> alt="avatar"></p>
			<p><?= $row->writerFirstName .' '. $row->writerLastName ?> le <?= $row->chronicDate ?></p>
			<p><?= $row->chronicContent ?></p>

			<!-- formulaire de commentaire -->
			<form class="" action="" method="post">
				<label for="comment">Ajouter un commentaire</label>
				<textarea id="comment" name="comment" rows="2" cols="70"></textarea>
				<input type="hidden" id="parentCommentId" name="parentCommentId" value="0">
			</form>
			<a id="addChronicComment" class="btn btn-lg btn-primary" href="<?= base_url('connexion/formulaire') ?>" data-chronicId="<?= $row->chronicId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Valider</a>
			<!-- liste des commentaires -->
			<div id="displayChronicComments" class="displayComments">

			</div>
		<?php endforeach
		else {
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
