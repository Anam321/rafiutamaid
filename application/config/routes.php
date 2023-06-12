<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['sitemap\.xml'] = 'sitemap';

$route['login'] = 'administrasi/auth';
// $route['administrator'] = 'administrasi/dashboard';
$route['Profil'] = 'administrasi/profil';

$route['jasa-layanan'] = 'jasa';
$route['(:any)/(:num)'] = 'jasa/detail/$1/$2';
$route['portfolio/(:any)/(:num)'] = 'portfolio/detail/$1/$2';
