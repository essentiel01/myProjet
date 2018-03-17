<div class="container">
	<main>
		<h2><?= $mainTitle ?></h2>
		<!-- si la liste des favoris n'est pas vide on l'affiche -->
		<?php if(!empty($favoritesList)) {
			foreach ($favoritesList as $row) : ?>
				<form class="" method="post" action="<?= base_url('favorites/deletechronic') ?>">
					<input type="checkbox" name="favoriteCheckbox" value="">
					<input type="hidden" name="chronicId" value="<?= $row->chronicId ?>">
					<p><?= $row->countryName ?></p>
					<p>Rubrique: <?= $row->categoryName ?></p>
					<p>Titre: <?= $row->chronicTitle ?></p>
					<div class="">
						<a href="<?= base_url('culture/publication/' . $row->chronicId . '/' . $row->chronicSlug); ?>" class="btn btn-success btn-lg">Lire</a>
						<!-- Button trigger audioModal -->
						<!-- <a href="#" class="btn btn-success btn-lg " role="button" data-toggle="modal" data-target="#audioModal<?= $row->chronicId ?>" aria-pressed="true">Ecouter</a> -->
						<input type="submit"  class="btn btn-danger btn-lg" value="Supprimer" />
					</div>
					<!-- audioModal -->
					<!-- <div class="modal fade" id="audioModal<?= $row->chronicId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Ecouter la chronique</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<audio controls  src="<?= base_url('webroot/audio/' . $row->chronicAudio . '.ogg'); ?>"></audio>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
									<a <?php if(!isset($_SESSION['userData']->userId)) {
										echo 'href=' . base_url('connexion/formulaire');
									} else {
										echo 'href=' . base_url('webroot/audio/' . $row->chronicAudio . '.ogg') . ' download=' . $row->chronicAudio;
									}
									?> role="button" class="btn btn-primary" >
									Télécharger
									</a>
								</div>
							</div>
						</div>
					</div> -->
				</form>
			<?php endforeach ;
			// pagination
			echo $this->pagination->create_links();
		} else {
			// sinon on affiche un message de liste vide
			if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
		} ?>

	</main>
</div>
