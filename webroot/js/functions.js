/**
 * envoie les données de la revue à ajouter à la liste des favoris via la methode post de ajax
 * @param Event e événnement click
 */
function addPostFavorite(e)
{
	if ($(this).attr('data-userId') != '') {

		e.preventDefault();
		$.post(
			"/myProjet/favorites/addPost",
			{
				postId : $(this).attr('data-postId'),
				userId : $(this).attr('data-userId')
			}
		).done(function ()
		{
			$('#modalCancel').trigger('click');
		});
	}
}


/**
 * envoie les données de la revue à ajouter à la liste des favoris via la methode post de ajax
 * @param Event e événnement click
 */
function addChronicFavorite(e)
{
	if ($(this).attr('data-userId') != '') {

		e.preventDefault();
		$.post(
			"/myProjet/favorites/addChronic",
			{
				chronicId : $(this).attr('data-chronicId'),
				userId : $(this).attr('data-userId')
			}
		).done(function ()
		{
			$('#modalCancel').trigger('click');
		});
	}
}
/**
 * ajoute un commentaire
 * @param Event e evennement click
 */
function addPostComment(e)
{
	// on vérifie si quelqu'un est connectée
	if ($(this).attr('data-userId') != '') {
		//si quelqu'un est connecté on désactive le lien href puis on exécute le requête ajax
		e.preventDefault();
		$.post(
			"/myProjet/comments/addPostComment",
			{
				postId : $(this).attr('data-postId'),
				userId : $(this).attr('data-userId'),
				comment: $('#comment').val(),
				parentCommentId: $('#parentCommentId').val()
			}
		).done(function ()
		{
			// en cas de succès de la requête on vide le champ textarea du commenataire puis on réinitialise le parentCommentId à une valeur vide.
			$('#comment').val('');
			$('#parentCommentId').val('');
		});
	}
}

/**
 * ajoute un commentaire
 * @param Event e evennement click
 */
function addChronicComment(e)
{
	// on vérifie si quelqu'un est connectée
	if ($(this).attr('data-userId') != '') {
		//si quelqu'un est connecté on désactive le lien href puis on exécute le requête ajax
		e.preventDefault();
		$.post(
			"/myProjet/comments/addChronicComment",
			{
				chronicId : $(this).attr('data-chronicId'),
				userId : $(this).attr('data-userId'),
				comment: $('#comment').val(),
				parentCommentId: $('#parentCommentId').val()
			}
		).done(function ()
		{
			// en cas de succès de la requête on vide le champ textarea du commenataire puis on réinitialise le parentCommentId à une valeur vide.
			$('#comment').val('');
			$('#parentCommentId').val('');
		});
	}
}

/**
 * requête ajax permetttant d'afficher la liste des commentaires
 */

 function getPostComments() {
 	$.get("/myProjet/comments/postComments", function (data)
	{
		$('#displayPostComments').append(data);
	});
 }

 function showMorePostComments(e)
 {
	 e.preventDefault();
    $.get( "/myProjet/comments/morePostComments", function( data ) {
		$('#postCommentsBlock').append(data);
    });
 }

/**
 * requête ajax permetttant d'afficher la liste des commentaires des chroniques
 */
function getChronicComments() {
	$.get("/myProjet/comments/chronicComments", function (data)
	{
		$('#displayChronicComments').append(data);
	});
}

function showMoreChronicComments(e)
{
	e.preventDefault();
   $.get( "/myProjet/comments/moreChronicComments", function( data ) {
	   $('#chronicCommentsBlock').append(data);
   });
}
/**
 * permet de répondre à un commentaire
 */
function replyComment()
{
	//on stocke dans une variable l'id du commentaire auquel on veut répondre
	var commentId = $(this).attr('data-commentId');
	//on assigne cette valeur à l'input représentant le parentCommentID
	$('#parentCommentId').val(commentId);
	//puis on met le focus sur le textarea du commentaire
	$('#comment').focus();
}


/**
 * showMenu affiche le menu avec une animation de type slide du haut vers le bas à l'affichage puis une animation slide du bas vers le haut quand on le masque
 * @param  event e
 */
function showNav(e) {
	$("nav > ul").slideToggle(200);
	$(this).toggleClass("fa-times").toggleClass("fa-bars");
}


function showSearch() {
	$('#hamburger').toggleClass('hide');
	$('#searchMobile').toggleClass('hide');
	$(this).toggleClass("fa-times").toggleClass("fa-search");
}

function editProfil(e)
{
	e.preventDefault();
	$('.input').removeAttr("disabled");
	$('#submit').removeAttr("disabled");
	$('#cancel').removeClass("disabled");
}
