<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');

$routes->get('/todo', 'Todo::index');
$routes->post('/todo/add-task', 'Todo::addTask'); 
$routes->get('/todo/edit/(:num)', 'Todo::edit/$1'); // Edit form
$routes->post('/todo/update/(:num)', 'Todo::update/$1'); // Update task
$routes->get('/todo/delete/(:num)', 'Todo::delete/$1'); // Delete task
$routes->get('/todo/filter', 'Todo::filter');
$routes->post('/todo/mark-completed/(:num)', 'Todo::markCompleted/$1');

$routes->get('/signup', 'Signup::index'); 
$routes->post('/signup/process', 'SignUp::process'); 

$routes->get('/login', 'LoginController::index');
$routes->post('/login/process', 'LoginController::login_action');
$routes->get('/logout', 'LoginController::logout');

// Pocketify Routes
$routes->get('/', 'Expense::index');
$routes->get('expenses', 'Expense::index');
$routes->get('expenses/create', 'Expense::create');
$routes->post('expenses', 'Expense::store');
$routes->get('expenses/edit/(:num)', 'Expense::edit/$1');
$routes->post('expenses/update/(:num)', 'Expense::update/$1');
$routes->get('expenses/delete/(:num)', 'Expense::delete/$1');




