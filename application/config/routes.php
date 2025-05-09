<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'pages';
$route['404_override']         = 'not_found';
$route['translate_uri_dashes'] = FALSE;

// route admin
$route['admin'] = 'admin/dashboard';

// route pages
$route['about'] = 'pages/about';