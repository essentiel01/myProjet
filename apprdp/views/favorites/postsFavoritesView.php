<div class="container">
	<main class="main">
		<section class="posts">
			<h2><?= $mainTitle ?></h2>
			<!-- si la liste des favoris n'est pas vide on l'affiche -->
			<?php if(!empty($favoritesList)) {
				foreach ($favoritesList as $row) : ?>
					<form class="post" method="post" action="<?= base_url('favorites/deletepost') ?>">
						<input type="checkbox" name="favoriteCheckbox" value="">
						<input type="hidden" name="postId" value="<?= $row->postId ?>">
						<p><strong>Pays: </strong><?= $row->countryName ?></p>
						<p><strong>Rubrique: </strong><?= $row->categoryName ?></p>
						<p><strong>Titre: </strong><?= $row->postTitle ?></p>
						<div class="btnLecture">
							<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>" class="btn btn-success btn-lg btn-sm">Lire</a>
							<!-- Button trigger audioModal -->
							<a href="#" class="btn btn-success btn-lg btn-sm" role="button" data-toggle="modal" data-target="#audioModal<?= $row->postId ?>" aria-pressed="true">Ecouter</a>
							<input type="submit"  class="btn btn-danger btn-lg btn-sm" value="Supprimer" />
						</div>
						<!-- audioModal -->
						<div class="modal fade aModal" id="audioModal<?= $row->postId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header header">
										<h5 class="modal-title" id="exampleModalLabel">Ecouter la revue</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body body">
										<audio controls  src="<?= base_url('webroot/audio/' . $row->postAudio . '.ogg'); ?>"></audio>
									</div>
									<div class="modal-footer footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										<a <?php if(!isset($_SESSION['userData']->userId)) {
											echo 'href=' . base_url('connexion/formulaire');
										} else {
											echo 'href=' . base_url('webroot/audio/' . $row->postAudio . '.ogg') . ' download=' . $row->postAudio;
										}
										?> role="button" class="btn btn-primary" >
										Télécharger
										</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php endforeach ;
				// pagination
				echo $this->pagination->create_links();
			} else {
				// sinon on affiche un message de liste vide
				if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
			} ?>

		</section>
	</main>
</div>
