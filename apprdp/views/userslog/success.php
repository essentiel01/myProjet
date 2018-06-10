<div class="content">
	<main class="main">
		<div class="message">
			<!-- login de l'utilisateur -->
			<h2>Bonjour <?= $_SESSION['userData']->userFirstName. ' ' .$_SESSION['userData']->userLastName ?></h2>
			<div class="">
				<!-- message d'acceuil -->
				<p>Content de vous revoir. Pour accéder à votre espace personnel cliquez sur le lien ci-dessous</p>
				<!-- lien d'accès à l'espace personnel -->
				<a href="<?= base_url('espace-personnel/profil') ?>">Accéder à mon espace</a>
			</div>
		</div>
	</main>
</div>
