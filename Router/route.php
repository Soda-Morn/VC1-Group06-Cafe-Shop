<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/DashboardController.php";
require_once "Controllers/StocklistController.php";
require_once "Controllers/ProductListController.php";
require_once "Controllers/ProductDetailController.php";
require_once "Controllers/LoginRegisterController.php";
require_once "Controllers/UserController.php";
require_once "Controllers/OrdermenuController.php";
require_once "Controllers/OrderlistController.php";
require_once "Controllers/PurchaseitemController.php";
require_once "Controllers/CardController.php";
require_once "Controllers/RestockCheckoutController.php";

$route = new Router();

// Dashboard
$route->get("/dashboard", [DashboardController::class, 'index']);
// login and register
$route->get("/", [UserController::class, 'login']);
$route->get("/register", [UserController::class, 'register']);
$route->get("/login", [UserController::class, 'login']);
$route->post("/users/store", [UserController::class, 'store']);
$route->post("/users/authenticate", [UserController::class, 'authenticate']);
$route->get("/logout", [UserController::class, 'logout']);



// Product List
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_detail", [ProductDetailController::class, 'index']);

// purchase_item
$route->get("/purchase_item_add", [PurchaseitemController::class, 'index']);
$route->get("/purchase_item_add/create", [PurchaseitemController::class, 'create']);
$route->post("/purchase_item_add/store", [PurchaseitemController::class, 'store']);
$route->get("/purchase_item/destroy/{id}", [PurchaseitemController::class, 'destroy']);
$route->get("/purchase_item_add/update/{id}", [PurchaseitemController::class, 'update']);
$route->get("/purchase_item_add/edit/{id}", [PurchaseitemController::class, 'edit']);

// restock_checkout
$route->get("/restock_checkout", [RestockCheckoutController::class, 'index_restock']);
$route->get("/restock_checkout/addStock", [RestockCheckoutController::class, 'addStock']);
$route->get("/restock_checkout/removeStock", [RestockCheckoutController::class, 'removeStock']);
$route->get("/restock_checkout/saveStockList", [RestockCheckoutController::class, 'saveStockList']);
$route->get("/restock_checkout/preview", [RestockCheckoutController::class, 'preview']);

// order_list
$route->get("/order_list", [OrderlistController::class, 'index']);

// order_menu
$route->get('/order_menu', [OrdermenuController::class, 'index']);
$route->get('/order_menu/create', [OrdermenuController::class, 'create']);
$route->post('/order_menu/store', [OrdermenuController::class, 'store']);

// card_order (for CardController)
$route->get('/orderCard', [CardController::class, 'index']);
$route->get('/orderCard/addToCart', [CardController::class, 'addToCart']);
$route->get('/orderCard/removeFromCart', [CardController::class, 'removeFromCart']);

// Inventory
$route->get('/stocklist', [StocklistController::class, 'stocklist']);

// Execute the routing
$route->route();
