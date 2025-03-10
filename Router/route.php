<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);

// productList
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);
require_once "Controllers/RegistrationController.php";
require_once "Controllers/DashboardController.php";




$route = new Router();


$route->get("/Registration", [RegistrationController::class, 'Registration']);

$route->route();


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);



$route->route();
