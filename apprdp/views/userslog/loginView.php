<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Se connecter</li>
		</ol>
	</nav>
	<main class="main">
		<h1>Connectez-vous à votre espace personnel</h1>
		<!-- message d'erreur en cas d'identifiant ou de mot de passe incorrecte -->
		<p class="formError"><?php if (isset($_SESSION['loginError'])):
				echo $_SESSION['loginError'];
			endif ?>
		</p>
		<!-- formulaire de connexion -->
		<form class="form" action=<?= base_url('connexion') ?> method="post">
			<div class="row form-group">
				<label for="email" class="col-form-label col-sm-4 col-12">Email</label>
				<div class="col-sm-8 col-12">
					<input type="email" class="form-control form-control-lg" id="email" name="email" value="<?php if(form_error('email') == NULL){echo set_value('email');} ?>" placeholder="Email">
					<span class="formError"><?= form_error('email'); ?></span>
				</div>
			</div>

			<div class="row form-group">
				<label for="password" class="col-form-label col-sm-4 col-12">Mot de passe</label>
				<div class="col-sm-8 col-12">
					<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Mot de passe">
					<span class="formError"><?= form_error('password'); ?></span>
				</div>
			</div>

			<div class="row">
			    <div class="col-sm-4 offset-sm-8 col-12">
			    	<input type="submit" class="btn btn-lg btn-primary form-control" value ="Se connecter">
			    </div>
		  	</div>
			<!-- liens pour mot de passe oublié et création de compte -->
			<div class="formLink">
				<a href="<?= base_url('mot-de-passe-oublie') ?>">Mot de passe oublié?</a>
				<a href="<?= base_url('inscription/formulaire') ?>">Je crée mon compte</a>
			</div>
		</form>
	</main>
</div>
