<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

//API Routes
$routes->group("api", ["namespace" => "App\Controllers\API"], function($routes){
    $routes->post("register", "AuthController::register");
    $routes->post("login", "AuthController::login");
    $routes->get("profile", "AuthController::profile");
    $routes->get("logout", "AuthController::logout");

    $routes->post("addProject", "ProjectController::addProject");
    $routes->get("listProjects", "ProjectController::listProjects");
    $routes->delete("deleteProject/(:num)", "ProjectController::deleteProject/$1");
});
