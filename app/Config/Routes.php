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
 
 
 $routes->get('/web', 'Web::index');
$routes->get('/about_web', 'About_web::index');
$routes->get('/services_web', 'Services_web::index');
$routes->get('/contact_web', 'Contact_web::index');
$routes->get('/help_web', 'Help_web::index');

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


$routes->get('/get_user/(:num)', 'Users::get_user/$1');
$routes->get('/get_user_mobile/(:num)', 'Users::get_user_mobile/$1');
$routes->post('/auth/number_check', 'Auth::check_mobile');
$routes->post('/auth/work_up/(:num)', 'Users::work_ex_up/$1');
$routes->post('/users/work_exp', 'Users::work_ex');
$routes->post('/auth/verify_otp/(:num)', 'Auth::verifyOTP/$1');
$routes->post('/auth/register', 'Auth::register');
$routes->post('/auth/user_update','Auth::user_update');
$routes->post('/auth/hotelior_update','Auth::Huser_update');
$routes->post('user_update','Auth::user_update_web');
$routes->get('user_delete/(:num)','Users::user_del/$1');


// status update
$routes->post('/users/status_e/(:num)', 'Users::status_e_update/$1');
$routes->post('/users/status_d/(:num)', 'Users::status_d_update/$1');

// Job  
$routes->get('/job', 'Job::index');
$routes->post('/job/store', 'Job::store');
$routes->post('/job/Byid/(:num)','Job::show/$1');
$routes->post('/job/Byuserid/(:num)','Job::user_show/$1');
$routes->post('/job/update/(:num)','Job::update/$1');
$routes->post('/job/delete/(:num)','Job::distroy/$1');  // user deleted


// Job apply
$routes->get('/job_apply', 'Job_Apply::index');
$routes->post('/job_apply/store', 'Job_Apply::store');
$routes->post('/job_apply/Byid/(:num)','Job_Apply::show/$1');
$routes->post('/job_apply_count/Byid_jobid/(:num)','Job_Apply::count_job/$1');
$routes->post('/job_apply/Byid_user/(:num)','Job_Apply::show_user/$1');
$routes->post('/job/status_update/(:num)','Job_Apply::st_update/$1');
$routes->post('/job_apply/userByid/(:num)','Job_Apply::user_show/$1');
$routes->post('/job_apply/update/(:num)','Job_Apply::update/$1');
$routes->post('/job_apply/delete/(:num)','Job_Apply::distroy/$1');  // user deleted


// Job save 
$routes->get('/job_saved', 'Job_save::index');
$routes->post('/job_save/store', 'Job_save::store');
$routes->post('/job_saved/Byuserid/(:num)','Job_save::show/$1');
$routes->post('/job_save/delete/(:num)','Job_save::distroy/$1');  // user deleted

// Job resume
$routes->get('/res_saved', 'resume::index');
$routes->post('/res_save/store', 'resume::store');
$routes->post('/res_saved/Byid/(:num)','resume::show/$1');
$routes->post('/res_saved/Byuserid/(:num)','resume::show_userid/$1');
$routes->post('/res_save/delete/(:num)','resume::distroy/$1');  // user deleted

// user image 
$routes->get('/profile_img_saved', 'profile_img::index');
$routes->post('/profile_img_save/store', 'profile_img::store');
$routes->post('/profile_img_saved/Byid/(:num)','profile_img::show/$1');
$routes->post('/profile_img_saved/Byuserid/(:num)','profile_img::show_userid/$1');
$routes->post('/profile_img_save/delete/(:num)','profile_img::distroy/$1');  // user deleted

// user ex.
$routes->get('/user/workingExperience', 'Users::get');
$routes->get('/user/work_ex_id/(:num)', 'Users::get_id/$1');
$routes->post('/user_work_ex/store', 'Users::work_ex');
$routes->get('/user_work_ex/By_userId/(:num)','Users::work_show/$1');
$routes->post('/user_work_ex/Update_ById/(:num)','Users::work_ex_update/$1');
$routes->post('/user_work_ex/delete/(:num)','Users::delete_w_ex/$1');  // user deleted


// user education.
$routes->get('/user/education', 'Users::edu_get');
$routes->get('/user/edu_id/(:num)', 'Users::edu_get_id/$1');
$routes->post('/user_education/store', 'Users::education');
$routes->get('/user_education/By_userId/(:num)','Users::education_show/$1');
$routes->post('/user_education/Update_ById/(:num)','Users::education_update/$1');
$routes->post('/user_education/delete/(:num)','Users::delete_education/$1');  // user deleted



// job pref.
$routes->get('/user/job_pref', 'Job_pref::get');
$routes->post('/user/job_pref/(:num)', 'Job_pref::show/$1');
$routes->post('/user/job_pref_sub', 'Job_pref::sub_show');
$routes->post('/user/job_prf/store', 'Job_pref::save');
$routes->post('/user/job_pref/Update_ById/(:num)','Job_pref::update/$1');
$routes->post('/user/job_pref/delete/(:num)','Job_pref::destroy/$1');  // user deleted

// user job pref.
$routes->get('/user_job_pref', 'Job_pref::user_get');
$routes->post('/user_job_pref/(:num)', 'Job_pref::user_show/$1');
$routes->get('/user_job_pref_userid/(:num)', 'Job_pref::show_userid/$1');
$routes->post('/user_job_prf/store', 'Job_pref::user_save');
$routes->post('/user_job_pref/Update_ById/(:num)','Job_pref::user_update/$1');
$routes->post('/user_job_pref/delete/(:num)','Job_pref::user_destroy/$1');  // user deleted

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

