/**
 * envoie les données de la revue à ajouter à la liste des favoris via la methode post de ajax
 * @param Event e événnement click
 */
function addFavorite(e)
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
 * ajoute un commentaire
 * @param Event e evennement click
 */
function addComment(e)
{
	// on vérifie si quelqu'un est connectée
	if ($(this).attr('data-userId') != '') {
		//si quelqu'un est connecté on désactive le lien href puis on exécute le requête ajax
		e.preventDefault();
		$.post(
			"/myProjet/comments/addComment",
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
 * requête ajax permetttant d'afficher la liste des commentaires
 */
function getComments()
{
	$.get(
		"/myProjet/comments/index", {postId: $('#btnComment').attr('data-postId')}
	).done(function (data) {
		//on efface tous les commentaires et on les réafiche chaque 1500ms
		$('#displayComments').empty();
		//conversion des de data au format json
		data = JSON.parse(data);

		// //on recupère chaque commentaire dans la variable eachComment puis on l'affiche dans le bloc displayComment
		$.each(data, function (index){
			var eachComment = $('<div class="eachComment panel ">').html(
				'<div class="commentAuthor">Par ' + data[index].userFirstName + ' ' + data[index].userLastName + ' le ' + data[index].commentDate + '</div>'
				+
				'<div class="commentContent jumbotron jumbotron-fluid">' + data[index].commentContent + '</div>'
				+
				'<button type="button" class="reply btn btn-lg btn-primary" data-commentId=' + data[index].commentId + '>Répondre</button>'
			);
			//on vérifie si le commentaire à une réponse. si oui on affiche lesrèponses à la suite du commentaire
			if (data[index].children != '') {
				$.each(data[index].children, function(i){
					var eachReply = $('<div class="eachComment" style="margin-left: 40px">').html(
					'<div class="commentAuthor">Par ' + data[index].children[i].userFirstName + ' ' + data[index].children[i].userLastName + ' le ' + data[index].children[i].commentDate + '</div>'
					+
					'<div class="commentContent jumbotron jumbotron-fluid">' + data[index].children[i].commentContent + '</div>');
					$(eachComment).append(eachReply);
				});
			 }
			$('#displayComments').append(eachComment);
		});
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
