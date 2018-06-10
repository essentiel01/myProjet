<div class="content">
	<!--breadcrumb -->
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Archives revues de presse</li>
		</ol>
	</nav>
	<main class="main">
		<div class="archive">
			<h1><?php if(isset($mainTitle)){echo $mainTitle;} ?></h1>
			<?php if ($allPosts != null) { ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Titre</th>
							<th scope="col">Rubrique</th>
							<th scope="col">Pays</th>
							<th scope="col" colspan=2>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($allPosts as $row): ?>
						<tr>
							<td scope="row">
								<p><?= $row->postTitle ?> </p>
							</td>
							<td scope="row">
								<p><?= $row->categoryName ?></p>
							</td>
							<td scope="row">
								<p><?= strtoupper($row->countryName) ?></p>
							</td>
							<td>
								<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>" class="btn btn-success btn-lg">Lire</a>
							</td>
							<td scope="row">
								<!-- Button trigger audioModal -->
								<a href="#" class="btn btn-success btn-lg" role="button" data-toggle="modal" data-target="#audioModal<?= $row->postId ?>" aria-pressed="true"><i class="fas fa-volume-up"></i></a>
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
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php } else {
				echo "<p> $noPosts </p>";
			 } ?>
		</div>
		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</main>
</div>
