<div class="container">
	<main class="main">
		<section class="posts">
			<h2><?= $mainTitle ?></h2>
			<?php if(!empty($favoritesList)) {
				foreach ($favoritesList as $row) : ?>
					<form class="post" method="post" action="<?= base_url('favorites/deletechronic') ?>">
						<input type="checkbox" name="favoriteCheckbox" value="">
						<input type="hidden" name="chronicId" value="<?= $row->chronicId ?>">
						<p><strong>Pays: </strong><?= $row->countryName ?></p>
						<p><strong>Rubrique: </strong><?= $row->categoryName ?></p>
						<p><strong>Titre: </strong><?= $row->chronicTitle ?></p>
						<div class="btnLecture">
							<a href="<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug); ?>" class="btn btn-success btn-lg btn-sm">Lire</a>
							<input type="submit"  class="btn btn-danger btn-lg btn-sm" value="Supprimer" />
						</div>
					</form>
				<?php endforeach ;
				// pagination
				echo $this->pagination->create_links();
			} else {
				if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
			} ?>
		</section>
	</main>
</div>
