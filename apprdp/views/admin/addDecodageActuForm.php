<div class="content">
	<main class="main">
		<h1>Ajouter une nouvelle analyse de l'actualité</h1>
		<form method="post" action="<?= base_url('admin/saveDecoActu') ?>">

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
			<textarea id="admin-textarea" name="content" class="form-control" rows="20"></textarea>
			<input type="hidden" name="user_id" value="<?php if (isset($_SESSION['userData'])){echo $_SESSION['userData']->userId;} ?>">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="" value="Enregistrer">
			</div>
		</form>
	</main>
</div>
