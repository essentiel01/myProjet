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

// deconnexion
$route['deconnexion'] = 'userslog/logout';

// accueil de la page culture
$route['culture'] = 'culture/index';
// navigation entre les pages de la rubrique culture
$route['culture/(:num)'] = 'culture/index/$1';

//formulaire d'inscription
$route['inscription/formulaire'] = 'userregister/index';
//page de succès pour création de compte
$route['inscription/succes'] = 'userregister/register';

// formulaire de connexion
$route['connexion/formulaire'] = 'userslog/index';
// affiche l'accueil de l'espace personnel après une connexion réussie
$route['connexion-reussie'] = 'userslog/login';

//affiche l'accueil de l'espace personnel depuis le user menu
$route['espace-personnel'] = 'userslog/userDashboard';
//affiche la page index des favoris
$route['espace-personnel/mes-favoris'] = 'favorites/index';

//affiche la liste revues favoris
$route['espace-personnel/mes-revues-de-presse-favoris'] = 'favorites/postsfavorites';
// navigation entre les pages de la rubrique favoris
$route['espace-personnel/mes-revues-de-presse-favoris/(:num)'] = 'favorites/postsfavorites/$1';

// article seul
$route['culture/publication/(:num)/(:any)'] = 'culture/singleView/$1/$2';
//chronic seul
$route['culture/chronique/(:num)/(:any)'] = 'culture/chronicView/$1/$2';

// $route['culture/(:any)'] = 'culture?per_page=$1';
// $route['news'] = 'news';
// $route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'welcome';
