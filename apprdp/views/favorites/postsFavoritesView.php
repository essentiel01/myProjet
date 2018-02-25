<div class="container">
	<main>
		<h2><?= $mainTitle ?></h2>
		<?php foreach ($favoritesList as $row) : ?>

			<form class="">
				<input type="checkbox" name="favoriteCheckbox" value="">
				<p><?= $row->countryName ?></p>
				<p>Rubrique: <?= $row->categoryName ?></p>
				<p>Titre: <?= $row->postTitle ?></p>
			</form>
			<div class="">
				<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>" class="btn btn-success btn-lg">Lire</a>
				<a href="#" class="btn btn-success btn-lg">Ecouter</a>
				<a href="#" class="btn btn-danger btn-lg">Supprimer</a>
			</div>
		<?php endforeach ?>
	</main>
</div>
