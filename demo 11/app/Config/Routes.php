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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/hello','Hello::index');
$routes->get('/login', 'Login::index');
$routes->get('/profile','UserProfile::index');
$routes->get('/signup','Signup::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('dashboard/Rating/rate', 'Dashboard::rate');
$routes->post('/dashboard/Rating', 'Dashboard::Rating');
$routes->get('/courseprofile','CourseProfile::index');
$routes->post('/login/check_login','Login::check_login');
$routes->get('/login/logout','Login::logout');
$routes->post('/signup/check_signup', 'Signup::check_signup');
$routes->post('/upload/upload_file', 'Upload::upload_file');
$routes->get('/upload', 'Upload::index');
$routes->post('/profile/update','UserProfile::update');
$routes->get('/courses', 'Searchbox::index');
$routes->get('/courses/getSearchValue', 'Searchbox::getSearchValue');
$routes->post('/courses/getcourses','Searchbox::getcourse');
$routes->post('/profile/update_image','UserProfile::update_image');
$routes->get('movie', 'MovieController::index');
$routes->get('email','EmailController::index');
$routes->post('/email/send','EmailController::send');
$routes->post('/resetPass/Confirm', 'EmailController::setPassword');
$routes->post('/confirmEmail/Finish', 'Signup::Confirmed');
$routes->get('/courses/(:segment)', 'Searchbox::page1/$1');
$routes->get('/location', 'Location::index');
$routes->get('/course/fetchCourses/(:num)/(:num)', 'Searchbox::fetchCourses/$1/$2');
$routes->get('/enroll', 'Searchbox::addCourse');
$routes->get('/wish', 'Searchbox::addWish');
$routes->get('/location', 'Location::index');
$routes->get('/pdf', 'Receipt::index');
$routes->get('/cart','Cart::index');
$routes->get('/remove', 'Cart::remove');
$routes->get('/data', 'DataController::index');
$routes->get('/data/load_more_data', 'DataController::loadMoreData');
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
