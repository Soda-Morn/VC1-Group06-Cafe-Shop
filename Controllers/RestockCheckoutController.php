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

    public function index_restock()
    {
        $orderItems = $_SESSION['cart'] ?? [];
        $purchaseItems = $this->restockModel->getAllPurchaseItems();
        $this->view('/form_restock/order_now', [
            'orderItems' => $orderItems,
            'purchaseItems' => $purchaseItems
        ]);
    }

    public function addStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;

            if ($itemId) {
                $purchaseItem = $this->restockModel->getPurchaseById($itemId);

                if ($purchaseItem) {
                    $purchaseItem['quantity'] = 1;

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    $existingIndex = array_search($itemId, array_column($_SESSION['cart'], 'purchase_item_id'));

                    if ($existingIndex !== false) {
                        $_SESSION['cart'][$existingIndex]['quantity'] += 1;
                    } else {
                        $_SESSION['cart'][] = $purchaseItem;
                    }
                }
            }
        }
        $this->redirect('/restock_checkout');
    }

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

                    // Return a JSON response for AJAX
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                    exit;
                } catch (Exception $e) {
                    // Log the error and return a JSON error response
                    error_log("Failed to delete stock item: " . $e->getMessage());
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Failed to remove item']);
                    exit;
                }
            }
        }

        // Fallback redirect for non-AJAX requests
        $this->redirect('/restock_checkout');
    }

    public function submitOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
            try {
                $quantities = $_POST['quantities'] ?? [];

                foreach ($_SESSION['cart'] as &$item) {
                    if (isset($quantities[$item['purchase_item_id']])) {
                        $item['quantity'] = (int)$quantities[$item['purchase_item_id']];
                        if ($item['quantity'] < 1) {
                            $item['quantity'] = 1;
                        }
                    }
                }
                unset($item);

                $this->restockModel->saveStockList($_SESSION['cart']);
                unset($_SESSION['cart']);

                // Return a JSON response for AJAX
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit;
            } catch (Exception $e) {
                // Log the error and return a JSON error response
                error_log("Error in submitOrder: " . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Failed to submit order']);
                exit;
            }
        }

        // Fallback redirect for non-AJAX requests
        $this->redirect('/restock_checkout');
    }

    public function preview()
    {
        $this->view('/form_restock/preview_order', []);
    }
}
?>