<?php
require_once 'Models/CardModel.php';
require_once 'BaseController.php';

class CardController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new CardModel();
        session_start(); // Start the session to store cart items
    }

    public function index() {
        $cartItems = $_SESSION['cart'] ?? [];
        $error = $_GET['error'] ?? '';
        $success = $_GET['success'] ?? '';
        $this->view('/order_card/order_card', [
            'cartItems' => $cartItems,
            'error' => $error,
            'success' => $success
        ]);
    }

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            if ($productId) {
                $product = $this->model->getProductById($productId);
                
                if ($product) {
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    // Check if the product already exists in the cart
                    $existingIndex = array_search($productId, array_column($_SESSION['cart'], 'product_ID'));

                    if ($existingIndex !== false) {
                        // Increment the quantity if the product already exists
                        $_SESSION['cart'][$existingIndex]['quantity'] += 1;
                    } else {
                        // Add the product with an initial quantity of 1
                        $product['quantity'] = 1;
                        $_SESSION['cart'][] = $product;
                    }

                    // Check if the request is AJAX
                    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                        // Return JSON response for AJAX request
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'message' => 'Product added to cart successfully',
                            'cart_count' => count($_SESSION['cart'])
                        ]);
                        exit;
                    }
                }
            }
            // For non-AJAX requests, redirect as before
            $this->redirect('/orderCard');
        }
        // For invalid requests (non-AJAX)
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid request'
        ]);
        exit;
    }

    public function addMultipleToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedProducts = $_POST['selected_products'] ?? [];

            if (!empty($selectedProducts)) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                foreach ($selectedProducts as $productId) {
                    $product = $this->model->getProductById($productId);

                    if ($product) {
                        // Check if the product already exists in the cart
                        $existingIndex = array_search($productId, array_column($_SESSION['cart'], 'product_ID'));

                        if ($existingIndex !== false) {
                            // Increment the quantity if the product already exists
                            $_SESSION['cart'][$existingIndex]['quantity'] += 1;
                        } else {
                            // Add the product with an initial quantity of 1
                            $product['quantity'] = 1;
                            $_SESSION['cart'][] = $product;
                        }
                    }
                }
            }
        }
        $this->redirect('/orderCard');
    }

    public function removeFromCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;

            if ($productId && isset($_SESSION['cart'])) {
                // Remove the item from the session cart
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
                    return $item['product_ID'] != $productId;
                });

                // Reindex the array to avoid gaps in the indices
                $_SESSION['cart'] = array_values($_SESSION['cart']);

                // Return a JSON success response
                echo json_encode(['success' => true, 'message' => 'Item removed successfully']);
                return;
            } else {
                // Return a JSON failure response
                echo json_encode(['success' => false, 'message' => 'Invalid product ID or empty cart']);
                return;
            }
        }

        // Return a JSON failure response for invalid request method
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartData = $_POST['cart'] ?? [];
            $cartItems = $_SESSION['cart'] ?? [];

            if (!empty($cartItems)) {
                try {
                    $saleId = $this->model->createNewSale();
                    $consolidatedItems = [];
                    $totalPrice = 0;

                    foreach ($cartItems as $index => $item) {
                        $productId = $item['product_ID'];
                        $quantity = isset($cartData[$index]['quantity']) ? (int)$cartData[$index]['quantity'] : (int)$item['quantity'];
                        $price = $item['price'];

                        if (isset($consolidatedItems[$productId])) {
                            $consolidatedItems[$productId]['quantity'] += $quantity;
                        } else {
                            $consolidatedItems[$productId] = [
                                'product_id' => $productId,
                                'quantity' => $quantity,
                                'price' => $price
                            ];
                        }
                        $totalPrice += $price * $quantity;
                    }

                    foreach ($consolidatedItems as $item) {
                        $productId = $item['product_id'];
                        $quantity = $item['quantity'];

                        if ($productId && $quantity > 0) {
                            $this->model->addSaleItem($saleId, $productId, $quantity);
                        }
                    }

                    $this->model->updateSaleTotalPrice($saleId, $totalPrice);
                    $_SESSION['cart'] = [];
                    $this->redirect('/order_list?success=Checkout completed successfully'); // Updated route
                } catch (Exception $e) {
                    error_log("Checkout failed: " . $e->getMessage());
                    $this->redirect('/order_list?error=Checkout failed: ' . urlencode($e->getMessage())); // Updated route
                }
            } else {
                $this->redirect('/order_list?error=Cart is empty'); // Updated route
            }
        }
    }
    public function orderList() { // New method for /order_list route
        $orders = $this->model->getAllOrders(); // Fetch orders
        $this->view('/order/order_list', [
            'orders' => $orders,
            'error' => $_GET['error'] ?? '',
            'success' => $_GET['success'] ?? ''
        ]);
    }
}
?>