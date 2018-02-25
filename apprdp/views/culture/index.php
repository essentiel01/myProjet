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
						<a href="#" class="btn btn-success btn-lg " role="button" aria-pressed="true">Ecouter</a>
						<audio controls src=""></audio>
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
