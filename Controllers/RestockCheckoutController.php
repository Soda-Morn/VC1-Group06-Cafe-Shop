<?php
require_once 'Models/RestockCheckoutModel.php';
require_once 'BaseController.php';

class RestockCheckoutController extends BaseController {
    private $restockModel;

    public function __construct() {
        $this->restockModel = new RestockCheckoutModel();
        session_start(); // Start session to manage cart items
    }

    public function index_restock() {
        $orderItems = $_SESSION['cart'] ?? [];
        $this->view('/form_restock/order_now', ['orderItems' => $orderItems]);
    }

    public function addStock() {
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

    public function removeStock() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemId = $_POST['purchase_item_id'] ?? null;

            if ($itemId && isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($purchase) use ($itemId) {
                    return $purchase['purchase_item_id'] != $itemId;
                });
            }
        }
        $this->redirect('/restock_checkout');
    }
}
?>
