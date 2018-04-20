$(document).ready(function () {
	//event click du boutton ajout de favoris pour les revues
	$('#addPostFavorite').on('click', addPostFavorite);

	//event click du boutton  ajout de favoris pour les chroniques
	$('#addChronicFavorite').on('click', addChronicFavorite);

	//event click du boutton commenter
	$('#addPostComment').on('click', addPostComment);

	//event click du boutton commenter
	$('#addChronicComment').on('click', addChronicComment);

	//permet d'afficher les commentaires d'un article et d'actualiser les données chaque seconde
	getPostComments();
	$('#displayPostComments').on('click', '#morePostComments', showMorePostComments);
	//permet d'afficher les commentaires d'une chronique et d'actualiser les données chaque seconde
	getChronicComments();
	$('#displayChronicComments').on('click', '#moreChronicComments', showMoreChronicComments);

	//met le focus sur le champ commentaire lorsqu'on clique sur repondre
	$('main').on('click', '.reply', replyComment);

	//event click pour afficher ou masquer la nav sur les mobiles et de changer l'icone hamburger en croix
	$('#hamburger').on('click', showNav);

	//event click pour afficher le formulaire de recherche sur les mobile
	$('#loop').on('click', showSearch);

	//edit profil form
	$("#edit-profil").on("click", editProfil);
	//edit le profil en version mobile
	$("#icon-edit-profil").on("click", editProfil);

	//edit l'image de profil
	$("#icon-edit-img").on("click", function (){
		$("#file-form").toggleClass("hide");
	});
});
