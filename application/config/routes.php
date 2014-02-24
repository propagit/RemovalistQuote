<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['suppliers'] = "store/suppliers";
$route['aboutus'] = "store/aboutus";
$route['contactus'] = "store/contactus";
$route['privacy_policy'] = "store/privacy_policy";
$route['terms_and_conditions'] = "store/terms_and_conditions";
$route['suppliermore'] = "store/suppliermore";
$route['faq'] = "store/faq";

//steps routes
$route['step2'] = "store/step2";
$route['step3'] = "store/step3";
$route['confirmation'] = "store/confirmation";
$route['signupsuccess'] = "store/signupsuccess";

//query string
$route['/?utm_source(:any)'] = "store"; 

//new seo pages
$route['why_choose_removalist_quote'] = "store/why_choose_removalist_quote";
$route['removalist_services'] = "store/removalist_services";
$route['moving_home'] = "store/moving_home";
$route['moving_office'] = "store/moving_office";
$route['moving_to_storage'] = "store/moving_to_storage";

$route['default_controller'] = "store";
$route['forgot-password'] = "store/forgot";
$route['return-policy'] = "content/return_policy";
$route['terms-and-conditions'] = "content/terms";
$route['delivery-details'] = "content/delivery_details";
$route['size-chart'] = "content/size_chart";
$route['contact'] = "content/contact";
$route['sendmsg'] = "content/sendmsg";
$route['subscribe'] = "content/subscribe";
$route['ajax_subscribe'] = "content/ajax_subscribe";
$route['privacy-policy'] = "content/privacy";
$route['scaffolding_trigger'] = "";
$route['admin'] = "admin/store";
$route['admin/login'] = "admin/authorize/login";
$route['admin/logout'] = "admin/authorize/logout";
$route['admin/validate'] = "admin/authorize/validate";

//new seo pages
$route['removalist/(:any)/(:any)'] = "content/removalist/$1/$2";
$route['removalist/(:any)'] = "content/removalist/$1";
$route['removalist'] = "content/removalist";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */