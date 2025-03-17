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
$route->get("/purchase_item", [PurchaseitemController::class, 'index']);
$route->get("/purchase_item_add", [PurchaseItemAddController::class, 'index']);

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


$route->get('/order_menu', [OrdermenuController::class,'index']);

//Inventory
$route->get('/stocklist', [StocklistController::class,'stocklist']);

$route->route();

