<div class="container">
	<!-- main -->
	<main  class="mainWrapper">
		<section class="post">
			<!-- titre de la page -->
			<h2><?= $mainTitle ?></h2>
				<?php foreach ($result as $row):?>
					<!-- infos de chaque post -->
					<div class="">
						<p><?= $row->countryName ?></p>
						<p>Rubrique: <?= $row->categoryName ?></p>
						<p>Titre: <?= $row->postTitle ?></p>
						<!-- compare le postId à chaque postId de la liste des revues qui sont dans les favoris. s'il y a un qui correspond alors on ajoute un petit coeur pour signifier que cet article fait déjà partie des favoris  -->
						<?php if (isset($favoritesList)) {
							 foreach ($favoritesList as $row1):
								if ($row->postId == $row1->postId) : ?>
									<i class="fa fa-heart"></i>
								<?php endIf; ?>
							<?php endforeach;
						} ?>
						<p>Publié par:</p>
						<img width="8%" src=<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?>  alt="avatar">
						<p><?= $row->writerFirstName . " " . $row->writerLastName ?></p>
						<p>le <strong><?= $row->postPublishingDate ?></strong></p>
						<a href=<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?> class="btn btn-success btn-lg " role="button" aria-pressed="true">Lire</a>
						<!-- Button trigger audioModal -->
						<a href="#" class="btn btn-success btn-lg " role="button" data-toggle="modal" data-target="#audioModal<?= $row->postId ?>" aria-pressed="true">Ecouter</a>


						<!-- audioModal -->
						<div class="modal fade" id="audioModal<?= $row->postId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Ecouter la revue</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
								  <audio controls preload="metadata" src="<?= base_url('webroot/audio/' . $row->postAudio . '.ogg'); ?>"></audio>
						      </div>
						      <div class="modal-footer">
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
					</div>
					<!-- /infos de chaque post -->
				<?php endforeach ?>
				<!-- pagination -->
				<?= $this->pagination->create_links(); ?>
				<!-- /pagination -->
		</section>
	</main><!--
	--><aside class="asideWrapper">
		<!-- chronique -->
		<section class="chronic">
		<?php foreach ($chronic as $row) : ?>
			<h2><span><?= $row->countryName ?>: </span><?= $row->chronicTitle ?></h2>
			<p>Auteur</p>
			<img src=<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?> alt="avatar">
			<p><?= $row->writerFirstName. ' ' .$row->writerLastName ?></p>
			<p>Le <?= $row->chronicDate ?></p>
			<p><?= substr($row->chronicContent, 0, 500); ?><a href=<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug) ?>>...Lire plus</a></p>
		<?php endforeach; ?>
		</section>
		<!-- /chronique -->

		<!--  slide -->
		<section class="slide">
			SLIDER
		</section>
	</aside>
</div>
