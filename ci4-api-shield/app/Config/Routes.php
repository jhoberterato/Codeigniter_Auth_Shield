<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/services', 'ServiceController::index');

//Students Route Query Builder
$routes->get('/addStudent', 'StudentsController::insertStudent');
$routes->get('/updateStudent', 'StudentsController::updateStudent');
$routes->get('/deleteStudent', 'StudentsController::deleteStudent');
$routes->get('/students', 'StudentsController::selectStudent');

//Students Route Model Based Query Builder
$routes->get('/add-student', 'SitesController::insertStudent');
$routes->get('/update-student', 'SitesController::updateStudent');
$routes->get('/delete-student', 'SitesController::deleteStudent');
$routes->get('/getAll-students', 'SitesController::getStudents');

//API Routes (Routes Methods)
$routes->get('/list-student', 'SitesController::listStudents');
$routes->post('/save-student', 'SitesController::saveStudent');
$routes->put('/edit-student', 'SitesController::editStudent');
$routes->patch('/edit-student', 'SitesController::editStudent');
$routes->delete('/remove-student', 'SitesController::removeStudent');

//Example of Route Group
$routes->group("test", function($routes){
    $routes->get("set-role", "AdminController::setRole");
    $routes->get("update-profile", "AdminController::updateProfile");
    $routes->get("add-user", "AdminController::addUser");
});

//Example of Route Group with Namespace
$routes->group("admin", ["namespace" => "App\Controllers\Admin"], function($routes){
    $routes->get("set-role", "AdminController::setRole");
    $routes->get("update-profile", "AdminController::updateProfile");
    $routes->get("add-user", "AdminController::addUser");
});

$routes->group("seller", ["namespace" => "App\Controllers\Seller"], function($routes){
    $routes->get("add-product", "SellerController::addProduct");
    $routes->get("add-category", "SellerController::addCategory");
});

//Unprotected Routes
$routes->get('route1', 'SitesController::method1');
$routes->get('route3', 'SitesController::method3');

//Protected Routes
$routes->get('route2', 'SitesController::method2', [
    "filter" => "myauth"
]);

$routes->get('login', 'SitesController::login');
$routes->get('logout', 'SitesController::logout');
$routes->get('access-denied', 'SitesController::accessDenied');

