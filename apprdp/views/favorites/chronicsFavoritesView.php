<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('espace-personnel/mes-favoris') ?>">Mes favoris</a></li>
			<li class="breadcrumb-item active" aria-current="page">Mes chroniques favoris</li>
		</ol>
	</nav>
	<main class="main">
		<section class="posts">
			<h1><?= $mainTitle ?></h1>
			<?php if(!empty($favoritesList)) { ?>
				<table class=" table table-striped">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Titre</th>
							<th scope="col">Rubrique</th>
							<th scope="col">Pays</th>
							<th scope="col" colspan=2>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($favoritesList as $row) : ?>
						<tr>
							<td scope="col">
								<form  method="post" action="">
									<input type="checkbox" name="favoriteCheckbox" value="">
									<input type="hidden" name="chronicId" value="<?= $row->chronicId ?>">
								</form>
							</td>
							<td scope="row">
								<p><?= $row->chronicTitle ?></p>
							</td>
							<td scope="row">
								<p><?= $row->categoryName ?></p>
							</td>
							<td scope="row">
								<p><?= $row->countryName ?></p>
							</td>
						
							<td scope="row">
								<a href="<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug); ?>" class="btn btn-success btn-lg">Lire</a>
							</td>
							<td scope="row">
								<form  method="post" action="<?= base_url('favorites/deletechronic') ?>">
									<input type="hidden" name="chronicId" value="<?= $row->chronicId ?>">
									<input type="submit"  class="btn btn-danger btn-lg" value="Supprimer" />
								</form>
							</td>
						
						</tr>
					<?php endforeach ; ?>
					</tbody>
				</table>
				<!-- pagination -->
			<?php	echo $this->pagination->create_links();
			} else {
				if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
			} ?>
		</section>
	</main>
</div>
