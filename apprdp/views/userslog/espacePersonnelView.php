<div class="content">
		<h2>Mon profil</h2>
		<div id="profil-avatar" class="profil-avatar">
			<div class="avatar-container" id="user-avatar">
				<img src="/myprojet/webroot/images/usersAvatar/<?= $_SESSION['userData']->userAvatar ?>.png" alt="avatar">
				<i  id="icon-edit-img" class="icon-edit-img far fa-edit"></i>
				<i id="icon-delete-img" class="icon-delete-img far fa-trash-alt"></i>
			</div>
			<form id="file-form" class="hide" action="" method="post">
				<input type="file" name="avatar" accept=".jpg, .jpeg, .png" value="">
				<input type="submit" name="" value="téléchagrer">
			</form>
		</div>
		<form class="profil-form" action="" method="post">
			<div class="btn-edit-delete">
				<a href="#" class="edit-profil btn btn-lg btn-primary" id="edit-profil">Editer</a>
				<a href="#" class="delete-profil btn btn-lg btn-danger" id="delete-profil">Supprimer mon compte</a>
				<i id="icon-edit-profil" class="icon-edit-profil far fa-edit"></i>
				<i id="icon-delete-profil" class="icon-delete-profil far fa-trash-alt"></i>
			</div>
			<!-- <label for="firstName" class=" ">Prénom</label> -->
			<div class="">
				<input type="text" class="input form-control" id="firstName" name="firstName" value="<?= $_SESSION['userData']->userFirstName ?>" placeholder="Prénom" disabled>
			</div>
			<span class="formError"><?= form_error('firstName'); ?></span>

			<div class=" ">
				<!-- <label for="lastName" class=" ">Nom</label> -->
				<div class="">
					<input type="text" class="input form-control" id="lastName" name="lastName" value="<?= $_SESSION['userData']->userLastName ?>" placeholder="Nom" disabled>
				</div>
				<span class="formError"><?= form_error('lastName'); ?></span>
			</div>
			<div class=" ">
				<!-- <label for="login" class=" ">Identifiant</label> -->
				<div class="">
					<input type="text" class="input form-control" id="login" name="login" value="<?= $_SESSION['userData']->userLogin ?>" placeholder="Identifiant" disabled>
				</div>
				<span class="formError"><?= form_error('login'); ?></span>
			</div>
			<div class=" ">
				<!-- <label for="email" class=" ">Email</label> -->
				<div class="">
					<input type="email" class="input form-control" id="email" name="email" value="<?= $_SESSION['userData']->userEmail ?>" placeholder="Email" disabled>
				</div>
				<span class="formError"><?= form_error('email'); ?></span>
			</div>
			<div class=" ">
				<!-- <label for="country" class=" ">Pays</label> -->
				<div class="">
					<input type="text" class="input form-control" id="country" name="country" value="<?= $_SESSION['userData']->userCountry ?>" placeholder="Pays" disabled>
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
</div>
