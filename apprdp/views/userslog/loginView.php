<div class="container">
	<main>
		<h2>Connectez-vous à votre espace personnel pour profiter de toutes les avantages du site</h2>
		<!-- message d'erreur en cas d'identifiant ou de mot de passe incorrecte -->
		<p><?php if(isset($loginError)){echo $loginError;} ?></p>
		<!-- formulaire de connexion -->
		<form class="registerForm" action=<?= base_url('connexion-reussie') ?> method="post">
			<div class="form-group row">
				<label for="email" class="col-lg-2 col-sm-2 col-form-label">Email</label>
				<div class="col-lg-5 col-sm-8">
					<input type="email" class="form-control" id="email" name="email" value="<?php if(form_error('email') == NULL){echo set_value('email');} ?>" placeholder="Email">
				</div>
				<span><?= form_error('email'); ?></span>
			</div>
			<div class="form-group row">
				<label for="password" class="col-lg-2 col-sm-2 col-form-label">Mot de passe</label>
				<div class="col-lg-5 col-sm-8">
					<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
				</div>
				<span><?= form_error('password'); ?></span>
			</div>

			<div class="form-group row">
			    <div class="col-lg-5 col-sm-8">
			    	<input type="submit" class="btn btn-primary" value ="Se connecter">
			    </div>
		  	</div>
			<!-- liens pour mot de passe oublié et création de compte -->
			<div class="">
				<a href="#">Mot de passe oublié?</a>
				<a href="<?= base_url('inscription/formulaire') ?>">Je crée mon compte en quelques clics</a>
			</div>
		</form>
	</main>
</div>
