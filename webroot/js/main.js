$(document).ready(function () {
	//event click du boutton favoris
	$('#favorite').on('click', addFavorite);

	//event click du boutton commenter
	$('#btnComment').on('click', addComment);

	//permet d'afficher les commentaires d'un article et d'actualiser les données chaque seconde
	setInterval('getComments()', 1500);

	//met le focus sur le champ commentaire lorsqu'on clique sur repondre
	$('main').on('click', '.reply', replyComment);

	//remet la valeur de l'input hidden contenant la valeur de l'id du commentaire parent àvide
	// $('#comment').on('blur', function(){
	// 	$('#parentCommentId').val('');
	// });
});
