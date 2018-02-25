/**
 * envoie les données de la revue à ajouter à la liste des favoris via la methode post de ajax
 * @param Event e événnement click
 */
function addFavorite(e)
{
	if ($(this).attr('data-userId') != '') {

		e.preventDefault();
		$.post(
			"/myProjet/favorites/addPosts",
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
