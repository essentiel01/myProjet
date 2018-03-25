<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no">
	<title><?= $headerTitle ?></title>
	<!-- bootstrap css cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"/>
	<!-- jquerry ui css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
	<!-- jquery cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
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
				<i class="fa fa-twitter-square twitter" aria-hidden="true"></i>
				<i class="fa fa-facebook-official facebook" aria-hidden="true"></i>
				<i class="fa fa-envelope enveloppe" aria-hidden="true"></i>
			</div>
			<!-- suscribe and sign in buttons -->
			<div class="buttons">
				<a href=<?= base_url('inscription/formulaire'); ?> class="btn  btn-xs">S'inscrire</a>
				<a href=<?= base_url('connexion/formulaire'); ?> class="btn  btn-xs">Se connecter</a>
			</div>
		</div>
		<!-- page title -->
		<div class="titleAndSubtitle content">
			<!-- title -->
			<h1>A LA CARTE</h1>
			<!-- subtitle -->
			<p class="subTitle">Revue de presse écrite et audio</p>
		</div>
		<!-- live infos panel-->
		<div class="flashInfos content">
			<p>Contenu de l'info</p>
		</div>
		<!-- nav and search form -->
		<div class="navParent content">

			<div class="menuBtnMobile">
				<i class="fa fa-bars hamburger" id="hamburger"></i>
				<!-- search form -->
				<form class="searchMobile hide input-group mb-3" id="searchMobile" action="">
					<input class="form-control-sm" type="text" placeholder="rechercher">
					<div class="input-group-append btn-search">
						<input type="submit" class="btn-primary btn-sm"  value="Ok"/>
					</div>
				</form>
				<i class="fa fa-search loop" id="loop" aria-hidden="true"></i>
			</div>
			<!-- nav -->
			<nav>
				<ul class="hide">
					<li class="">
						<a class="" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
					</li>
					<li class="">
						<a class="" href="">Politique</a>
					</li>
					<li class="">
						<a class="" href="">Economie</a>
					</li>
					<li class="">
						<a class="" href="" >Sport</a>
					</li>
					<li class="">
						<a class="" href="<?= base_url('culture') ?>">Culture</a>
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
