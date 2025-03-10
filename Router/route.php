<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/RegistrationController.php";
require_once "Controllers/DashboardController.php";




$route = new Router();


$route->get("/Registration", [RegistrationController::class, 'Registration']);

$route->route();


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);



$route->route();
