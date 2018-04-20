<div class="content">
	<main>
		<!-- formulaire de création de compte -->
		<form class="form" action=<?= base_url('inscription/succes') ?> method="post">
			<div class=" ">
				<label for="firstName" class="">Prénom</label>
				<div class="">
					<input type="text" class="form-control" id="firstName" name="firstName" value="<?php if(form_error('firstName') == NULL){echo set_value('firstName');} ?>" placeholder="Prénom">
				</div>
				<span class="formError"><?= form_error('firstName'); ?></span>
			</div>
			<div class=" ">
				<label for="lastName" class="">Nom</label>
				<div class="">
					<input type="text" class="form-control" id="lastName" name="lastName" value="<?php if(form_error('lastName') == NULL){echo set_value('lastName');} ?>" placeholder="Nom">
				</div>
				<span class="formError"><?= form_error('lastName'); ?></span>
			</div>
			<div class=" ">
				<label for="login" class="">Identifiant</label>
				<div class="">
					<input type="text" class="form-control" id="login" name="login" value="<?php if(form_error('login') == NULL){echo set_value('login');} ?>" placeholder="Identifiant">
				</div>
				<span class="formError"><?= form_error('login'); ?></span>
			</div>
			<div class=" ">
				<label for="email" class="">Email</label>
				<div class="">
					<input type="email" class="form-control" id="email" name="email" value="<?php if(form_error('email') == NULL){echo set_value('email');} ?>" placeholder="Email">
				</div>
				<span class="formError"><?= form_error('email'); ?></span>
			</div>
			<div class=" ">
				<label for="password" class="">Mot de passe</label>
				<div class="">
					<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
				</div>
				<span class="formError"><?= form_error('password'); ?></span>
			</div>
			<div class=" ">
				<label for="passconf" class="">Confirmer le mot de passe</label>
				<div class="">
					<input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirmation du mot de passe">
				</div>
				<span class="formError"><?= form_error('passconf'); ?></span>
			</div>
			<div class=" ">
				<label for="country" class="">Pays</label>
				<div class="">
					<input type="text" class="form-control" id="country" name="country" value="<?php if(form_error('country') == NULL){echo set_value('country');} ?>" placeholder="Pays">
				</div>
				<span class="formError"><?= form_error('country'); ?></span>
			</div>
			<div class=" ">
			    <div class=" btnRegister">
			    	<input type="submit" class="btn btn-lg btn-primary" value ="S'inscrire">
			    </div>
		  	</div>
		</form>
	</main>
</div>
