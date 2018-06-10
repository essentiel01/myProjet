<div class="content">
	<!--breadcrumb --> 
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Accueil</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('debat') ?>">Débat</a></li>
			<li class="breadcrumb-item active" aria-current="page">
			<?= $debat_infos->title ?>
			</li>
		</ol>
	</nav>
	<main class="main">
		<div class="debat-infos">
			<h1 class="debat-title"><?= $debat_infos->title ?></h1>
			<p>Publié le <?= $debat_infos->posted_at ?></p>
			<p class="debat-description"><?= $debat_infos->description ?></p>
		</div>
		<?php foreach ($question_answer as $row) : ?>
			<div class="questions-answers">
				<h2 class="question"><?= $row->question ?></h2>
				<div class="person-1">
					<div class="person-1-infos">
						<?= $row->avatar_1 ?>
						<p><?= $row->person_1 ?></p>
					</div>
					<div class="answer-1">
						<p><?= $row->answer_1 ?></p>
					</div>
				</div>
				<div class="person-2">
					<div class="answer-2">
						<p><?= $row->answer_2 ?></p>
					</div>
					<div class="person-2-infos">
						<?= $row->avatar_2 ?>
						<p><?= $row->person_2 ?></p>
					</div>
				</div>
			</div>
		<?php endforeach ?>

	</main>

</div>
