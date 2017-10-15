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
/*
 * Admin Route
 */
$route['admin/auth/login'] = 'Auth/login';
$route['admin/auth'] = 'Auth/index';
$route['admin/auth/add'] = 'Auth/add';
$route['admin/auth/usr_update/(:num)'] = 'Auth/update_username/$1';
$route['admin/auth/pwd_update/(:num)'] = 'Auth/update_password/$1';
$route['admin/auth/delete/(:num)'] = 'Auth/delete/$1';
$route['admin/auth/competence/(:num)'] = 'Auth/competence/$1';
$route['admin/auth/competence']['post'] = 'Auth/competence';
$route['admin/auth/usr_update']['post'] = 'Auth/update_username';
$route['admin/auth/pwd_update']['post'] = 'Auth/update_password';
$route['admin/auth/delete'] = 'Auth/delete';
$route['auth/logout'] = 'Auth/logout';
$route['admin'] = 'Admin';
//管理者-學年度
$route['admin/year/interval'] = 'Year_interval/admin_cp';
$route['admin/year/interval/add'] = 'Year_interval/add';
$route['admin/year/interval/update/(:num)'] = 'Year_interval/update/$1';
$route['admin/year/interval/delete/(:num)'] = 'Year_interval/delete/$1';
$route['admin/year/interval/set/default/(:num)'] = 'Year_interval/setDefault/$1';
$route['admin/year/interval/update']['post'] = 'Year_interval/update';
$route['admin/year/interval/set/default']['post'] = 'Year_interval/setDefault';
$route['admin/year/interval/delete']['post'] = 'Year_interval/delete';
//管理者-設備名稱
$route['admin/device/name'] = 'Device_name/admin_index';
$route['admin/device/name/add'] = 'Device_name/add';
$route['admin/device/name/update'] = 'Device_name/update';
$route['admin/device/name/update/(:num)'] = 'Device_name/update/$1';
$route['admin/device/name/delete/(:num)'] = 'Device_name/delete/$1';
$route['admin/device/name/delete']['post'] = 'Device_name/delete';
//管理者-設備分類
$route['admin/device/category'] = 'Device_category/admin_index';
$route['admin/device/category/add'] = 'Device_category/add';
$route['admin/device/category/update/(:num)'] = 'Device_category/update/$1';
$route['admin/device/category/update']['post'] = 'Device_category/update';
$route['admin/device/category/delete/(:num)'] = 'Device_category/delete/$1';
$route['admin/device/category/delete']['post'] = 'Device_category/delete';
//管理者-故障分類
$route['admin/fault/category'] = 'Fault_category/admin_index';
$route['admin/fault/category/add'] = 'Fault_category/add';
$route['admin/fault/category/update/(:num)'] = 'Fault_category/update/$1';
$route['admin/fault/category/update']['post'] = 'Fault_category/update';
$route['admin/fault/category/delete/(:num)'] = 'Fault_category/delete/$1';
$route['admin/fault/category/delete']['post'] = 'Fault_category/delete';
//管理者-報修
$route['admin/device/repair'] = 'Device_repair/admin_index';
$route['admin/device/repair/search'] = 'Device_repair/admin_search';
$route['admin/device/repair/add'] = 'Device_repair/add';
$route['admin/device/repair/view/(:num)'] = 'Device_repair/view/$1';
$route['admin/device/repair/update/(:num)'] = 'Device_repair/update/$1';
$route['admin/device/repair/delete/(:num)'] = 'Device_repair/delete/$1';
$route['admin/device/repair/update']['post'] = 'Device_repair/update';
$route['admin/device/repair/delete']['post'] = 'Device_repair/delete';
//管理者-維修狀態
$route['admin/device/repair/status'] = 'Status/admin_index';
$route['admin/device/repair/status/add'] = 'Status/add';
$route['admin/device/repair/status/update/(:num)'] = 'Status/update/$1';
$route['admin/device/repair/status/update']['post'] = 'Status/update';
$route['admin/device/repair/status/delete/(:num)'] = 'Status/delete/$1';
$route['admin/device/repair/status/delete']['post'] = 'Status/delete';
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'Device_repair/guest_add';
$route['device/repair'] = 'Device_repair/guest_add';
$route['device/repair/showlst'] = 'Device_repair/show_repair_status';
$route['device/repair/showlst/search'] = 'Device_repair/search_repair_status';
//檢修員
$route['inspector'] = 'Admin/inspector_index';
$route['inspector/device/repair'] = 'Device_repair/inspector_admincp';
$route['inspector/device/repair/updata/(:num)'] = 'Device_repair/inspector_update/$1';
$route['inspector/device/repair/updata']['post'] = 'Device_repair/inspector_update';
$route['inspector/device/repair/view/(:num)'] = 'Device_repair/inspector_view/$1';
$route['inspector/device/repair/search'] = 'Device_repair/inspector_search';
//ajax
$route['ajax/fault/category/get/(:num)'] = 'Fault_category/getOptionData/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
