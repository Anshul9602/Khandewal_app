<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */ 
 //for web
 
 


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//user 
$routes->get('home', 'Home::index');
$routes->get('/', 'Home::login');
$routes->post('login/authenticate', 'Home::authenticate');
$routes->post('/admin_register', 'Home::admin_register');
$routes->get('/logout', 'Home::logout');
$routes->get('/user-list', 'Home::user_list');
$routes->get('/price-list', 'Home::hotel_list');
$routes->post('/update_price', 'Home::update_price');


$routes->get('/get_user/(:num)', 'Users::get_user/$1');
$routes->get('/get_user_mobile/(:num)', 'Users::get_user_mobile/$1');
$routes->post('/auth/number_check', 'Auth::check_mobile');
$routes->post('/auth/work_up/(:num)', 'Users::work_ex_up/$1');
$routes->post('/users/work_exp', 'Users::work_ex');
$routes->post('/auth/verify_otp/(:num)', 'Auth::verifyOTP/$1');
$routes->post('/auth/register', 'Auth::register');
$routes->post('/auth/user_update','Auth::user_update');
$routes->post('/auth/hotelior_update','Auth::Huser_update');

$routes->get('user_delete/(:num)','Users::user_del/$1');


// status update
$routes->post('/users/status_e/(:num)', 'Users::status_e_update/$1');
$routes->post('/users/status_d/(:num)', 'Users::status_d_update/$1');






// user image 
$routes->get('/profile_img_saved', 'profile_img::index');
$routes->post('/profile_img_save/store', 'profile_img::store');
$routes->post('/profile_img_saved/Byid/(:num)','profile_img::show/$1');
$routes->post('/profile_img_saved/Byuserid/(:num)','profile_img::show_userid/$1');
$routes->post('/profile_img_save/delete/(:num)','profile_img::distroy/$1');  // user deleted




// basic details

$routes->get('/basic/all_city', 'Basic::get_state_city');
$routes->get('/basic/web', 'Basic::get');
$routes->post('/basic/store', 'Basic::save');
$routes->post('/basic/Update','Basic::update');
$routes->post('/basic/delete','Basic::delete');  // user deleted
$routes->get('/basic/state','Basic::get_state');  // all state
$routes->post('/basic/city_by_state/(:num)','Basic::city_by_state/$1');  // all state


$routes->post('/basic/profile_health_userid/(:num)','Basic::getUserProfileEmptyFields/$1');  // all state

$routes->post('/basic/Hotelprofile_health_userid/(:num)','Basic::getHProfileEmptyFields/$1');  //profile helth

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

