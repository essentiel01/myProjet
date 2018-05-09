<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	<div class="partners">
		<h1>Partenaires Hello Média</h1>
		<?php foreach ($partners as $row): ?>
			<div class="partner">
				<a href="<?= $row->web ?>">
					<img src="/myProjet/webroot/images/web_medias/<?= $row->logo ?>" alt="logo">
				</a>
				<p><?= $row->name ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</main>
