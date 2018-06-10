<div class="content">
	<main class="main">
		<h1>Ajouter une nouvelle revue de presse</h1>
		<form method="post" action="<?= base_url('admin/savePost') ?>">
			<div class="form-group row">
				<label for="country" class="col-sm-2 col-form-label col-form-label-sm">Pays</label>
				<div class="col-sm-8 col-12">
					<select class="form-control form-control-sm" id="country" name="postCountry">
						<option>Sélectionner le pays</option>
						<?php foreach ($countries as $country): ?>
							<option value="<?= $country->countryId ?>"><?= $country->countryName ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="category" class="col-sm-2 col-form-label col-form-label-sm">Catégorie</label>
				<div class="col-sm-8 col-12">
					<select class="form-control form-control-sm" id="category" name="postCategory">
						<option>Sélectionner la catégorie</option>
						<?php foreach ($categories as $category): ?>
							<option value="<?= $category->categoryId ?>"><?= $category->categoryName ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label for="title" class="col-sm-2 col-form-label col-form-label-sm">Titre</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="postTitle" id="title" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="slug"  class="col-sm-2 col-form-label col-form-label-sm">Url</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="postSlug" id="slug" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="image"  class="col-sm-2 col-form-label col-form-label-sm">Image mise en avant</label>
				<div class="col-sm-5 col-12 input-group">
					<input type="text" class="form-control form-control-sm" name="image" id="image-featured" value="">
					<div class="input-group-append">
						<span class="btn btn-secondary">Choisir une image</span>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label for="audio"  class="col-sm-2 col-form-label col-form-label-sm">Audio</label>
				<div class="col-sm-5 col-12 input-group">
					<input type="text" id="audio-input" class="form-control form-control-sm" name="postAudio" id="audio" value="">
					<div class="input-group-append">
						<span class="btn btn-secondary">Choisir un élément audio</span>
					</div>
				</div>
			</div>
			<textarea id="revue-de-presse-textarea" name="postContent" class="form-control" rows="20"></textarea>
			<div class="form-group">
				<label for="sources">Sources de la revue de presse</label>
				<textarea class="form-control" id="sources" rows="3" name="postSources"></textarea>
			</div>
			<input type="hidden" name="user_id" value="<?php if (isset($_SESSION['userData'])){echo $_SESSION['userData']->userId;} ?>">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="" value="Enregistrer">
			</div>
		</form>
	</main>
</div>
