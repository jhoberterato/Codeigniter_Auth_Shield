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
    $routes->get("profile", "AuthController::profile", ["filter" => "apiauth"]);
    $routes->get("logout", "AuthController::logout", ["filter" => "apiauth"]);

    $routes->post("addProject", "ProjectController::addProject", ["filter" => "apiauth"]);
    $routes->get("listProjects", "ProjectController::listProjects", ["filter" => "apiauth"]);
    $routes->delete("deleteProject/(:num)", "ProjectController::deleteProject/$1", ["filter" => "apiauth"]);

    $routes->get("invalid-access", "AuthController::accessDenied");
});
