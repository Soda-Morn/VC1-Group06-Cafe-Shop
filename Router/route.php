<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";
require_once "Controllers/RegistrationController.php";
require_once "Controllers/RegistrationController.php";
require_once "Models/RegistrationModel.php";

$route = new Router();
// Dashboard Routes
$route->get("/", [DashboardController::class, 'index']);

// Product List
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);



// Authentication
$route->get("/login", [UserController::class, 'login']);
$route->post("/login", [UserController::class, 'authenticate']);
$route->get("/logout", [UserController::class, 'logout']);

$route->route();
