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
 * affiche les commentaires des revues de presse
 * @param  Event e [description]
 * @return {[type]} [description]
 */
 var page = 1;
 function getPostComments(e)
 {
	
	$.ajax(
 		   {
 			   "url": "/myProjet/comments/postComments",
 			   "type": "POST",
				"data": {page: page},
 			   "dataType": "json"
 		   }
 	).done(function (data)
 	   {
			console.log(data);
			if (jQuery.isEmptyObject(data) === false)
			{
				
				var output = '';
				$.each(data, function(i, value){
					 output +=  '<div class="comment-and-reply"> <div class="comment-block"> <img class="avatar-mini-comment" src="/myProjet/webroot/images/usersAvatar/' + value.userAvatar + ' " alt="avatar"> <div class="eachComment"> <div> <div class="auteur"> ' + value.userFirstName + ' ' + value.userLastName + ' le ' + value.commentDate + '</div> <div class="commentContent">' + value.commentContent + '</div></div></div> <div class="btnReply" > <button type="button" class="reply btn btn-lg btn-primary" data-commentId=' + value.commentId + '>Répondre</button></div></div>';
					 if (value.children != null)
					 {
						 $.each(value.children, function(i, value){
							  output +=  ' <div class="comment-block reply-block"> <img class="avatar-mini-comment" src="/myProjet/webroot/images/usersAvatar/' + value.userAvatar + ' " alt="avatar"><div class="eachReply"><div class="auteur"> ' + value.userFirstName + ' ' + value.userLastName + ' le ' + value.commentDate + '</div> <div class="commentContent">' + value.commentContent + '</div></div></div>';
						 });
					 }
				});
				output += '</div>';
				$('#displayPostComments').append(output);
				$('#morePostComments').show();
			} else {
				$('#morePostComments').hide();
			}
 	   }
    ).fail(function (error)
 	   {
 		   console.log(error);// TODO: penser à gererles erreurs avant la mise en prod
 	   }
    );
 }




/**
 * affiche les commentaires des chroniques
 * @return {[type]} [description]
 */
function getChronicComments()
{
	$.ajax(
		   {
			   "url": "/myProjet/comments/chronicComments",
			   "type": "POST",
			   "data": {page: page},
			   "dataType": "json"
		   }
	).done(function (data)
	   {
			console.log(data);
			if (jQuery.isEmptyObject(data) === false)
			{
				var output = '';
				$.each(data, function(i, value){
					 output +=  '<div class="comment-and-reply"><div class="comment-block"><img class="avatar-mini-comment" src="/myProjet/webroot/images/usersAvatar/' + value.userAvatar + ' " alt="avatar"> <div class="eachComment"> <div> <div class="auteur"> ' + value.userFirstName + ' ' + value.userLastName + ' le ' + value.commentDate + '</div> <div class="commentContent">' + value.commentContent + '</div></div></div> <div class="btnReply" > <button type="button" class="reply btn btn-lg btn-primary" data-commentId=' + value.commentId + '>Répondre</button></div></div>';
					 if (value.children != null)
					 {
						 $.each(value.children, function(i, value){
							  output +=  ' <div class="comment-block reply-block"> <img class="avatar-mini-comment" src="/myProjet/webroot/images/usersAvatar/' + value.userAvatar + ' " alt="avatar"> <div class="eachReply"> <div class="auteur"> ' + value.userFirstName + ' ' + value.userLastName + ' le ' + value.commentDate + '</div> <div class="commentContent">' + value.commentContent + '</div></div></div>';
						 });
					 }
				});
				output += '</div>';
				$('#displayChronicComments').append(output);
				$('#moreChronicComments').show();
			} else {
				$('#moreChronicComments').hide();
			}
	   }
   ).fail(function (error)
	   {
		   console.log(error);// TODO: penser à gererles erreurs avant la mise en prod
	   }
   );
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
function showNav(e)
{
	$("nav > ul").slideToggle(200);
	$(this).toggleClass("fa-times").toggleClass("fa-bars");
}

/**
 * affiche le formulaire de recherche
 * @return {[type]} [description]
 */
function showSearch()
{
	$('#hamburger').toggleClass('hide');
	$('#searchMobile').toggleClass('hide');
	$(this).toggleClass("fa-times").toggleClass("fa-search");
}

/**
 * active les champs du formulaire de modification de profil
 * @param  {[type]} e [description]
 * @return {[type]}   [description]
 */
function editProfil(e)
{
	e.preventDefault();
	$('.profil-form input').removeAttr("disabled");
	$('#submit').removeAttr("disabled");
	$('#cancel').removeClass("disabled");
}

/**
 * affiche les message d'erreur pendant 5sec
 * @param  {[type]} value le message d'erreur
 * @return {[type]}       [description]
 */
function show_form_error(value)
{
	if( $('#error').text() == "") {
		$('#error').append(value);
		setTimeout(function () {
			$('#error').text("");
		}, 5000);
	}
}

/**
 * enregistre une adresse emaildans la table newsletter
 * @param {[type]} e [description]
 */
function setEmailForNewsletter(e)
{
	e.preventDefault();
	var email = $('#email').val();
	$.ajax(
		{
			"url": '/myProjet/Home/emailForNewsletter',
			"type": 'POST',
			"data": {"email": email},
			"dataType": 'json'
		}
	).done(function(data)
		{
			//affiche le message d'echec de validation des données saisies
			if ( data.validation_error != null || data.validation_error != "")
			{
				show_form_error(data.validation_error);
			}
			//affiche le messagede succès
			if ( data.success != null || data.success != "")
			{
				if( $('#save-success').text() == "") {
					$('#save-success').append(data.success);
					setTimeout(function () {
						$('#save-success').text("");
					}, 5000);
				}
			}
			//affiche le message d'échec si l'enregistrement dans la base échoue
			if ( data.fail != null || data.fail != "")
			{
				show_form_error(data.fail);
			}
			$('#email').val(""); //vide le champ après soumission du form.
		}
	).fail(function()
		{
			show_form_error("La requête a échouée");
		}
	);
}
