<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">S'inscrire</li>
		</ol>
	</nav>
	<!--main content -->
	<main class="main">
		<h1 class="">Créer un compte</h1>
		<!-- formulaire de création de compte -->
		<form class="form" action=<?= base_url('inscription/succes') ?> method="post">
			<div class="row form-group">
				<label for="firstName" class="col-form-label col-sm-4 col-12">Prénom</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-lg" id="firstName" name="firstName" value="<?php if(form_error('firstName') == NULL){echo set_value('firstName');} ?>" placeholder="Prénom">
					<span class="formError"><?= form_error('firstName'); ?></span>
				</div>
			</div>

			<div class="row form-group">
				<label for="lastName" class="col-form-label col-sm-4 col-12">Nom</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-lg" id="lastName" name="lastName" value="<?php if(form_error('lastName') == NULL){echo set_value('lastName');} ?>" placeholder="Nom">
					<span class="formError"><?= form_error('lastName'); ?></span>
				</div>
			</div>

			<div class="row form-group">
				<label for="login" class="col-form-label col-sm-4 col-12">Identifiant</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-lg" id="login" name="login" value="<?php if(form_error('login') == NULL){echo set_value('login');} ?>" placeholder="Identifiant">
					<span class="formError"><?= form_error('login'); ?></span>
				</div>
			</div>

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

			<div class="row form-group">
				<label for="passconf" class="col-form-label col-sm-4 col-12">Confirmer le mot de passe</label>
				<div class="col-sm-8 col-12">
					<input type="password" class="form-control form-control-lg" name="passconf" id="passconf" placeholder="Confirmation du mot de passe">
					<span class="formError"><?= form_error('passconf'); ?></span>
				</div>
			</div>

			<div class="row form-group">
				<label for="country" class="col-form-label col-sm-4 col-12">Pays</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-lg" id="country" name="country" value="<?php if(form_error('country') == NULL){echo set_value('country');} ?>" placeholder="Pays">
					<span class="formError"><?= form_error('country'); ?></span>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4 offset-sm-8 col-12">
					<input type="submit" class="btn btn-lg btn-primary form-control" value ="S'inscrire">
				</div>
			</div>
		</form>
	</main>
</div>
