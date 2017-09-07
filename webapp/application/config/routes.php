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
$route['default_controller'] = "index";
$route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;


//ADMINISTRATIVO


//USUARIOS
$route[''] = 'index/index';
$route['register'] = 'index/register';
$route['login'] = 'index/login';
$route['esqueci'] = 'index/esqueci';
$route['sair'] = 'index/sair';

$route['admin/configuracoes/bloqueios'] = 'admin/bloqueios';
$route['admin/configuracoes/tags'] = 'admin/tags';

$route['dashboard/administrativo/usuarios'] = 'dashboard/usuarios';
$route['dashboard/administrativo/usuarios/novo'] = 'dashboard/novo_usuario';
$route['dashboard/administrativo/usuarios/editar-usuario/(:num)'] = 'dashboard/editar_usuario/$1';

$route['dashboard/administrativo/pesquisadores'] = 'dashboard/pesquisadores';
$route['dashboard/administrativo/pesquisadores/novo'] = 'dashboard/novo_pesquisador';
$route['dashboard/administrativo/pesquisadores/editar-pesquisador/(:num)'] = 'dashboard/editar_pesquisador/$1';

$route['dashboard/administrativo/coletores'] = 'dashboard/coletores';
$route['dashboard/administrativo/coletores/novo'] = 'dashboard/novo_coletor';
$route['dashboard/administrativo/coletores/editar-coletor/(:num)'] = 'dashboard/editar_coletor/$1';

$route['dashboard/administrativo/locais'] = 'dashboard/locais';
$route['dashboard/administrativo/locais/estado/(:num)'] = 'dashboard/cidades/$1';
$route['dashboard/administrativo/locais/estado/(:num)/cidade/(:num)'] = 'dashboard/bairros_comunidades/$1/$2';


$route['dashboard/pesquisas/nova'] = 'dashboard/pesquisas_novo';

$route['dashboard/pesquisas/p/(:num)/dados'] = 'dashboard/pesquisa_dados/$1';
$route['dashboard/pesquisas/p/(:num)/questoes'] = 'dashboard/pesquisa_questoes/$1';


$route['dashboard/pesquisas/p/(:num)/coletores'] = 'dashboard/pesquisa_coletores/$1';
$route['dashboard/pesquisas/p/(:num)/coletores/novo'] = 'dashboard/pesquisa_coletor_novo/$1';
$route['dashboard/pesquisas/p/(:num)/coletores/edita/(:num)'] = 'dashboard/pesquisa_coletor_edita/$1/$2';
$route['dashboard/pesquisas/p/(:num)/coletores/sincronizar'] = 'dashboard/pesquisa_coletor_sincronizar/$1';

$route['dashboard/configuracoes/pesquisas'] = 'dashboard/configuracoes_pesquisas';
$route['dashboard/configuracoes/pesquisas/editar/(:num)'] = 'dashboard/configuracoes_pesquisas_editar/$1';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
// $route['api/pesquisa/(:num)'] = 'api/coletor/pesquisa/$1';
// $route['api/coletor/syncup/(:num)'] = 'api/coletor/syncup/$1';
// $route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8