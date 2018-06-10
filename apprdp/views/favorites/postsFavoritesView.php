<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('espace-personnel/mes-favoris') ?>">Mes favoris</a></li>
			<li class="breadcrumb-item active" aria-current="page">Mes revues de presse favoris</li>
		</ol>
	</nav>
	<main class="main">
		<section class="posts">
			<h1><?= $mainTitle ?></h1>
			<!-- si la liste des favoris n'est pas vide on l'affiche -->
			<?php if(!empty($favoritesList)) {?>
				<table class=" table table-striped">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Titre</th>
							<th scope="col">Rubrique</th>
							<th scope="col">Pays</th>
							<th scope="col" colspan=3>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($favoritesList as $row) : ?>
						<tr>
							<td scope="col">
								<form  method="post" action="">
									<input type="checkbox" name="favoriteCheckbox" value="">
									<input type="hidden" name="postId" value="<?= $row->postId ?>">
								</form>
							</td>
							<td scope="row">
								<p><?= $row->postTitle ?></p>
							</td>
							<td scope="row">
								<p><?= $row->categoryName ?></p>
							</td>
							<td scope="row">
								<p><?= $row->countryName ?></p>
							</td>
							<td scope="row">
								<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>" class="btn btn-success btn-lg">Lire</a>
							</td>
							<td scope="row">
								<!-- Button trigger audioModal -->
								<a href="#" class="btn btn-success btn-lg" role="button" data-toggle="modal" data-target="#audioModal<?= $row->postId ?>" aria-pressed="true"><i class="fas fa-volume-up"></i></a>
							</td>
							<td scope="row">
								<form  method="post" action="<?= base_url('favorites/deletepost') ?>">
									<input type="hidden" name="postId" value="<?= $row->postId ?>">
									<input type="submit"  class="btn btn-danger btn-lg" value="Supprimer" />
								</form>
							</td>
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
											 <?= $row->postAudio ?>
										</div>
										<div class="modal-footer footer">
											<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Fermer</button>
											<!--<a <?php if(!isset($_SESSION['userData']->userId)) {
												echo 'href=' . base_url('connexion/formulaire');
											} else {
												echo 'href=' . base_url('webroot/audio/' . $row->postAudio . '.ogg') . ' download=' . $row->postAudio;
											}
											?> role="button" class="btn btn-lg btn-primary" >
											Télécharger
											</a>-->
										</div>
									</div>
								</div>
							</div>
						</tr>
					<?php endforeach ;?>
					</tbody>
				</table>
				<!-- pagination -->
				<?php echo $this->pagination->create_links();
			} 
			else 
			{
				// sinon on affiche un message de liste vide
				if(isset ($emptyFavoritesList)) { echo '<p>' . $emptyFavoritesList . '</p>';}
			} ?>

		</section>
	</main>
</div>
