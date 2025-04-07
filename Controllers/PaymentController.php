<?php
require_once "Models/PaymentModel.php";
require_once 'BaseController.php';

class PaymentController extends BaseController {
    private $payment;

    public function __construct() {
        $this->payment = new PaymentModel();
        session_start(); // Ensure session is started
    }

    public function payment() {
        // Get cart items and pending cart data from session
        $cartItems = $_SESSION['cart'] ?? [];
        $cartData = $_SESSION['pending_cart'] ?? [];

        // Calculate total price
        $totalPrice = 0;
        if (!empty($cartItems)) {
            foreach ($cartItems as $index => $item) {
                $quantity = isset($cartData[$index]['quantity']) ? (int)$cartData[$index]['quantity'] : (int)$item['quantity'];
                $price = $item['price'];
                $totalPrice += $price * $quantity;
            }
        }

        // Fetch the QR code image path from the model
        $qrImagePath = $this->payment->getQRCodeImage();

        // Pass the total price, cart items, and QR image path to the view
        $this->view('/payment/payment', [
            'totalPrice' => $totalPrice,
            'cartItems' => $cartItems,
            'qrImagePath' => $qrImagePath // Add the QR image path to the view data
        ]);
    }
}