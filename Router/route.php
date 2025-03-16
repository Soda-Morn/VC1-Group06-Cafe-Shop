<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/StocklistController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";
require_once "Controllers/PurchaseitemController.php";
require_once "Controllers/PurchaseItemAddController.php";
require_once "Controllers/RegistrationController.php";
require_once "Controllers/OrderlistController.php";
require_once "Controllers/OrdermenuController.php";
require_once 'Controllers/SupplierController.php';




$route = new Router();
//Dashboard Routs
$route->get("/", [DashboardController::class, 'index']);
//Stocklist Routs
$route->get("/stocklist", [StocklistController::class, 'stocklist']);

$route->route();
// productList
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);
$route->get("/purchase_item", [PurchaseitemController::class, 'index']);
$route->get("/purchase_item_add", [PurchaseItemAddController::class, 'index']);

//order_list
$route->get("/order_list", [OrderlistController::class, 'index']);

// order_menu
$route->get('/order_menu', [OrdermenuController::class,'index']);

$route->route();
//reguster
$route->get("/Registration", [RegistrationController::class, 'Registration']);
// login routs
$route->post("/login", [LoginController::class, 'login']);

$route->route();

// supplier
$routes->get('/supplier',[SupplierController::class, 'index']);
$routes->get('/supplier/create',[SupplierController::class, 'create']);
$routes->post('/supplier/store',[SupplierController::class, 'store']);
$routes->get('/supplier/edit',[SupplierController::class, 'edit']);
$routes->put('/supplier/update',[SupplierController::class, 'update']);
$routes->delete('/supplier/delete',[SupplierController::class, 'destroy']);
