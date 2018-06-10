<div class="content">
	<main class="main">
		<h1>Liste des images</h1>
		<?php foreach ($medias as $media) : ?>
			<div class="image-galery">
				<a href="#" id="image-galery"  onclick="browserDialog.sendUrl('<?= '/myProjet/webroot/images/web_medias/'.$media->name ?>')">
					<img  src="/myProjet/webroot/images/web_medias/<?= $media->name ?>" alt="image galery">
					<p><?= $media->name ?></p>
				</a>
			</div>
		<?php endforeach ?>
	</main>
</div>
