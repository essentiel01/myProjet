<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Mot de passe oublié</li>
		</ol>
	</nav>
	<main class="main">
		<form class="form" action="index.html" method="post">
			<div class="row form-group">
				<label for="email" class="col-form-label col-sm-5 col-12">Entrez votre adresse email</label>
				<div class="col-sm-7 col-12">
					<input type="email" class="form-control form-control-lg" name="email" id="email" value="" placeholder="email">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 offset-sm-8 col-12">
					<input type="submit" class="btn btn-lg btn-primary form-control" value="Valider">
				</div>
			</div>
		</form>
	</main>
</div>
