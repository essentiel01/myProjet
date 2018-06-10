<div class="content">
	<main class="main row">
		<table class="table table-striped col-sm-12">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Id</th>
					<th scope="col">Titre</th>
					<th scope="col">Description</th>
					<th scope="col">Invité 1</th>
					<th scope="col">Invité 2</th>
					<th scope="col">Date</th>
					<th scope="col">Action</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($debats_off_line as $debat): ?>
					<tr>
						<td>
							<form class="" action="" method="post">
								<input type="checkbox" name="" value="">
							</form>
						</td>
						<td><?= $debat->id ?></td>
						<td><?= $debat->title ?></td>
						<td><?= $debat->description ?></td>
						<td><?= $debat->person_1 ?></td>
						<td><?= $debat->person_2 ?></td>
						<td><?= $debat->created_at ?></td>
						<td>
							<a href="#">Modifier</a>
						</td>
						<td>
							<a href="<?= base_url('inside/team/debat/en-attente/' . $debat->slug . '/ajout-de-contenu') ?>">Ajouter du contenu</a>
						</td>
						<td>
							<a href="#">Supprimer</a>
						</td>
						<td>
							<a href="#">Publier</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</main>
</div>
