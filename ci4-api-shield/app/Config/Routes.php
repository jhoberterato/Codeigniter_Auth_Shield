<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/services', 'ServiceController::index');

//Students Route
$routes->get('/addStudent', 'StudentsController::insertStudent');
$routes->get('/updateStudent', 'StudentsController::updateStudent');
