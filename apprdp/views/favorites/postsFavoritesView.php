<div class="container">
	<main>
		<h2><?= $mainTitle ?></h2>
		<!-- si la liste des favoris n'est pas vide on l'affiche -->
		<?php if(!empty($favoritesList)) {
			 foreach ($favoritesList as $row) : ?>

				<form class="" method="post" action="<?= base_url('favorites/deletepost') ?>">
					<input type="checkbox" name="favoriteCheckbox" value="">
					<input type="hidden" name="postId" value="<?= $row->postId ?>">
					<p><?= $row->countryName ?></p>
					<p>Rubrique: <?= $row->categoryName ?></p>
					<p>Titre: <?= $row->postTitle ?></p>
					<div class="">
						<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>" class="btn btn-success btn-lg">Lire</a>
						<a href="#" class="btn btn-success btn-lg">Ecouter</a>
						<input type="submit"  class="btn btn-danger btn-lg" value="Supprimer" />
					</div>
				</form>
			<?php endforeach ;
		} else {
			// sinon on affiche un message de liste vide
			if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
		} ?>

	</main>
</div>
