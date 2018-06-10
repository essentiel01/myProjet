<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>galery</title>
		<!-- jquery cdn -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
		<script src='/myProjet/webroot/js/tinymce/tinymce.min.js'></script>
		<script type="text/javascript">
			var browserDialog = {
				init: function () {

				},
				sendUrl: function (url) {
					var win = top.tinymce.activeEditor.windowManager.getParams().window;
					win.document.getElementById(top.tinymce.activeEditor.windowManager.getParams().input).value = url;
					top.tinymce.activeEditor.windowManager.close();
				}
			}
		</script>
		<!-- feuille de style -->
		<link rel="stylesheet" href="/myProjet/webroot/css/style.css">
	</head>
	<body>
