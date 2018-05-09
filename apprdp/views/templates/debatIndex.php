<main>
	<h1>Hello débats</h1>
	<?php 	if ($debats != null) {
		foreach ($debats as $row) : ?>
			<div class="">
				<h2><?= $row->title ?></h2>
				<p>Publié le <?= $row->posted_at ?></p>
				<div class="">
					<div class="person">
						<img src="/myProjet/webroot/images/web_medias/<?=$row->avatar_1 ?>" alt="avatar">
						<p><?= $row->person_1 ?></p>
					</div>
					<div class="description">
						<p><?= $row->description ?></p>
						<a href="<?= base_url('debat/'. $row->slug)?>">Voir</a>
					</div>
					<div class="person">
						<img src="/myProjet/webroot/images/web_medias/<?=$row->avatar_2 ?>" alt="avatar">
						<p><?= $row->person_2 ?></p>
					</div>
				</div>
			<?php endforeach;
		}
		else
		{
			echo '<p>' . $noDebats . '</p>';
		}?>

		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</div>
</main>
