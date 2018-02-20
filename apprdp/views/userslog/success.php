<div class="container">
	<!-- login de l'utilisateur -->
	<h2>Bonjour <?= $_SESSION['userData']->userLogin ?></h2>
	<!-- message d'acceuil -->
	<p>Content de vous revoir. Pour accéder à votre espace personnel cliquez sur le lien ci-dessous</p>
	<!-- lien d'accès à l'espace personnel -->
	<a href="<?= base_url('espace-personnel') ?>">Accéder à mon espace</a>
</div>
