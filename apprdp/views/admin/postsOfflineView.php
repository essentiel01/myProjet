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
					<th scope="col">Edité le</th>
					<th scope="col">Auteur</th>
					<th scope="col">Action</th>
					<th scope="col"></th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($posts_offline as $post): ?>
					<tr>
						<td>
							<form class="" action="" method="post">
								<input type="checkbox" name="" value="">
							</form>
						</td>
						<td><?= $post->postId ?></td>
						<td><?= $post->postTitle ?></td>
						<td><?= $post->categoryName ?></td>
						<td><?= $post->countryName ?></td>
						<td><?= $post->postCreatingDate ?></td>
						<td><?= $post->userFirstName.'  '.$post->userLastName ?></td>
						<td>
							<a href="#">Voir</a>
						</td>
						<td>
							<a href="">Modifier</a>
						</td>
						<td>
							<form class="" action="<?= base_url('admin/publishPost' )?>" method="post">
								<input type="hidden" name="postId" value="<?= $post->postId ?>">
								<input type="submit" value="Publier">
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
