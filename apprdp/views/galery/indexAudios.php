<div class="content">
	<main class="main">
		<h1>Liste des éléments sonore</h1>
		<?php foreach ($audios as $audio) : ?>
			<div class="">
				<a href="#" id="image-galery" onclick="browserDialog.sendUrl('<?= '/myProjet/webroot/audio/'.$audio->name ?>')">
					<audio src="/myProjet/webroot/audio/<?= $audio->name ?>" controls>
					</audio>
					<?= $audio->name ?>
				</a>
			</div>
		<?php endforeach ?>
	</main>
</div>
