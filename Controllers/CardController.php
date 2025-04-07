<?php
require_once 'Models/CardModel.php';
require_once 'BaseController.php';

class CardController extends BaseController {
    private $model;

    // Telegram Bot Configuration
    private $telegramBotToken = '7542835761:AAEJsRLsIlzS9QDMkKs6tyZHKCAwM3eklZY'; // Your bot token
    private $telegramChatId = '1198264749'; // Replace with your actual chat ID

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

    public function payment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Store the cart data from the form in the session for use after payment
            $_SESSION['pending_cart'] = $_POST['cart'] ?? [];
            // Redirect to the payment page
            $this->redirect('/payment');
        } else {
            // If accessed directly without POST, redirect back to the cart
            $this->redirect('/orderCard?error=Invalid request');
        }
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartData = $_SESSION['pending_cart'] ?? []; // Use the pending cart from session
            $cartItems = $_SESSION['cart'] ?? [];
            $paymentMethod = $_POST['payment_method'] ?? 'unknown'; // Get the payment method
            error_log("Cart Items in checkout(): " . json_encode($cartItems)); // Log cart items
            error_log("Cart Data from SESSION: " . json_encode($cartData)); // Log session data
            error_log("Payment Method: " . $paymentMethod); // Log payment method
    
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
                                'price' => $price,
                                'name' => $item['name'], // Include name for Telegram message
                                'image' => $item['image'] // Include image for Telegram message
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

                    // Send Telegram notification with payment method
                    $this->sendTelegramNotification($consolidatedItems, $totalPrice, $saleId, $paymentMethod);

                    // Clear both the cart and the pending cart
                    $_SESSION['cart'] = [];
                    unset($_SESSION['pending_cart']);
                    $this->redirect('/order_list?success=Checkout completed successfully');
                } catch (Exception $e) {
                    error_log("Checkout failed: " . $e->getMessage());
                    $this->redirect('/order_list?error=Checkout failed: ' . urlencode($e->getMessage()));
                }
            } else {
                $this->redirect('/order_list?error=Cart is empty');
            }
        }
    }

    private function sendTelegramNotification($items, $totalPrice, $saleId, $paymentMethod = 'unknown') {
        // Redesigned message with better formatting and emojis
        $message = "✨ *Velea Cafe - New Order Received* ✨\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "📋 *Order Details*\n";
        $message .= "🆔 Sale ID: #$saleId\n";
        $message .= "📅 Date: " . date('Y-m-d H:i:s') . "\n";
        $message .= "💳 *Payment Method:* " . ucfirst($paymentMethod) . "\n\n";
        $message .= "🛒 *Items Purchased:*\n";

        foreach ($items as $item) {
            $message .= "• {$item['name']} (x{$item['quantity']}) - $" . number_format($item['price'] * $item['quantity'], 2) . "\n";
        }

        $message .= "\n💰 *Total Price:* $" . number_format($totalPrice, 2) . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "🙏 *Thank you for choosing Velea Cafe!*\n";

        $url = "https://api.telegram.org/bot{$this->telegramBotToken}/sendMessage";
        $data = [
            'chat_id' => $this->telegramChatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Log the response for debugging
        $responseData = json_decode($response, true);
        if ($httpCode !== 200 || !$responseData['ok']) {
            error_log("Telegram API error: HTTP $httpCode - " . ($responseData['description'] ?? 'Unknown error'));
        } else {
            error_log("Telegram message sent successfully: " . $response);
        }
    }

    public function orderList() {
        $orders = $this->model->getAllOrders();
        $this->view('/order/order_list', [
            'orders' => $orders,
            'error' => $_GET['error'] ?? '',
            'success' => $_GET['success'] ?? ''
        ]);
    }

    // New helper method to notify admin via Telegram
    private function notifyAdminViaTelegram($saleId) {
        // URL of the Telegram bot script
        $telegramBotUrl = 'http://localhost:127.0.0.1/cafe/telegram_bot.php'; // Adjust this to your server URL
        // Call the Telegram bot script with the sale_id
        $response = file_get_contents("{$telegramBotUrl}?sale_id={$saleId}");
        // Log the response for debugging
        error_log("Telegram Bot Response for sale_id {$saleId}: " . $response);
    }
}
?>