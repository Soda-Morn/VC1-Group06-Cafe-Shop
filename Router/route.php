<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/StocklistController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";
require_once "Controllers/WelcomeController.php";
require_once "Controllers/LoginRegisterController.php";
require_once "Controllers/UserController.php";
require_once "Controllers/OrdermenuController.php";
require_once "Controllers/OrderlistController.php";
require_once "Controllers/PurchaseItemAddController.php";
require_once "Controllers/PurchaseitemController.php";
require_once "Controllers/CardController.php";
require_once "Controllers/SupplierController.php";


$route = new Router();
// welcome
$route->get("/", [WelcomeController::class, 'welcome']);
$route->get("/dashboard", [DashboardController::class, 'index']);

// login and register
$route->get("/login", [UserController::class, 'login']);
$route->get("/register", [UserController::class, 'register']);
$route->post("/users/store", [UserController::class, 'store']);
$route->post("/users/authenticate", [UserController::class, 'authenticate']);
$route->get("/logout", [UserController::class, 'logout']);

// Product List
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);
$route->get("/suppliers/list", [ProductDetailController::class, 'index']);

// purchase_item
$route->get("/purchase_item", [PurchaseitemController::class, 'index']);
$route->get("/purchase_item/create", [PurchaseitemController::class, 'create']);
$route->get("/purchase_item/store", [PurchaseitemController::class, 'store']);

// purchase_item_add
$route->get("/purchase_item_add", [PurchaseItemAddController::class, 'index']);
$route->get("/purchase_item_add/create", [PurchaseItemAddController::class, 'create']);
$route->post("/purchase_item_add/store", [PurchaseItemAddController::class, 'store']); // POST request for storing items



//order_list
$route->get("/order_list", [OrderlistController::class, 'index']);

// order_menu
$route->get('/order_menu', [OrdermenuController::class, 'index']);
$route->get('/order_menu/create', [OrdermenuController::class, 'create']);
$route->post('/order_menu/store', [OrdermenuController::class, 'store']);
$route->get('/order_now/show', [PurchaseItemAddController::class, 'show']);
$route->get('/order_now/preview_order/shows', [PurchaseItemAddController::class, 'shows']);

//card_order
$route->get('/orderCard', [CardController::class, 'index']);
$route->get('/orderCard/addToCart', [CardController::class, 'addToCart']);
$route->get('/orderCard/removeFromCart', [CardController::class, 'removeFromCart']);


//Inventory
$route->get('/stocklist', [StocklistController::class,'stocklist']);

$route->get('/suppliers', [SupplierController::class,'index']);
$route->get('/suppliers/list', [SupplierController::class,'index']);
$route->get('/suppliers/create', [SupplierController::class,'create']);
$route->post('/suppliers/store', [SupplierController::class,'store']);
$route->get('/suppliers/edit/{id}', [SupplierController::class, 'edit']);
$route->post('/suppliers/update/{id}', [SupplierController::class, 'update']);
$route->get('/suppliers/delete/{id}', [SupplierController::class, 'delete']);





$route->route();

