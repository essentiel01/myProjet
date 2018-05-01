<div class="content">
		<h2>Mon profil</h2>

		<div id="profil-avatar" class="profil-avatar">
			<div class="avatar-container" id="user-avatar">
				<img src="/myprojet/webroot/images/usersAvatar/<?= $_SESSION['userData']->userAvatar ?>" alt="avatar">
				<i  id="icon-edit-img" class="icon-edit-img far fa-edit"></i>
				<!-- erreur an cas déchec du upload -->
				<div class="flashbag-error">
					<span><?php if ( isset($_SESSION['uploading_error']) ) { echo $_SESSION['uploading_error'] ; } ?></span>
				</div>
				<!-- fomulaire photo profil -->
				<form id="file-form" class="hide" action="<?= base_url('profil/m-a-j-photo-de-profil')?>" method="post" enctype="multipart/form-data">
					<input type="file" name="userfile"  size="20" value="">
					<input type="submit" name="" value="téléchager">
				</form>
				<!-- Button trigger modal -->
				<i id="icon-delete-img" class="icon-delete-img far fa-trash-alt" data-toggle="modal" data-target="#deleteAvatarModal"></i>
			</div>
		</div>

		<!-- erreur echec de mise à jour profil -->
		<div class="flashbag-error">
			<span><?= isset($_SESSION['updating_error']) ? $_SESSION['updating_error'] : null ?></span>
		</div>
		<form class="profil-form" action="<?= base_url('profil/mise-a-jour')?>" method="post">
			<!-- button edit et delete profil -->
			<div class="btn-edit-delete">
				<a href="#" class="edit-profil btn btn-lg btn-primary" id="edit-profil">Editer</a>
				<!-- Button trigger modal -->
				<a href="#" class="delete-profil btn btn-lg btn-danger" id="delete-profil" data-toggle="modal" data-target="#deleteProfilModal">Supprimer mon compte</a>

				<i id="icon-edit-profil" class="icon-edit-profil far fa-edit"></i>
				<i id="icon-delete-profil" class="icon-delete-profil far fa-trash-alt"></i>
			</div>

			<div class="">
				<label for="firstName" class=" ">Prénom</label>
				<div class="">
					<input type="text" class="input form-control" id="firstName" name="firstName" value="<?php if (form_error('firstName') == null){ echo $_SESSION['userData']->userFirstName; } else {echo set_value('firstName');} ?>" placeholder="Prénom" disabled>
				</div>
				<span class="formError"><?= form_error('firstName'); ?></span>
			</div>

			<div class=" ">
				<label for="lastName" class=" ">Nom</label>
				<div class="">
					<input type="text" class="input form-control" id="lastName" name="lastName" value="<?php if (form_error('lastName') == null){ echo $_SESSION['userData']->userLastName; } else {echo set_value('lastName');}?>" placeholder="Nom" disabled>
				</div>
				<span class="formError"><?= form_error('lastName'); ?></span>
			</div>

			<div class=" ">
				<label for="login" class=" ">Identifiant</label>
				<div class="">
					<input type="text" class="input form-control" id="login" name="login" value="<?php if (form_error('login') == null){ echo $_SESSION['userData']->userLogin; } else {echo set_value('login');} ?>" placeholder="Identifiant" disabled>
				</div>
				<span class="formError"><?= form_error('login'); ?></span>
			</div>

			<div class=" ">
				<label for="email" class=" ">Email</label>
				<div class="">
					<input type="email" class="input form-control" id="email" name="email" value="<?php if (form_error('email') == null){ echo $_SESSION['userData']->userEmail; } else {echo set_value('email');} ?>" placeholder="Email" disabled>
				</div>
				<span class="formError"><?= form_error('email'); ?></span>
			</div>

			<div class=" ">
				<label for="country" class=" ">Pays</label>
				<div class="">
					<input type="text" class="input form-control" id="country" name="country" value="<?php if (form_error('country') == null){ echo $_SESSION['userData']->userCountry; } else {echo set_value('country');}?>" placeholder="Pays" disabled>
				</div>
				<span class="formError"><?= form_error('country'); ?></span>
			</div>

			<div class=" ">
				<div class=" btnRegister">
					<input type="submit" id="submit" class="btn btn-lg btn-success" value="Mettre à jour" disabled>
					<a href="<?= base_url('espace-personnel')?>" id="cancel" class="btn btn-lg btn-warning cancel disabled"  >Annuler</a>
				</div>
			</div>
		</form>

		<!-- formulaire de modification pasword -->
		<fieldset>
			<legend>Réinitialiser mon mot de passe</legend>
			<form id="reset-password-form"  action="<?= base_url('users/resetPassword')?>" method="post" >
				<div>
					<label for="">Ancien mot de passe</label>
					<input type="password" name="old_password" value="">
					<span class="formError"><?php if ( isset(  $password_error ) ) { echo  $password_error; } ?></span>
				</div>
				<div class="">
					<label for="">Nouveau mot de passe</label>
					<input type="password" name="password" value="">
					<span class="formError"><?= form_error('password'); ?></span>
				</div>
				<div class="">
					<label for="">Confirmer le mot de passe</label>
					<input type="password" name="password_confirm" value="">
					<span class="formError"><?= form_error('password_confirm'); ?></span>
				</div>
				<div class="">
						<input type="submit" class="btn btn-success" name="" value="Valider">
				</div>
			</form>
		</fieldset>

		<!-- Modal suppression de photo de profil -->
		<div class="modal fade" id="deleteAvatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Suppression de photo de profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
					 <p>Votre photo de profil va être définitivement supprimé. Souhaitez-vous continuer cette action?</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
				<a href="<?= base_url('users/deleteAvatar') ?>" class="btn btn-primary">Oui</a>
			</div>
		  </div>
		</div>
	</div>
		<!-- /modal suppression de photo de profil -->

		<!-- Modal suppression de compte -->
		<div class="modal fade" id="deleteProfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Suppression de compte</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
					 <p>Votre  compte va être définitivement supprimé. Souhaitez-vous continuer cette action?</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
				<a href="<?= base_url('users/deleteProfil') ?>" class="btn btn-primary">Oui</a>
			</div>
		  </div>
		</div>
	</div>
		<!-- /modal suppressionde compte -->
</div>
