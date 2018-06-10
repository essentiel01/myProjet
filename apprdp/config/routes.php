<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//admin
$route['inside/team/dashboard'] = 'admin/teamDashboard';
$route['inside/team/revue-de-presse/ajouter'] = 'admin/addPostForm';
$route['inside/team/chronique/ajouter'] = 'admin/addChronicForm';
$route['inside/team/analyse-actualite/ajouter'] = 'admin/addDecodageActuForm';

$route['inside/team/debat/ajouter'] = 'admin/addDebatForm';
$route['inside/team/debat/en-attente'] = 'admin/debatsOffLine';
$route['inside/team/debat/en-attente/(:any)/ajout-de-contenu'] = 'admin/addQuestionsAnswersForm/$1';

$route['inside/images'] = 'galery/showImages';
$route['inside/audios'] = 'galery/showAudios';

$route['inside/team/revue-de-presse/en-attente-de-publication'] = 'admin/postsOffline';
$route['inside/team/revue-de-presse/publiee'] = 'admin/postsOnline';

$route['inside/team/chronique/en-attente-de-publication'] = 'admin/chronicsOffline';
$route['inside/team/chronique/publiee'] = 'admin/chronicsOnline';

// la page comment ça marche
$route['comment-ca-marche'] = 'home/howItWork';
// la page de l'équipe
$route['notre-equipe'] = 'home/team';
// la page des partenaires
$route['nos-partenaires'] = 'home/partners';
// la page de contact
$route['nous-contacter'] = 'home/contactForm';
// deconnexion
$route['deconnexion'] = 'users/logout';

// accueil de la page culture
 $route['culture'] = 'culture/index';
 $route['culture/(:num)'] = 'culture/index/$1';

 $route['politique'] = 'politique/index';
 $route['politique/(:num)'] = 'politique/index/$1';

 $route['economie'] = 'economie/index';
 $route['economie/(:num)'] = 'economie/index/$1';

 $route['sport'] = 'sport/index';
 $route['sport/(:num)'] = 'sport/index/$1';

//accueil de la page débat
$route['debat'] = 'debat/index';
$route['debat/[0-9]*'] = 'debat/index/$1';
$route['debat/[a-zA-Z0-9-]+'] = 'debat/showDebat/$1';


//actualité
$route['actualites/(:any)'] = 'culture/decodageActualite/$1';

//formulaire d'inscription
$route['inscription/formulaire'] = 'users/formRegister';
//page de succès pour création de compte
$route['inscription/succes'] = 'users/register';
//mot de passe oublié
$route['mot-de-passe-oublie'] = 'users/forgottenPassword';
// formulaire de connexion
$route['connexion/formulaire'] = 'users/loginForm';
// affiche l'accueil de l'espace personnel après une connexion réussie
$route['connexion'] = 'users/login';

//page des archives de revues de presse
$route['revues-de-presse/archive'] = 'culture/postsArchive';
$route['revues-de-presse/archive/(:num)'] = 'culture/postsArchive/$1';
$route['chroniques/archive'] = 'culture/chronicsArchive';
$route['chroniques/archive/(:num)'] = 'culture/chronicsArchive/$1';

//affiche l'accueil de l'espace personnel depuis le user menu
$route['espace-personnel/profil'] = 'users/profil';
$route['profil/mise-a-jour'] = 'users/updateProfil';
$route['profil/m-a-j-photo-de-profil'] = 'users/do_upload';
//affiche la page index des favoris
$route['espace-personnel/mes-favoris'] = 'favorites/index';

//affiche la liste revues favoris
$route['espace-personnel/mes-revues-de-presse-favoris'] = 'favorites/postsfavorites';
// navigation entre les pages de la rubrique favoris
$route['espace-personnel/mes-revues-de-presse-favoris/(:num)'] = 'favorites/postsfavorites/$1';

//affiche la liste des chroniques favoris
$route['espace-personnel/mes-chroniques-favoris'] = 'favorites/chronicsfavorites';
// navigation entre les pages de la rubrique favoris
$route['espace-personnel/mes-chroniques-favoris/(:num)'] = 'favorites/chronicsfavorites/$1';

// article seul
$route['culture/publication/(:num)/(:any)'] = 'culture/singleView/$1/$2';
$route['politique/publication/(:num)/(:any)'] = 'politique/singleView/$1/$2';
$route['economie/publication/(:num)/(:any)'] = 'economie/singleView/$1/$2';
$route['sport/publication/(:num)/(:any)'] = 'sport/singleView/$1/$2';

//chronic seul
$route['culture/chronique/(:num)/(:any)'] = 'culture/chronicView/$1/$2';

// $route['culture/(:any)'] = 'culture?per_page=$1';
// $route['news'] = 'news';
// $route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'home';
