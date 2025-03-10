<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/StocklistController.php";


$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);
//Stocklist Routs
$route->get("/stocklist", [StocklistController::class, 'stocklist']);

$route->route();