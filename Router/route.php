<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/DashboardController.php";



$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);

// login routs
$route->post("/login", [LoginController::class, 'login']);




$route->route();