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
        $this->view('/order_card/order_card', ['cartItems' => $cartItems]);
    }

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            if ($productId) {
                $product = $this->model->getProductById($productId);
                
                if ($product) {
                    $product['quantity'] = 1;

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    $existingIndex = array_search($productId, array_column($_SESSION['cart'], 'product_ID'));

                    if ($existingIndex !== false) {
                        $_SESSION['cart'][$existingIndex]['quantity'] += 1;
                    } else {
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
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
                    return $item['product_ID'] != $productId;
                });
            }
        }
        $this->redirect('/orderCard');
    }
}
?>
