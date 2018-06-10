<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Nos partenaires</li>
		</ol>
	</nav>
	<main class="main">
		<div class="partners">
			<h1>Partenaires Hello Média</h1>
			<?php foreach ($partners as $row): ?>
				<div class="partner">
					<a href="<?= $row->web ?>">
						<img src="/myProjet/webroot/images/web_medias/<?= $row->logo ?>" alt="logo">
					</a>
					<p><?= $row->name ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</main>

</div>
