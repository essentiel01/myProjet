<div class="content">
	<main class="main">
		<h1>Ajouter du contenu à un débat</h1>
		<form method="post" action="<?= base_url('admin/saveQuestionsAnswers') ?>">
			<div class="row form-group">
				<label for="question" class="col-sm-2 col-form-label col-form-label-sm">Question</label>
				<div class="col-sm-8 col-12">
					<textarea id="question" class="form-control" name="question" rows="3" cols="100"></textarea>
				</div>
			</div>
			<div class="row form-group">
				<label for="answer_1" class="col-sm-2 col-form-label col-form-label-sm">Réponse invité 1</label>
				<div class="col-sm-8 col-12">
					<textarea id="answer_1" class="form-control" name="answer_1" rows="5" cols="100"></textarea>
				</div>
			</div>
			<div class="row form-group">
				<label for="answer_2" class="col-sm-2 col-form-label col-form-label-sm">Réponse invité 2</label>
				<div class="col-sm-8 col-12">
					<textarea id="answer_2" class="form-control" name="answer_2" rows="5" cols="100"></textarea>
				</div>
			</div>

			<input type="hidden" name="debat_id" value="<?php if (isset($debat_id)){echo $debat_id;} ?>">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="" value="Enregistrer">
			</div>
		</form>
	</main>
</div>
