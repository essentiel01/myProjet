<div class="content">
	<main class="main">
		<h1>Ajouter un nouveau débat</h1>
		<form method="post" action="<?= base_url('admin/saveDebat') ?>">
			<div class="row form-group">
				<label for="title" class="col-sm-2 col-form-label col-form-label-sm">Titre</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="title" id="title" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="slug"  class="col-sm-2 col-form-label col-form-label-sm">Url</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="slug" id="slug" value="">
				</div>
			</div>
			<div class="">
				<label for="description">Description</label>
				<textarea id="description" name="description" class="form-control" rows="8" cols="80"></textarea>
			</div>
			<div class="row form-group">
				<label for="person-1"  class="col-sm-2 col-form-label col-form-label-sm">Invité 1</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="person_1" id="person-1" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="image-1"  class="col-sm-2 col-form-label col-form-label-sm">Photo 1</label>
				<div class="col-sm-5 col-12 input-group">
					<input type="text" class="form-control form-control-sm photo-invite-debat-tinymce" name="avatar_1" id="image-1" value="">
					<div class="input-group-append">
						<span class="btn btn-secondary">Choisir une image</span>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label for="person-2"  class="col-sm-2 col-form-label col-form-label-sm">Invité 2</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="person_2" id="person-2" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="image-2"  class="col-sm-2 col-form-label col-form-label-sm">Photo 2</label>
				<div class="col-sm-5 col-12 input-group">
					<input type="text" class="form-control form-control-sm photo-invite-debat-tinymce" name="avatar_2" id="image-2" value="">
					<div class="input-group-append">
						<span class="btn btn-secondary">Choisir une image</span>
					</div>
				</div>
			</div>
			<input type="hidden" name="user_id" value="<?php if (isset($_SESSION['userData'])){echo $_SESSION['userData']->userId;} ?>">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="" value="Enregistrer">
			</div>
		</form>
	</main>
</div>
