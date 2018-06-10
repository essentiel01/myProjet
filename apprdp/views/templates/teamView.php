<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Notre équipe</li>
		</ol>
	</nav>
	<main class="main">
		<div class="team">
			<h1>Equipe Hello Média</h1>
			<?php foreach ($teams as $row): ?>
				<div class="member">
					<img src="/myProjet/webroot/images/usersAvatar/<?= $row->userAvatar ?>" alt="avatar">
					<p><?= $row->userFirstName . ' ' . $row->userLastName ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</main>

</div>
