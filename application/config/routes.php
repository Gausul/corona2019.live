<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['livedata/(:any)/(:any)'] = 'welcome/livedata/$1/$2';
$route['404_override'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;
