<div class="content">
	<main class="main row">
		<table class="table table-striped col-sm-12">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Id</th>
					<th scope="col">Titre</th>
					<th scope="col">Rubrique</th>
					<th scope="col">Pays</th>
					<th scope="col">Publié le</th>
					<th scope="col">Mise à jour le</th>
					<th scope="col">Auteur</th>
					<th scope="col">Action</th>
					<th scope="col"></th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($chronics_online as $chronic): ?>
					<tr>
						<td>
							<form class="" action="" method="post">
								<input type="checkbox" name="" value="">
							</form>
						</td>
						<td><?= $chronic->chronicId ?></td>
						<td><?= $chronic->chronicTitle ?></td>
						<td><?= $chronic->categoryName ?></td>
						<td><?= $chronic->countryName ?></td>
						<td><?= $chronic->posted_at ?></td>
						<td><?= $chronic->updated_at ?></td>
						<td><?= $chronic->userFirstName.'  '.$chronic->userLastName ?></td>
						<td>
							<a href="#">Voir</a>
						</td>
						<td>
							<a href="">Modifier</a>
						</td>
						<td>
							<form class="" action="" method="post">
								<input type="hidden" name="postId" value="<?= $chronic->chronicId ?>">
								<input type="submit" value="Retirer du site">
							</form>
						</td>
						<td>
							<a href="#">Supprimer</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</main>
</div>
