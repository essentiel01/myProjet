<div class="container">
	<main class="mainWrapper">
		<?php foreach ($post as $row) : ?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					  Favoris
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Ajouter aux favoris</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
							  <p>Pays: <?= $row->countryName ?></p>
  							  <p>Rubrique: <?= $row->categoryName ?></p>
  							  <h2><?= $row->postTitle ?></h2>
					      </div>
					      <div class="modal-footer">
					        <button type="button" id="modalCancel" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					        <a  id="favorite" class="btn btn-success btn-lg " role="button" aria-pressed="true" href="<?= base_url('connexion/formulaire') ?>" data-postId="<?= $row->postId ?>" data-userId="<?php if(isset($_SESSION['userData']->userId)) {echo $_SESSION['userData']->userId;} ?>">Ajouter</a>
					      </div>
					    </div>
					  </div>
				  </div>
				<!-- /modal -->

				<p>Pays: <?= $row->countryName ?></p>
				<p>Rubrique: <?= $row->categoryName ?></p>
				<h2><?= $row->postTitle ?></h2>
				<!-- compare le postId à chaque postId de la liste des revues qui sont dans les favoris. s'il y a un qui correspond alors on ajoute un petit coeur pour signifier que cet article fait déjà partie des favoris  -->
				<?php foreach ($favoritesList as $row1):
					if ($row->postId == $row1->postId) : ?>
						<i class="fa fa-heart"></i>
					<?php endIf; ?>
				<?php endforeach; ?>
				<p>Publié par:</p>
				<p><img width="8%" src=<?= '/myProjet/webroot/images/usersAvatar/' . $row->writerAvatar ?> alt="avatar"></p>
				<p><?= $row->writerFirstName." ".$row->writerLastName ?> le <?= $row->postPublishingDate ?></p>
				<p><?= $row->postContent ?></p>
				<h2>Sources de la revue</h2>
				<p><?= $row->postSource ?></p>
				<h3>Ajouter un commentaire</h3>
				<form class="" action="" method="post">
					<textarea name="name" rows="2" cols="70"></textarea>
					<input class="btn-primary" type="submit" value="Commenter">
				</form>
			<?php endforeach ?>
	</main><!--
	--><aside class="asideWrapper">

		<!--  slide -->
		<section class="slide">
			<h2>Slide</h2>
		</section>
		<!-- partenaires -->
		<section class="">
			<h2>Les médias partenaires</h2>
		</section>
		<!-- /partenaires -->
	</aside>
</div>
