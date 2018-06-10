<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item active" aria-current="page">Nous contacter</li>
		</ol>
	</nav>
	<main class="main">
		<h1>Nous écrire</h1>
		<form class="contact-form" action="<?= base_url('home/contactUs') ?>" method="post">
			<div class="">
				<label for="email">Votre email</label>
				<input type="email"  class="form-control"name="email" id="email" value="">
			</div>
			<div class="">
				<label for="phone">Numero de téléphone</label>
				<input type="text"  class="form-control"name="phone" id="phone" value="">
			</div>
			<div class="">
				<label for="object">Objet</label>
				<input type="text"  class="form-control"name="object" id="object" value="" placeholder="Objet de votre message">
			</div>
			<div class="">
				<label for="message">Message</label>
				<textarea name="message" class="form-control" id="message" rows="8" cols="80" placeholder="Message"></textarea>
			</div>
			<div class="">
				<input type="submit" class="btn btn-primary"value="Envoyer">
			</div>
		</form>
	</main>

</div>
