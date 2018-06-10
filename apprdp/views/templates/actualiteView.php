<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $decodage_actu->title ?></li>
		</ol>
	</nav>
	<main class="main">
			<h1><?= $decodage_actu->title ?></h1>
			<?php if ( $decodage_actu->updatedAt != null ) { ?>
				<p class="auteur">Par <?= $decodage_actu->userFirstName . ' ' .  $decodage_actu->userFirstName ?> modifié le <?= $decodage_actu->updatedAt ?></p>
			<?php } else { ?>
				<p class="auteur">Par <?= $decodage_actu->userFirstName . ' ' .  $decodage_actu->userFirstName ?> publié le <?= $decodage_actu->postedAt ?></p>
			<?php } ?>
			<p><?= $decodage_actu->content ?></p>
	</main>
</div>
