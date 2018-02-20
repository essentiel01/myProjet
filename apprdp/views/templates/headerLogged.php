<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $headerTitle ?></title>
		<!-- bootstrap css cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"/>
		<!-- jquerry ui css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
		<!-- jquery cdn -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<!-- jquerry ui js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<!-- popper.js cdn -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<!-- bootstrap.js cdn -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<!-- font awesome cdn -->
		<script src="https://use.fontawesome.com/4015769546.js"></script>
		<!-- google fonts cdn -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Rajdhani|Shadows+Into+Light" rel="stylesheet"/>
		<!-- normalize cdn -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
		<!-- feuille de style -->
		<link rel="stylesheet" href="/myProjet/webroot/css/style.css"/><?php // TODO: Modifier ls chemin absolu quand le site sera mis en ligne ?>
	</head>
	<body>
		<header>
			<!-- top pannel -->
			<div class="topBar">
				<!-- social icons -->
				<div class="socialIcons">
					<i class="fa fa-twitter-square" aria-hidden="true"></i>
					<i class="fa fa-facebook-official" aria-hidden="true"></i>
					<i class="fa fa-envelope" aria-hidden="true"></i>
				</div>
				<!-- user menu -->
				<div class="btn-group">
					<button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Bienvenue dans votre espace personnel <?= $_SESSION['userData']->userLogin ?>
					</button>
					<div class="dropdown-menu">
						<a href="<?= base_url('espace-personnel') ?>">Mon compte</a>
						<a href="#">Mes favoris</a>
						<a href="#">Réinitialiser mon mot de passe</a>
						<a href="#">Supprimer mon compte</a>
						<a href="<?= base_url('deconnexion') ?>">Déconnexion</a>
					</div>
				</div>
			</div>
			<!-- page title -->
			<div class="titleWrapper container">
				<!-- title -->
				<h1>A LA CARTE</h1>
				<!-- subtitle -->
				<p class="subTitle">Revue de presse écrite et audio</p>
			</div>
			<!-- live infos panel-->
			<div class="flashInfos container">
				<p>Contenu de l'info</p>
			</div>
			<!-- nav and search form -->
			<div class="navWrapper container">
				<!-- nav -->
				<nav>
					<ul class="nav nav-tab">
						<li class="nav-item">
							<a class="nav-link" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Politique</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Economie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="" >Sport</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('culture') ?>">Culture</a>
						</li>
					</ul>
				</nav>
				<!-- search form -->
				<form class="search input-group mb-3" action="">
					<input class="form-control-sm" type="text" placeholder="rechercher">
					<div class="input-group-append btn-search">
						<button class="btn-primary btn-sm" type="button" name="button">Ok</button>
					</div>
				</form>
			</div>
		</header>
