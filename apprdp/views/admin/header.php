<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Espace d'administration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no">
	<!-- bootstrap css cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"/>
	<!-- jquerry ui css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
	<!-- jquery cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<!-- jquerry ui js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<!-- popper.js cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<!-- bootstrap.js cdn -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<!-- font awesome cdn -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	<!-- google fonts cdn -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Rajdhani|Shadows+Into+Light" rel="stylesheet"/>
	<!-- normalize cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />


	<!--  script tinymce-->
	<script type="text/javascript" src="/myProjet/webroot/js/tinymce/tinymce.min.js"></script>
	<!-- script de config de tinymce -->
	<script>
	//image mise en avant sur revue de presse
	tinyMCE.init({
		selector: '#image-featured',
		language: 'fr_FR',
		plugins: 'image',
		toolbar: 'image',
		menubar: 'no',
		image_advtab: true,
		relative_urls: false,
		file_browser_callback: function(field_name, url, type, win) {
			tinyMCE.activeEditor.windowManager.open({
				file: '/myProjet/inside/images',
				title: 'Galerie d\'images',
				resizable: 'yes',
				width: 800,
				height: 700,
				close_previous: 'no'
			}, {
				window: win,
				input: field_name
			});
			return false;
		}
	});
	//audio associé à la revue de presse
	tinyMCE.init({
		selector: '#audio-input',
		language: 'fr_FR',
		plugins: 'media',
		toolbar: 'media',
		menubar: 'no',
		image_advtab: true,
		relative_urls: false,
		file_browser_callback: function(field_name, url, type, win) {
			tinyMCE.activeEditor.windowManager.open({
				file: '/myProjet/inside/audios',
				title: 'Galerie d\'éléments audio',
				resizable: 'yes',
				width: 800,
				height: 700,
				close_previous: 'no'
			}, {
				window: win,
				input: field_name
			});
			return false;
		}
	});
	//contenu de la revue de presse
	tinyMCE.init({
		selector: '#revue-de-presse-textarea',
		language: 'fr_FR',
		plugins: 'image, link, lists, preview',
		toolbar: 'newdocument, bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, styleselect, formatselect,  fontsizeselect, cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, subscript, superscript, searchreplace ',
		image_advtab: true,
		relative_urls: false,
		file_browser_callback: function(field_name, url, type, win) {
			tinyMCE.activeEditor.windowManager.open({
				file: '/myProjet/inside/audios',
				title: 'Galerie d\'éléments audio',
				resizable: 'yes',
				width: 800,
				height: 700,
				close_previous: 'no'
			}, {
				window: win,
				input: field_name
			});
			return false;
		}
	});
	</script>
</head>
<body>
	<header>
		<div class="accordion" id="accordeon-team-dashboard">
			<!-- revue de presse -->
			<div class="card">
				<div class="card-header" id="revue-de-presse-heading">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#revue-de-presse-collapse" aria-expanded="true" aria-controls="revue-de-presse-collapse">
							Revue de presse
						</button>
					</h5>
				</div>
				<div id="revue-de-presse-collapse" class="collapse" aria-labelledby="revue-de-presse-heading" data-parent="#accordeon-team-dashboard">
					<div class="card-body">
						<ul>
							<li><a href="<?= base_url('inside/team/revue-de-presse/ajouter')?>">Ajouter</a></li>
							<li><a href="">En attente de publication</a></li>
							<li><a href="">Publiée</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- chronique -->
			<div class="card">
				<div class="card-header" id="chronique-heading">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#chronique-collapse" aria-expanded="true" aria-controls="chronique-collapse">
							Chronique
						</button>
					</h5>
				</div>
				<div id="chronique-collapse" class="collapse" aria-labelledby="chronique-heading" data-parent="#accordeon-team-dashboard">
					<div class="card-body">
						<ul>
							<li><a href="<?= base_url('inside/team/chronique/ajouter')?>">Ajouter</a></li>
							<li><a href="">En attente de publication</a></li>
							<li><a href="">Publiée</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Débat -->
			<div class="card">
				<div class="card-header" id="debat-heading">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#debat-collapse" aria-expanded="true" aria-controls="debat-collapse">
							Débat
						</button>
					</h5>
				</div>
				<div id="debat-collapse" class="collapse" aria-labelledby="debat-heading" data-parent="#accordeon-team-dashboard">
					<div class="card-body">
						<ul>
							<li><a href="<?= base_url('inside/team/debat/ajouter')?>">Ajouter</a></li>
							<li><a href="<?= base_url('inside/team/debat/debats-en-attente')?>">En attente de publication</a></li>
							<li><a href="">Publiée</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Analyse de l'actualité -->
			<div class="card">
				<div class="card-header" id="analyse-actu-heading">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#analyse-actu-collapse" aria-expanded="true" aria-controls="analyse-actu-collapse">
							Analyse actualité
						</button>
					</h5>
				</div>
				<div id="analyse-actu-collapse" class="collapse" aria-labelledby="analyse-actu-heading" data-parent="#accordeon-team-dashboard">
					<div class="card-body">
						<ul>
							<li><a href="<?= base_url('inside/team/analyse-actualite/ajouter')?>">Ajouter</a></li>
							<li><a href="">En attente de publication</a></li>
							<li><a href="">Publiée</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
</body>
</html>
