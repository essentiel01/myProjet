<div class="content">
	<main>
		<h2 class="formTitle">Connectez-vous à votre espace personnel</h2>
		<!-- message d'erreur en cas d'identifiant ou de mot de passe incorrecte -->
		<p class="formError"><?php if (isset($_SESSION['loginError'])):
				echo $_SESSION['loginError'];
			endif ?>
		</p>
		<!-- formulaire de connexion -->
		<form class="form" action=<?= base_url('connexion') ?> method="post">
			<div class="">
				<div class="label">
					<label for="email" class="">Email</label>
				</div>
				<div class="input">
					<input type="email" class="form-control" id="email" name="email" value="<?php if(form_error('email') == NULL){echo set_value('email');} ?>" placeholder="Email">
				</div>
				<span class="formError"><?= form_error('email'); ?></span>
			</div>
			<div class="">
				<div class="label">
					<label for="password" class="">Mot de passe</label>
				</div>
				<div class="input">
					<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
				</div>
				<span class="formError"><?= form_error('password'); ?></span>
			</div>

			<div class="">
			    <div class="btnRegister">
			    	<input type="submit" class="btn btn-primary" value ="Se connecter">
			    </div>
		  	</div>
			<!-- liens pour mot de passe oublié et création de compte -->
			<div class="formLink">
				<a href="#">Mot de passe oublié?</a>
				<a href="<?= base_url('inscription/formulaire') ?>">Je crée mon compte</a>
			</div>
		</form>
	</main>
</div>
