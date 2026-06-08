<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default home page
$routes->get('/', 'HomeController::index');

// User authentication
$routes->get('login', 'UserController::login');
$routes->post('login/process', 'UserController::loginProcess');
$routes->get('register', 'UserController::register');
$routes->post('register/process', 'UserController::registerProcess');
$routes->get('logout', 'UserController::logout');

// Forgot password
$routes->get('forgotpassword', 'UserController::forgotPassword');
$routes->post('forgotpassword/process', 'UserController::processForgotPassword');

// Reset password
$routes->get('resetpassword/(:any)', 'UserController::resetPassword/$1');
$routes->post('resetpasswordprocess', 'UserController::processResetPassword');

// Dashboard (after login)
//both
//profile(che)
$routes->get('profile', 'UserController::profile');            // Show profile
$routes->post('profile/updateProfile', 'UserController::updateProfile'); // Update profile
$routes->post('profile/changePassword', 'UserController::changePassword'); // Change password

//member
//menu
$routes->get('menu', 'UserController::dashboardM'); 

//My Rental
$routes->get('myRental', 'UserController::myRental'); 
$routes->get('rentnow/(:num)', 'UserController::rentNow/$1');
$routes->get('returnbook/(:num)', 'UserController::returnBook/$1');

// favBook page
$routes->get('favBook', 'UserController::favBook');          
$routes->post('add-favorite', 'UserController::addFavorite');
$routes->post('remove-favorite/(:num)', 'UserController::removeFavorite/$1');

//Admin
$routes->get('main', 'UserController::dashboard');
$routes->post('dashboard/sendReminder', 'UserController::sendReminder');


//rentalHistory(adlina)
$routes->get('rentalHistory', 'UserController::rentalHistory');
$routes->get('Rental/edit/(:num)', 'UserController::edit/$1');
$routes->post('Rental/update/(:num)', 'UserController::update/$1');
$routes->get('Rental/delete/(:num)', 'UserController::delete/$1');

//user(zahwa)
$routes->get('userList', 'UserController::userList');
$routes->get('addUserPage', 'UserController::addUserPage');//baiki lagi
$routes->post('add', 'UserController::addUser');
$routes->get('edit/(:num)', 'UserController::editUser/$1');
$routes->post('user/update/(:num)', 'UserController::updateUser/$1');
$routes->get('user/delete/(:num)', 'UserController::deleteUser/$1');

//Book(Asma)
$routes->get('book', 'UserController::bookList'); // Book list
$routes->get('user/edit-book/(:num)', 'UserController::editBook/$1');
$routes->post('user/update-book/(:num)', 'UserController::updateBook/$1');
$routes->get('book/delete/(:num)', 'UserController::deleteBook/$1');
$routes->get('addbookpage', 'UserController::addBookPage');
$routes->post('savebook', 'UserController::saveBook');
$routes->get('user/addbookpage', 'UserController::addBookPage');

//report(nana)
$routes->get('report', 'ReportController::index');
$routes->get('/reports/monthly-rental', 'ReportController::monthlyRental');
$routes->get('/reports/most-rented', 'ReportController::mostRented');
$routes->get('/reports/overdue', 'ReportController::overdueRentals');
$routes->get('/reports/favorites', 'ReportController::favoriteBooks');
$routes->get('/reports/return-timeliness', 'ReportController::returnTimeliness');


// Optional: auto routing (CI4 v4.3+ recommends keeping this off for security)
$routes->setAutoRoute(true);
