<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	<div class="">
			<h2><?= $decodage_actu->title ?></h2>
			<?php if ( $decodage_actu->updatedAt != null ) { ?>
				<p><?= $decodage_actu->author ?> modifié le <?= $decodage_actu->updatedAt ?></p>
			<?php } else { ?>
				<p><?= $decodage_actu->author ?> publié le <?= $decodage_actu->postedAt ?></p>
			<?php } ?>
			<p><?= $decodage_actu->content ?></p>
	</div>
</main>
