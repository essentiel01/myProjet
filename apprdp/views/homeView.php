<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<!--breadcrumb -->
	<nav class="breadcrumb-nav" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">Accueil</li>
		</ol>
	</nav>
	<main class="main main-home">
		<h1><?php if(isset($welcome)){echo $welcome;} ?></h1>
		<?php if (isset($home_1)){ ?>
			<div class="home-revue-de-presse">
				<h2 class="title-2"><?= $home_1->title ?></h2>
				<img src="/myProjet/webroot/images/web_medias/<?= $home_1->image ?>" alt="image home revue de presse">
				<p><?= $home_1->how_it_work ?></p>
			</div>
		<?php } else {
			echo '<p>' . $indisponible . '</p>';
		} ?>

		<?php if (isset($home_2)){ ?>
			<div class="home-deco-actu">
				<h2 class="title-2"><?= $home_2->title ?></h2>
				<img src="/myProjet/webroot/images/web_medias/<?= $home_2->image ?>" alt="image home décodage actualité">
				<p><?= $home_2->how_it_work ?></p>
			</div>
		<?php } else {
			echo '<p>' . $indisponible . '</p>';
		} ?>

		<?php if (isset($home_3)) { ?>
			<div class="home-debat">
				<h2 class="title-2"><?= $home_3->title ?></h2>
				<img src="/myProjet/webroot/images/web_medias/<?= $home_3->image ?>" alt="image home débat">
				<p><?= $home_3->how_it_work ?></p>
			</div>
		<?php } else {
			echo '<p>' . $indisponible . '</p>';
		} ?>
	</main>
	<aside class="aside">
		<!--  carousel -->
		<?php if ($slides != null) { ?>
			<section class="slider">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<?php foreach ($slides as $row): ?>
								<div class="carousel-item <?php if (substr($row->slideName, -1) == 1){echo 'active';} ?>">
									<img class="d-block w-100" src="<?= base_url('webroot/images/carousel/' . $row->slideName . '.jpg') ?>" alt="<?= $row->slideName ?>">
									<div class="carousel-caption d-none d-md-block">
									    <h5><?= $row->slideLabel ?></h5>
									    <p><?= $row->slideDescription ?></p>
									</div>
								</div>
						<?php endforeach; ?>
					</div>

					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</section>
		<?php } else {
			echo '<p>' . $indisponible . '</p>';
		}?>
		<!-- dernières publications -->
		<section  class="recent-posts">
			<h2 class="title-2">Dernières publications</h2>
			<?php if ($recentPosts != null) { ?>
			<ul >
				<?php foreach ($recentPosts as $row) :?>
					<li>
						<a href="<?= base_url(strtolower($row->categoryName) . '/publication/' . $row->postId . '/'. $row->postSlug )?>"><?= $row->postTitle ?></a>
					</li>
				<?php endforeach;  ?>
			</ul>
		<?php } else {
			echo '<p>' . $indisponible . '</p>';
		} ?>
		</section>
		<!-- decodage actualité -->
		<section>
			<div class="decodeur">
				<h2 class="title-2">Les décodeurs de l'actu</h2>
				<?php if ($decodage_actu != null) { ?>
				<ul class="list-group">
					<?php foreach ($decodage_actu as $row) : ?>
						<li>
							<a href="<?= base_url('actualites/' . $row->slug )?>"><?= $row->title ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php } else {
				echo '<p>' . $indisponible . '</p>';
			} ?>
			</div>
		</section>
		<!-- archive -->
		<section>
			<div class="archive">
				<h2 class="title-2">Nos archives</h2>
				<ul class="list-group">
					<a href="<?= base_url('revues-de-presse/archive') ?>">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Toutes nos revues de presse
							<span class="badge badge-primary badge-pill"><?php if(isset($allPostsCount)){echo $allPostsCount; } ?></span>
						</li>
					</a>
					<a href="<?= base_url('chroniques/archive') ?>">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Toutes nos chroniques
							<span class="badge badge-primary badge-pill"><?php if(isset($allChronicsCount)){echo $allChronicsCount;} ?></span>
						</li>
					</a>
				</ul>
			</div>
		</section>
		<!-- newsletter -->
		<section  class="newsletter">
			<form action="#" method="post">
				<div class="">
					<div class="row">
					</div>
					<div class="row">
						<input type="text" class="form-control form-control-lg col-sm-8 offset-sm-1 col-12" id="email" name="email" value="" placeholder="exemple@xyz.com">
						<input type="submit" class="form-control form-control-lg col-sm-2 col-12 btn btn-primary" id="email-submit"  value="Valider">
						<span id="error" class="alert-danger"></span>
						<span id="save-success" class="alert-success"></span>
					</div>
				</div>
			</form>
		</section>
		<!-- réseaux sociaux -->
		<section class="reseaux-sociaux">
			<h2 class="title-2">Nous suivre</h2>
			<div class="">
				<i class="fab fa-twitter-square twitter"></i>
				<i class="fab fa-facebook-square facebook"></i>
			</div>
		</section>
	</aside>
</div>
