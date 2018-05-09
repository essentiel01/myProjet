<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	<h1>Nous écrire</h1>
	<form class="" action="<?= base_url('home/contactUs') ?>" method="post">
		<div class="">
			<label for="email">Votre email</label>
			<input type="email" name="email" id="email" value="">
		</div>
		<div class="">
			<label for="phone">Numero de téléphone</label>
			<input type="phone" name="phone" id="phone" value="">
		</div>
		<div class="">
			<label for="object">Objet</label>
			<input type="text" name="object" id="object" value="" placeholder="Objet de votre message">
		</div>
		<div class="">
			<label for="message">Message</label>
			<textarea name="message" id="message" rows="8" cols="80" placeholder="Message"></textarea>
		</div>
		<div class="">
			<input type="submit" value="Envoyer">
		</div>
	</form>
</main>
