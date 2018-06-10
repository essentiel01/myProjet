<div class="content">
	<!--breadcrumb -->
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Informations personnelles</li>
		</ol>
	</nav>
	<!-- main content -->
	<main class="main">
		<div id="profil-avatar" class="profil-avatar">
			<h1>Mon profil</h1>
			<div class="avatar-container" id="user-avatar">
				<img src="/myprojet/webroot/images/usersAvatar/<?= $_SESSION['userData']->userAvatar ?>" alt="avatar">
				<i  id="icon-edit-img" class="icon-edit-img far fa-edit"></i>
				<!-- Button trigger modal -->
				<i id="icon-delete-img" class="icon-delete-img far fa-trash-alt" data-toggle="modal" data-target="#deleteAvatarModal"></i>
			</div>
			<!-- fomulaire photo profil -->
			<form id="file-form" class="hide row" action="<?= base_url('profil/m-a-j-photo-de-profil')?>" method="post" enctype="multipart/form-data">
				<input type="file" class="form-control col-sm-8" name="userfile"  size="20" value="">
				<input type="submit" class="btn btn-lg btn-primary col-sm-2" name="" value="Téléchager">
			</form>

			<!-- erreur an cas déchec du upload -->
			<div class="flashbag-error">
				<span><?php if ( isset($_SESSION['uploading_error']) ) { echo $_SESSION['uploading_error'] ; } ?></span>
			</div>

		</div>

		<!-- erreur echec de mise à jour profil -->
		<div class="flashbag-error">
			<span><?= isset($_SESSION['updating_error']) ? $_SESSION['updating_error'] : null ?></span>
		</div>

		<!-- formulaire d'édition de profil-->
		<form class="profil-form" action="<?= base_url('profil/mise-a-jour')?>" method="post">
			<!-- button edit et delete profil -->
			<div class="btn-edit-delete">
				<a href="#" class="edit-profil btn btn-lg btn-primary" id="edit-profil">Editer</a>
				<!-- Button trigger modal -->
				<a href="#" class="delete-profil btn btn-lg btn-danger" id="delete-profil" data-toggle="modal" data-target="#deleteProfilModal">Supprimer mon compte</a>

				<!--icone sur mobile-->
				<i id="icon-edit-profil" class="icon-edit-profil far fa-edit"></i>
				<i id="icon-delete-profil" class="icon-delete-profil far fa-trash-alt" data-toggle="modal" data-target="#deleteProfilModal"></i>
			</div>

			<div class="form-group row">
				<label for="firstName" class="col-form-label col-sm-2 col-12">Prénom</label>
				<div class="col-sm-10 col-12">
					<input type="text" class="form-control form-control-lg" id="firstName" name="firstName" value="<?php if (form_error('firstName') == null){ echo $_SESSION['userData']->userFirstName; } else {echo set_value('firstName');} ?>" placeholder="Prénom" disabled>
					<span class="formError"><?= form_error('firstName'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label for="lastName" class="col-form-label col-sm-2 col-12">Nom</label>
				<div class="col-sm-10 col-12">
					<input type="text" class="form-control form-control-lg" id="lastName" name="lastName" value="<?php if (form_error('lastName') == null){ echo $_SESSION['userData']->userLastName; } else {echo set_value('lastName');}?>" placeholder="Nom" disabled>
					<span class="formError"><?= form_error('lastName'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label for="login" class="col-form-label col-sm-2 col-12">Identifiant</label>
				<div class="col-sm-10 col-12">
					<input type="text" class="form-control form-control-lg" id="login" name="login" value="<?php if (form_error('login') == null){ echo $_SESSION['userData']->userLogin; } else {echo set_value('login');} ?>" placeholder="Identifiant" disabled>
					<span class="formError"><?= form_error('login'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label for="email" class="col-form-label col-sm-2 col-12">Email</label>
				<div class="col-sm-10 col-12">
					<input type="email" class="form-control form-control-lg" id="email" name="email" value="<?php if (form_error('email') == null){ echo $_SESSION['userData']->userEmail; } else {echo set_value('email');} ?>" placeholder="Email" disabled>
					<span class="formError"><?= form_error('email'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label for="country" class="col-form-label col-sm-2 col-12">Pays</label>
				<div class="col-sm-10 col-12">
					<input type="text" class="form-control form-control-lg" id="country" name="country" value="<?php if (form_error('country') == null){ echo $_SESSION['userData']->country; } else {echo set_value('country');}?>" placeholder="Pays" disabled>
					<span class="formError"><?= form_error('country'); ?></span>
				</div>
			</div>

			<div class="row">
				<a href="<?= base_url('espace-personnel/profil')?>" id="cancel" class="btn btn-lg btn-warning cancel col-sm-4 col-12 disabled">Annuler</a>
				<input type="submit" id="submit" class="btn btn-lg btn-success offset-sm-1 col-sm-4 col-12" value="Mettre à jour" disabled>
			</div>
		</form>

		<!-- formulaire de modification pasword -->
		<fieldset class="reset-password-fieldset">
			<legend>Réinitialiser mon mot de passe</legend>
			<form id="reset-password-form"  action="<?= base_url('users/resetPassword')?>" method="post" >

				<div class="row form-group">
					<label for="old-password" class="col-form-label col-sm-5 col-12">Ancien mot de passe</label>
					<div class="col-sm-7 col-12">
						<input type="password" id="old-password" class="form-control form-control-lg" name="old_password" value="">
						<span class="formError"><?php if ( isset(  $password_error ) ) { echo  $password_error; } ?></span>
					</div>
				</div>


				<div class="row form-group">
					<label for="new-password" class="col-form-label col-sm-5 col-12">Nouveau mot de passe</label>
					<div class="col-sm-7 col-12">
						<input type="password" id="new-password" class="form-control form-control-lg" name="password" value="">
						<span class="formError"><?= form_error('password'); ?></span>
					</div>
				</div>

				<div class="row form-group">
					<label for="new-password-confirmation" class="col-form-label col-sm-5 col-12">Confirmer le mot de passe</label>
					<div class="col-sm-7 col-12">
						<input type="password" id="new-password-confirmation" class="form-control form-control-lg" name="password_confirm" value="">
						<span class="formError"><?= form_error('password_confirm'); ?></span>
					</div>
				</div>


				<div class="row">
					<div class="btn-submit col-sm-4 offset-sm-8 col-12">
						<input type="submit" class="btn btn-lg btn-success form-control" name="" value="Valider">
					</div>
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
				<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Non</button>
				<a href="<?= base_url('users/deleteAvatar') ?>" class="btn btn-lg btn-primary">Oui</a>
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
				<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Non</button>
				<a href="<?= base_url('users/deleteProfil') ?>" class="btn btn-lg btn-primary">Oui</a>
			</div>
		  </div>
		</div>
	</div>
		<!-- /modal suppressionde compte -->
	</main>
</div>
