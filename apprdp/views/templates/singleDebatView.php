<main>
	<div class="debat-infos">
		<h1><?= $debat_infos->title ?></h1>
		<p>Publié le <?= $debat_infos->posted_at ?></p>
		<p><?= $debat_infos->description ?></p>
	</div>
	<?php foreach ($question_answer as $row) : ?>
		<h2><?= $row->question ?></h2>
		<div class="person_1">
			<div class="">
				<img src="/myProjet/webroot/images/web_medias/<?= $row->avatar_1 ?>" alt="avatar">
				<p><?= $row->person_1 ?></p>
			</div>
			<div class="answer_1">
				<p><?= $row->answer_1 ?></p>
			</div>
		</div>
		<div class="person_2">
			<div class="answer_1">
				<p><?= $row->answer_2 ?></p>
			</div>
			<div class="">
				<img src="/myProjet/webroot/images/web_medias/<?= $row->avatar_2 ?>" alt="avatar">
				<p><?= $row->person_2 ?></p>
			</div>
		</div>
	<?php endforeach ?>
	
</main>
