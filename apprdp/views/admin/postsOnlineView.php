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
					<th scope="col">Auteur</th>
					<th scope="col">Action</th>
					<th scope="col"></th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($posts_online as $post): ?>
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
						<td><?= $post->postDate ?></td>
						<td><?= $post->userFirstName.'  '.$post->userLastName ?></td>
						<td>
							<a href="#">Voir</a>
						</td>
						<td>
							<a href="">Modifier</a>
						</td>
						<td>
							<a href="#">Retirer du site</a>
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
