<div class="content">
	<main class="main">
		<h1>Ajouter une nouvelle chronique</h1>
		<form method="post" action="<?= base_url('admin/saveChronic') ?>">
			<div class="form-group row">
				<label for="country" class="col-sm-2 col-form-label col-form-label-sm">Pays</label>
				<div class="col-sm-8 col-12">
					<select class="form-control form-control-sm" id="country" name="chronicCountry">
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
					<select class="form-control form-control-sm" id="category" name="chronicCategory">
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
					<input type="text" class="form-control form-control-sm" name="chronicTitle" id="title" value="">
				</div>
			</div>
			<div class="row form-group">
				<label for="slug"  class="col-sm-2 col-form-label col-form-label-sm">Url</label>
				<div class="col-sm-8 col-12">
					<input type="text" class="form-control form-control-sm" name="chronicSlug" id="slug" value="">
				</div>
			</div>
			<div class="">
				<label for="chronicContent">Corps du texte</label>
				<textarea id="chronicContent" class="form-control" name="chronicContent" rows="10" cols="100"></textarea>
			</div>
			<input type="hidden" name="user_id" value="<?php if (isset($_SESSION['userData'])){echo $_SESSION['userData']->userId;} ?>">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="" value="Enregistrer">
			</div>
		</form>
	</main>
</div>
