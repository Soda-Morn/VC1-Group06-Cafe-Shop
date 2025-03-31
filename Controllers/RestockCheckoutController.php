<?php
require_once 'Models/RestockCheckoutModel.php';
require_once 'BaseController.php';

class RestockCheckoutController extends BaseController
{
    private $restockModel;

    public function __construct()
    {
        $this->restockModel = new RestockCheckoutModel();
        session_start();
    }

    /**
     * Display the checkout page with cart items
     */
    public function index_restock()
    {
        $orderItems = $_SESSION['cart'] ?? [];
        $purchaseItems = $this->restockModel->getAllPurchaseItems();
        $this->view('/form_restock/order_now', [
            'orderItems' => $orderItems,
            'purchaseItems' => $purchaseItems
        ]);
    }

    /**
     * Add a new item to the cart (appends to existing cart)
     */
    public function addStock()
    {
        $response = ['success' => false, 'message' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($itemId) {
                $purchaseItem = $this->restockModel->getPurchaseById($itemId);

                if ($purchaseItem) {
                    $purchaseItem['quantity'] = $quantity;

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    $existingIndex = array_search($itemId, array_column($_SESSION['cart'], 'purchase_item_id'));

                    if ($existingIndex !== false) {
                        // Update quantity if item already exists
                        $_SESSION['cart'][$existingIndex]['quantity'] = $quantity;
                    } else {
                        // Append new item to cart (do not clear)
                        $_SESSION['cart'][] = $purchaseItem;
                    }

                    $response['success'] = true;
                } else {
                    $response['message'] = "Item not found for purchase_item_id: $itemId";
                    error_log("Item not found for purchase_item_id: " . $itemId);
                }
            } else {
                $response['message'] = "No purchase_item_id provided in POST data";
                error_log("No purchase_item_id provided in POST data");
            }
        } else {
            $response['message'] = "Invalid request method";
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // If this is an AJAX request, return JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            // For non-AJAX requests, redirect
            $this->redirect('/restock_checkout');
        }
    }

    /**
     * Update the quantity of an item in the cart
     */
    public function updateQuantity()
    {
        $response = ['success' => false, 'message' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($itemId && isset($_SESSION['cart'])) {
                $existingIndex = array_search($itemId, array_column($_SESSION['cart'], 'purchase_item_id'));

                if ($existingIndex !== false) {
                    $_SESSION['cart'][$existingIndex]['quantity'] = $quantity;
                    $response['success'] = true;
                } else {
                    $response['message'] = 'Item not found in cart';
                }
            } else {
                $response['message'] = 'Invalid request or cart is empty';
            }
        } else {
            $response['message'] = 'Invalid request method';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Remove an item from the cart
     */
    public function removecard()
    {
        $response = ['success' => false, 'message' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['purchase_item_id'] ?? null;

            if ($productId && isset($_SESSION['cart'])) {
                $initialCount = count($_SESSION['cart']);
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
                    return $item['purchase_item_id'] != $productId;
                });
                $_SESSION['cart'] = array_values($_SESSION['cart']);

                if (count($_SESSION['cart']) < $initialCount) {
                    $response['success'] = true;
                } else {
                    $response['message'] = 'Item not found in cart';
                }
            } else {
                $response['message'] = 'Invalid request or cart is empty';
            }
        } else {
            $response['message'] = 'Invalid request method';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Clear the cart and redirect to /purchase_item_add
     */
    public function clearCartAndRedirect()
    {
        // Clear the cart
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
            $_SESSION['cart'] = [];
        }

        // Redirect to /purchase_item_add
        $this->redirect('/purchase_item_add');
    }

    /**
     * Show the preview page with only the items from the current cart
     */
    public function preview()
    {
        $cartItems = $_SESSION['cart'] ?? [];
        $this->view('/form_restock/preview_order', [
            'cartItems' => $cartItems
        ]);
    }

    /**
     * Handle form submission to update stock list
     */
    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantities = $_POST['quantities'] ?? [];
    
            if (empty($quantities)) {
                error_log("No quantities found in POST data");
            }
    
            // Calculate total price before updating stock
            $totalPrice = 0;
            $cartItems = $_SESSION['cart'] ?? [];
    
            // Loop through cart items to calculate total price
            foreach ($cartItems as $item) {
                $purchaseItemId = $item['purchase_item_id'];
                $quantity = isset($quantities[$purchaseItemId]) ? (int)$quantities[$purchaseItemId] : 0;
    
                if ($quantity <= 0) {
                    continue; // Skip items with invalid quantities
                }
    
                // Get the price from the cart item (price is already fetched in the cart from purchase_items)
                $price = $item['price'] ?? 0;
                $totalPrice += $price * $quantity;
            }
    
            // Insert total price into purchases table if there are valid items
            if ($totalPrice > 0) {
                $this->restockModel->insertPurchase($totalPrice);
            } else {
                error_log("Total price is 0, skipping insert into purchases table");
            }
    
            // Proceed with the existing stock update logic
            foreach ($quantities as $purchaseItemId => $quantity) {
                $quantity = (int)$quantity;
                if ($quantity <= 0) {
                    error_log("Skipping purchase_item_id $purchaseItemId due to quantity $quantity");
                    continue;
                }
    
                $result = $this->restockModel->updateStock($purchaseItemId, $quantity);
                if (!$result) {
                    error_log("Failed to update stock for purchase_item_id: $purchaseItemId");
                }
            }
    
            $_SESSION['cart'] = [];
            $this->redirect('/stocklist');
        }
    }
}