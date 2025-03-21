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

    // Remove an item from the cart and the stock_lists table
    public function removeStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;

            if ($itemId && isset($_SESSION['cart'])) {
                try {
                    // Delete the item from stock_lists if it exists with 'pending' status
                    $this->restockModel->deletePendingStockById($itemId);

                    // Filter out the item from the session cart
                    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($purchase) use ($itemId) {
                        return $purchase['purchase_item_id'] != $itemId;
                    });

                    // Set a success message
                    $_SESSION['message'] = "Item removed successfully!";
                } catch (Exception $e) {
                    // Log the error and set an error message
                    error_log("Failed to delete stock item: " . $e->getMessage());
                    $_SESSION['message'] = "Failed to remove item.";
                }
            }
        }
        // Always redirect to the checkout page
        $this->redirect('/restock_checkout');
    }

    // Save or update the stock list in the database
    public function saveStockList()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
            try {
                // Get the updated quantities from the form
                $quantities = $_POST['quantities'] ?? [];

                // Update the quantities in the session cart
                foreach ($_SESSION['cart'] as &$item) {
                    if (isset($quantities[$item['purchase_item_id']])) {
                        $item['quantity'] = (int)$quantities[$item['purchase_item_id']];
                        // Ensure quantity is at least 1
                        if ($item['quantity'] < 1) {
                            $item['quantity'] = 1;
                        }
                    }
                }
                unset($item); // Unset the reference to avoid issues

                // Save or update the stock list in the database
                $this->restockModel->saveStockList($_SESSION['cart']);

                // Clear the cart after saving
                unset($_SESSION['cart']);

                // Check if the request is an AJAX request
                $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
                if ($isAjax) {
                    // Return a JSON response for AJAX requests (used by the Preview button)
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success']);
                    exit;
                }

                // For non-AJAX requests, redirect to the checkout page
                $this->redirect('/restock_checkout');
            } catch (Exception $e) {
                // Log the error and return an error response for AJAX requests
                error_log("Error in saveStockList: " . $e->getMessage());
                $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
                if ($isAjax) {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(['status' => 'error', 'message' => 'Failed to save stock list: ' . $e->getMessage()]);
                    exit;
                }
                // For non-AJAX requests, redirect with an error message
                $_SESSION['message'] = "Failed to save stock list.";
                $this->redirect('/restock_checkout');
            }
        }

        // If not a POST request, redirect to the checkout page
        $this->redirect('/restock_checkout');
    }

    // Show the preview page (no data needed since JavaScript handles it)
    public function preview()
    {
        $this->view('/form_restock/preview_order', []);
    }
}
?>