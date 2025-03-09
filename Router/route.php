<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/ProductListController.php";


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);

// productList
$route->get("/product_list", [ProductListController::class, 'index']);

$route->route();