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

            if (!empty($cartData)) {
                try {
                    // Step 1: Always create a new sale_id for each checkout
                    $saleId = $this->model->createNewSale();

                    // Step 2: Consolidate cart items by product ID and sum their quantities
                    $consolidatedItems = [];
                    $totalPrice = 0;
                    foreach ($cartItems as $index => $item) {
                        $productId = $item['product_ID'];
                        $quantity = isset($cartData[$index]['quantity']) ? (int)$cartData[$index]['quantity'] : 1;
                        $price = $item['price'];

                        if (isset($consolidatedItems[$productId])) {
                            // If the product already exists, sum the quantity
                            $consolidatedItems[$productId]['quantity'] += $quantity;
                        } else {
                            // Otherwise, create a new entry
                            $consolidatedItems[$productId] = [
                                'product_id' => $productId,
                                'quantity' => $quantity,
                                'price' => $price
                            ];
                        }

                        // Add to the total price for this checkout
                        $totalPrice += $price * $quantity;
                    }

                    // Step 3: Insert sale items with the consolidated quantities
                    foreach ($consolidatedItems as $item) {
                        $productId = $item['product_id'];
                        $quantity = $item['quantity'];

                        if ($productId && $quantity > 0) {
                            // Since this is a new sale_id, there should be no existing entries
                            // Insert a new entry with the consolidated quantity
                            $this->model->addSaleItem($saleId, $productId, $quantity);
                        }
                    }

                    // Step 4: Update the total price in the sales table
                    $this->model->updateSaleTotalPrice($saleId, $totalPrice);

                    // Step 5: Clear the cart after checkout
                    $_SESSION['cart'] = [];
                    $this->redirect('/orderCard?success=Checkout completed successfully');
                } catch (Exception $e) {
                    error_log("Checkout failed: " . $e->getMessage());
                    $this->redirect('/orderCard?error=Checkout failed: ' . urlencode($e->getMessage()));
                }
            } else {
                $this->redirect('/orderCard?error=Cart is empty');
            }
        }
    }
}
?>