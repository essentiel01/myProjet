<div class="container">
	<main>
		<!-- formulaire de création de compte -->
		<form class="registerForm" action=<?= base_url('inscription/succes') ?> method="post">
			<div class="form-group row">
				<label for="firstName" class="col-lg-2 col-sm-2 col-form-label">Prénom</label>
				<div class="col-lg-5 col-sm-8">
					<input type="text" class="form-control" id="firstName" name="firstName" value="<?php if(form_error('firstName') == NULL){echo set_value('firstName');} ?>" placeholder="Prénom">
				</div>
				<span class="formError"><?= form_error('firstName'); ?></span>
			</div>
			<div class="form-group row">
				<label for="lastName" class="col-lg-2 col-sm-2 col-form-label">Nom</label>
				<div class="col-lg-5 col-sm-8">
					<input type="text" class="form-control" id="lastName" name="lastName" value="<?php if(form_error('lastName') == NULL){echo set_value('lastName');} ?>" placeholder="Nom">
				</div>
				<span class="formError"><?= form_error('lastName'); ?></span>
			</div>
			<div class="form-group row">
				<label for="login" class="col-lg-2 col-sm-2 col-form-label">Identifiant</label>
				<div class="col-lg-5 col-sm-8">
					<input type="text" class="form-control" id="login" name="login" value="<?php if(form_error('login') == NULL){echo set_value('login');} ?>" placeholder="Identifiant">
				</div>
				<span class="formError"><?= form_error('login'); ?></span>
			</div>
			<div class="form-group row">
				<label for="email" class="col-lg-2 col-sm-2 col-form-label">Email</label>
				<div class="col-lg-5 col-sm-8">
					<input type="email" class="form-control" id="email" name="email" value="<?php if(form_error('email') == NULL){echo set_value('email');} ?>" placeholder="Email">
				</div>
				<span class="formError"><?= form_error('email'); ?></span>
			</div>
			<div class="form-group row">
				<label for="password" class="col-lg-2 col-sm-2 col-form-label">Mot de passe</label>
				<div class="col-lg-5 col-sm-8">
					<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
				</div>
				<span class="formError"><?= form_error('password'); ?></span>
			</div>
			<div class="form-group row">
				<label for="passconf" class="col-lg-2 col-sm-2 col-form-label">Confirmer le mot de passe</label>
				<div class="col-lg-5 col-sm-8">
					<input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirmation du mot de passe">
				</div>
				<span class="formError"><?= form_error('passconf'); ?></span>
			</div>
			<div class="form-group row">
				<label for="country" class="col-lg-2 col-sm-2 col-form-label">Pays</label>
				<div class="col-lg-5 col-sm-8">
					<input type="text" class="form-control" id="country" name="country" value="<?php if(form_error('country') == NULL){echo set_value('country');} ?>" placeholder="Pays">
				</div>
				<span class="formError"><?= form_error('country'); ?></span>
			</div>
			<div class="form-group row">
			    <div class="col-lg-5 col-sm-8 btnRegister">
			    	<input type="submit" class="btn btn-primary" value ="S'inscrire">
			    </div>
		  	</div>
		</form>
	</main>
</div>
