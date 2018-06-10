<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Débat</li>
		</ol>
	</nav>
	<main class="main">
		<h1>Hello débats</h1>
		<?php 	if ($debats != null) {
			foreach ($debats as $row) : ?>
				<div class="debat">
					<h2><?= $row->title ?></h2>
					<p>Publié le <?= $row->posted_at ?></p>
					<div class="">
						<div class="person">
							<?=$row->avatar_1 ?>
							<p><?= $row->person_1 ?></p>
						</div>
						<div class="description">
							<p><?= $row->description ?></p>
							<a class="btn btn-lg btn-primary" href="<?= base_url('debat/'. $row->slug)?>">Voir</a>
						</div>
						<div class="person">
							<?=$row->avatar_2 ?>
							<p><?= $row->person_2 ?></p>
						</div>
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
	</main>
</div>
