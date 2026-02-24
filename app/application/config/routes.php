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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['products/category/(:any)'] = 'products/category/$1';
$route['products/view/(:num)'] = 'products/view/$1';

// Admin Routes
$route['admin/login'] = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';

$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin'] = 'admin/dashboard/index';

$route['admin/products'] = 'admin/products/index';
$route['admin/products/create'] = 'admin/products/create';
$route['admin/products/edit/(:num)'] = 'admin/products/edit/$1';
$route['admin/products/delete/(:num)'] = 'admin/products/delete/$1';

$route['cart'] = 'cart/index';
$route['cart/add/(:num)'] = 'cart/add/$1';
$route['cart/remove/(:num)'] = 'cart/remove/$1';
$route['cart/update'] = 'cart/update';
$route['cart/clear'] = 'cart/clear';

$route['checkout'] = 'checkout/index';
$route['checkout/place_order'] = 'checkout/place_order';

$route['orders'] = 'orders/index';
$route['orders/success/(:num)'] = 'orders/success/$1';

$route['auth/login'] = 'auth/login';
$route['auth/register'] = 'auth/register';
$route['auth/logout'] = 'auth/logout';

$route['cart/ajax_add'] = 'cart/ajax_add';
$route['admin/orders'] = 'admin/orders/index';
$route['admin/orders/view/(:num)'] = 'admin/orders/view/$1';
$route['admin/orders/update_status/(:num)'] = 'admin/orders/update_status/$1';

$route['admin/users'] = 'admin/users/index';
$route['admin/users/edit/(:num)'] = 'admin/users/edit/$1';
$route['admin/users/delete/(:num)'] = 'admin/users/delete/$1';

$route['api/login'] = 'api/auth/login';

$route['api/products'] = 'api/products/index';
$route['api/products/(:num)'] = 'api/products/view/$1';

$route['api/cart'] = 'api/cart/get';
$route['api/cart/add'] = 'api/cart/add';

$route['api/orders/place'] = 'api/orders/place';

$route['api/home'] = 'api/home/index';

$route['api/cart/add'] = 'api/cart/add';
$route['api/cart/count'] = 'api/cart/count';
