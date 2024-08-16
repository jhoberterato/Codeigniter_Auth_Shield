<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// API Routes
$routes->group("api", ["namespace" => "App\Controllers\API"], function($routes){
    $routes->post("add-student", "APIController::addStudent");
    $routes->get("list-students", "APIController::listStudents");
    $routes->get("student-info/(:num)", "APIController::studentInfo/$1");
    $routes->put("update-student/(:num)", "APIController::updateStudent/$1");
    $routes->delete("delete-student/(:num)", "APIController::deleteStudent/$1");
});