<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Archives chroniques</li>
		</ol>
	</nav>
	<main class="main">
		<div class="archive">
			<h1><?= $mainTitle; ?></h1>
			<?php if ($allChronics != null) { ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Titre</th>
							<th scope="col">Rubrique</th>
							<th scope="col">Pays</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($allChronics as $row): ?>
						<tr>
							<td scope="row">
								<p><?= $row->chronicTitle ?></p>
							</td>
							<td scope="row">
								<p><?= $row->categoryName ?></p>
							</td>
							<td scope="row">
								<p><?= strtoupper($row->countryName) ?></p>
							</td>
							<td scope="row">
								<a href="<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug); ?>" class="btn btn-success btn-lg">Lire</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php }
			else
			{
				echo "<p>  $noChronics </p>";
			} ?>
		</div>
		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</main>
</div>
