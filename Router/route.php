<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";
require_once "Controllers/PurchaseitemController.php";
require_once "Controllers/RegistrationController.php";
require_once "Controllers/OrderlistController.php";


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);

// productList
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);
$route->get("/purchase_item", [PurchaseitemController::class, 'index']);
$route->get("/order_list", [OrderlistController::class, 'index']);

$route->route();
//reguster
$route->get("/Registration", [RegistrationController::class, 'Registration']);

$route->route();
