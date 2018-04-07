<div class="content">
	<!-- main -->
	<main  class="main">
		<section class="posts">
			<!-- titre de la section -->
			<h2><?= $mainTitle ?></h2>
			<?php foreach ($posts as $row):?>
				<!-- infos de chaque post -->
				<div class="post">
					<p><?= $row->countryName ?></p>
					<!-- <p>Rubrique: <?= $row->categoryName ?></p> -->
					<!-- icone favoris -->
					<h3><?= $row->postTitle ?>
						<?php if (isset($favoritesList)) {
							foreach ($favoritesList as $row1):
								if ($row->postId == $row1->postId) : ?>
								<i class="fa fa-heart fa-coeur"></i>
								<?php endIf; ?>
							<?php endforeach;
						} ?>
					</h3>

					<p class="auteur"><strong>Par:</strong> <?= $row->writerFirstName . " " . $row->writerLastName ?> <strong>le</strong> <?= $row->postDate ?></p>
					<!-- <div class="auteur"> -->
						<!-- <img width="8%" src="<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?>"  alt="avatar"> -->
					<!-- </div> -->
					<div class="btnLecture">
						<a href=<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?> class="btn btn-success btn-lg btn-sm" role="button" aria-pressed="true">Lire</a>
						<!-- Button trigger audioModal -->
						<a href="#" class="btn btn-success btn-lg btn-sm" role="button" data-toggle="modal" data-target="#audioModal<?= $row->postId ?>" aria-pressed="true">Ecouter</a>
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
									<audio controls preload="metadata" src="<?= base_url('webroot/audio/' . $row->postAudio . '.ogg'); ?>"></audio>
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
			</div>
			<!-- /infos de chaque post -->
		<?php endforeach ?>
		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</section>
</main><!--
--><aside class="aside">
<!-- chronique -->
<section class="chronic">
	<?php foreach ($chronic as $row) : ?>
		<h2><?= $row->countryName ?>: <?= $row->chronicTitle ?></h2>
		<p class="auteur"><strong>Par:</strong> <?= $row->writerFirstName. ' ' .$row->writerLastName ?> <strong>le</strong> <?= $row->chronicDate ?></p>
		<!-- <img src=<?= base_url('webroot/images/usersAvatar/' . $row->writerAvatar) ?> alt="avatar"> -->
		<p class="chronicContent"><?= substr($row->chronicContent, 0, 300); ?>...<a class="readMore btn btn-success btn-lg btn-sm" href=<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug) ?>>Lire plus</a></p>
	<?php endforeach; ?>
</section>
<!-- /chronique -->

<!--  carousel -->
<section class="slider">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<?php foreach ($slides as $row): ?>
				<a href="#">
					<div class="carousel-item <?php if (substr($row->slideName, -1) == 1){echo 'active';} ?>">
						<img class="d-block w-100" src="<?= base_url('webroot/images/carousel/' . $row->slideName . '.jpg') ?>" alt="<?= $row->slideName ?>">
						<div class="carousel-caption d-none d-md-block">
						    <h5><?= $row->slideLabel ?></h5>
						    <p><?= $row->slideDescription ?></p>
						 </div>
					</div>
				</a>
			<?php endforeach; ?>

			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</section>
<!-- archive -->
<section>
	<div class="archive">
		<h2>Nos archives</h2>
		<ul class="list-group">
			<a href="<?= base_url('revues-de-presse/archive') ?>">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Toutes nos revues de presse
					<span class="badge badge-primary badge-pill"><?= $allPostsCount ?></span>
				</li>
			</a>
			<a href="<?= base_url('chroniques/archive') ?>">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Toutes nos chroniques
					<span class="badge badge-primary badge-pill"><?= $allChronicsCount ?></span>
				</li>
			</a>
		</ul>
	</div>
</section>
<!-- décodeurs de l'actualité -->
<section>
	<div class="decodeur">
		<h2>Les décodeurs de l'actu</h2>
		<ul class="list-group">
			<a href="#">
				<li class="list-group-item d-flex justify-content-between align-items-center">Lorem ipsum dolor sit amet, consectetur adipisicing</li>
			</a>
		</ul>
	</div>
</section>
</aside>
</div>
