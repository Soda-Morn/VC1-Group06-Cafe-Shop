<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/StocklistController.php";
require_once "Controllers/LoginRegisterController.php";
require_once "Controllers/UserController.php";
require_once "Controllers/OrdermenuController.php";
require_once "Controllers/OrderlistController.php";
require_once "Controllers/PurchaseitemController.php";
require_once "Controllers/CardController.php";
require_once "Controllers/RestockCheckoutController.php";
require_once "Controllers/SupplierController.php";
require_once "Controllers/CategoriesController.php";
require_once "Controllers/Profile_infoController.php";
require_once "Controllers/SalesController.php";
require_once "Controllers/PaymentController.php";
require_once "Controllers/PaymentUploadController.php";

$route = new Router();

// Dashboard
$route->get("/dashboard", [SalesController::class, 'index']);

// login and register
$route->get("/", [UserController::class, 'login']);
$route->get("/register", [UserController::class, 'register']);
$route->get("/login", [UserController::class, 'login']);
$route->post("/users/store", [UserController::class, 'store']);
$route->post("/users/authenticate", [UserController::class, 'authenticate']);
$route->get("/logout", [UserController::class, 'logout']);

// purchase_item
$route->get("/purchase_item_add", [PurchaseitemController::class, 'index']);
$route->get("/purchase_item_add/addToCart", [PurchaseitemController::class, 'addToCart']);
$route->get("/purchase_item_add/create", [PurchaseitemController::class, 'create']);
$route->post("/purchase_item_add/store", [PurchaseitemController::class, 'store']);
$route->get("/purchase_item/destroy/{id}", [PurchaseitemController::class, 'destroy']);
$route->get("/purchase_item_add/update/{id}", [PurchaseitemController::class, 'update']);
$route->get("/purchase_item_add/edit/{id}", [PurchaseitemController::class, 'edit']);

// restock_checkout
$route->get("/restock_checkout", [RestockCheckoutController::class, 'index_restock']);
$route->get("/restock_checkout/addStock", [RestockCheckoutController::class, 'addStock']);
$route->get("/restock_checkout/removecard", [RestockCheckoutController::class, 'removecard']);
$route->get("/restock_checkout/clearCart", [RestockCheckoutController::class, 'clearCart']);
$route->get("/restock_checkout/submit", [RestockCheckoutController::class, 'submit']);
$route->get("/restock_checkout/clearCartAndRedirect", [RestockCheckoutController::class, 'clearCartAndRedirect']);
$route->get("/restock_checkout/preview", [RestockCheckoutController::class, 'preview']);
$route->get("/restock_checkout/updateQuantity", [RestockCheckoutController::class, 'updateQuantity']);

// order_list
$route->get("/order_list", [OrderlistController::class, 'index']);

// order_menu
$route->get('/order_menu', [OrdermenuController::class, 'index']);
$route->get('/order_menu/create', [OrdermenuController::class, 'create']);
$route->post('/order_menu/store', [OrdermenuController::class, 'store']);
$route->post('/order_menu/destroy/{id}', [OrdermenuController::class, 'destroy']);

// card_order (for CardController)
$route->get('/orderCard', [CardController::class, 'index']);
$route->post('/orderCard/addToCart', [CardController::class, 'addToCart']); 
$route->post('/orderCard/removeFromCart', [CardController::class, 'removeFromCart']); 
$route->post('/orderCard/payment', [CardController::class, 'payment']); // 
$route->post('/orderCard/checkout', [CardController::class, 'checkout']); // 
$route->post('/orderCard/addMultipleToCart', [CardController::class, 'addMultipleToCart']); 
$route->get('/orderCard/updateQuantity', [CardController::class, 'updateQuantity']);
$route->get('/orderCard/orderList', [CardController::class, 'orderList']);
$route->get('/orderCard/updateCartQuantity', [CardController::class, 'updateCartQuantity']);

// Inventory 
$route->get('/stocklist', [StocklistController::class, 'stocklist']);
$route->get('/stocklist/edit/{id}', [StocklistController::class, 'edit']);
$route->post('/stocklist/update/{id}', [StocklistController::class, 'update']);
$route->post('/stocklist/delete/{id}', [StocklistController::class, 'delete']);
$route->get('/stocklist/viewDetails/{id}', [StocklistController::class, 'viewDetails']);

// supplier
$route->get('/suppliers', [SupplierController::class, 'index']);
$route->get('/suppliers/list', [SupplierController::class, 'index']);
$route->get('/suppliers/create', [SupplierController::class, 'create']);
$route->post('/suppliers/store', [SupplierController::class, 'store']);
$route->get('/suppliers/edit/{id}', [SupplierController::class, 'edit']);
$route->post('/suppliers/update/{id}', [SupplierController::class, 'update']);
$route->get('/suppliers/delete/{id}', [SupplierController::class, 'delete']);

// Category
$route->get("/Categories", [CategoriesController::class, 'index']);
$route->get("/Categories/create", [CategoriesController::class, 'create']);
$route->post("/Categories/store", [CategoriesController::class, 'store']);
$route->post("/Categories/edit/{id}", [CategoriesController::class, 'edit']);
$route->get("/Categories/delete/{id}", [CategoriesController::class, 'delete']);
$route->post("/Categories/update/{id}", [CategoriesController::class, 'update']);

// payment_checkout
$route->get('/payment', [PaymentController::class, 'payment']); 
$route->get('/payment_upload', [PaymentUploadController::class, 'index']);
$route->get('/payment/upload', [PaymentUploadController::class, 'index']);


//profile_management
$route->get("/Profile_info", [Profile_infoController::class, 'index']);
$route->get("/Profile_info/profile_edit", [Profile_infoController::class, 'edit']);
$route->post("/Profile_info/profile_edit", [Profile_infoController::class, 'edit']);





// Execute the routing
$route->route();