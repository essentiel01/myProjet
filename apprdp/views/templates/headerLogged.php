<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
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
		<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
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
				<!-- user menu -->
				<div class="btn-group userMenu">
					<button class="btn btn-secondary btn-lg dropdown-toggle user" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <?= $_SESSION['userData']->userFirstName . ' ' . $_SESSION['userData']->userLastName ?>
					</button>
					<ul class="dropdown-menu userMenuItems" style="left: -7rem;">
						<li><a href="<?= base_url('espace-personnel') ?>">Mon compte</a></li>
						<li><a href="<?= base_url('espace-personnel/mes-favoris') ?>">Mes favoris</a></li>
						<li><a href="#">Réinitialiser mon mot de passe</a></li>
						<li><a href="#">Supprimer mon compte</a></li>
						<li><a href="<?= base_url('deconnexion') ?>">Déconnexion</a></li>
					</ul>
				</div>
			</div>
			<!-- page title -->
			<div class="titleAndSubtitle content">
				<!-- title -->
				<h1>HELLO MEDIA</h1>
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
				<nav class="nav-mobile">
					<ul class="hide">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('/') ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('politique') ?>">Politique</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('economie') ?>">Economie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('sport') ?>" >Sport</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('culture') ?>">Culture</a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('debat') ?>">Le débat</a>
						</li>
					</ul>
				</nav>
				<!-- nav -->
				<nav class="nav-pc">
					<ul>
						<li class="">
							<a class="" href="<?= base_url('/') ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('politique') ?>">Politique</a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('economie') ?>">Economie</a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('sport') ?>" >Sport</a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('culture') ?>">Culture</a>
						</li>
						<li class="">
							<a class="" href="<?= base_url('debat') ?>">Le débat</a>
						</li>
					</ul>
					<!-- search form -->
					<form class="search input-group mb-3" action="">
						<div class="input-group-append btn-search">
							<input class="form-control-sm-lg search-input" type="text" placeholder="rechercher">
							<input class="btn-primary btn-lg btn-sm  submit" type="submit" value="Ok" name="button">
						</div>
					</form>
				</nav>
			</div>
		</header>
