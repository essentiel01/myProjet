<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main>
	<div class="team">
		<h1>Equipe Hello Média</h1>
		<?php foreach ($teams as $row): ?>
			<div class="member">
				<img src="/myProjet/webroot/images/usersAvatar/<?= $row->writerAvatar ?>" alt="avatar">
				<p><?= $row->writerFirstName . ' ' . $row->writerLastName ?></p>
				<p><?= $row->role ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</main>
