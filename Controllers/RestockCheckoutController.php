<?php
require_once 'Models/RestockCheckoutModel.php';
require_once 'BaseController.php';

class RestockCheckoutController extends BaseController
{
    private $restockModel;

    public function __construct()
    {
        $this->restockModel = new RestockCheckoutModel();
        session_start(); // Start session to manage cart items
    }

    // Display the restock checkout page
    public function index_restock()
    {
        $orderItems = $_SESSION['cart'] ?? [];
        $this->view('/form_restock/order_now', ['orderItems' => $orderItems]);
    }

    // Add an item to the cart
    public function addStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;

            if ($itemId) {
                $purchaseItem = $this->restockModel->getPurchaseById($itemId);

                if ($purchaseItem) {
                    $purchaseItem['quantity'] = 1; // Default quantity is 1

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    // Check if the item already exists in the cart
                    $existingIndex = array_search($itemId, array_column($_SESSION['cart'], 'purchase_item_id'));

                    if ($existingIndex !== false) {
                        // If the item exists, increase the quantity
                        $_SESSION['cart'][$existingIndex]['quantity'] += 1;
                    } else {
                        // If the item does not exist, add it to the cart
                        $_SESSION['cart'][] = $purchaseItem;
                    }
                }
            }
        }
        $this->redirect('/restock_checkout');
    }

    // Remove an item from the cart
    public function removeStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;

            if ($itemId && isset($_SESSION['cart'])) {
                // Filter out the item to be removed
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($purchase) use ($itemId) {
                    return $purchase['purchase_item_id'] != $itemId;
                });
            }
        }
        $this->redirect('/restock_checkout');
    }

    // Save or update the stock list in the database
    public function saveStockList() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
            // Get the updated quantities from the form
            $quantities = $_POST['quantities'] ?? [];
    
            // Update the quantities in the session cart
            foreach ($_SESSION['cart'] as &$item) {
                if (isset($quantities[$item['purchase_item_id']])) {
                    $item['quantity'] = (int)$quantities[$item['purchase_item_id']];
                }
            }
    
            // Save or update the stock list in the database
            $this->restockModel->saveStockList($_SESSION['cart']);
    
            // Clear the cart after saving
            unset($_SESSION['cart']);
    
            // Redirect to the preview page
            $this->redirect('/restock_checkout/preview');
        }
    }
}
