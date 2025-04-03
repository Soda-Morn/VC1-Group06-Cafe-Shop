<?php
require_once __DIR__ . '/Models/CardModel.php';

// Telegram Bot API token
define('BOT_TOKEN', '7397328031:AAG4gHikprV6zFuqKhMGDVwTZuaK7B3_dqo'); // Your bot token
define('ADMIN_CHAT_ID', '1198264749'); // Your admin chat ID
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');

// Function to send a message via Telegram
function sendTelegramMessage($chatId, $message) {
    $url = API_URL . "sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    // Log the response from Telegram API
    error_log("Telegram API sendMessage Response: " . $response);
    return $response;
}

// Function to send a photo with a caption via Telegram
function sendTelegramPhoto($chatId, $photoUrl, $caption) {
    $url = API_URL . "sendPhoto";
    $data = [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ];
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    // Log the response from Telegram API
    error_log("Telegram API sendPhoto Response: " . $response);
    return $response;
}

// Function to format checkout details into a message
function formatCheckoutMessage($checkoutDetails) {
    if (empty($checkoutDetails)) {
        return "No checkout details found.";
    }

    $message = "<b>New Checkout Notification</b>\n";
    $message .= "Sale ID: {$checkoutDetails[0]['sale_id']}\n";
    $message .= "Date of Birth (Sale Date): " . (new DateTime($checkoutDetails[0]['date_of_birth']))->format('F d, Y H:i:s') . "\n";
    $message .= "Status: {$checkoutDetails[0]['status']}\n";
    $message .= "\n<b>Items Purchased:</b>\n";

    foreach ($checkoutDetails as $item) {
        $message .= "- {$item['item']}\n";
        $message .= "  Quantity: {$item['quantity']}\n";
        $message .= "  Original Price: \${$item['original_price']}\n";
        $message .= "  Total for Item: \${$item['item_total']}\n";
    }

    $message .= "\n<b>Total Price:</b> \${{$checkoutDetails[0]['total_price']}}";
    return $message;
}

// Function to handle checkout notification
function handleCheckout($saleId) {
    error_log("Handling checkout for sale_id: {$saleId}");
    $model = new CardModel();
    $checkoutDetails = $model->getCheckoutDetails($saleId);
    error_log("Checkout Details: " . json_encode($checkoutDetails));

    if (!empty($checkoutDetails)) {
        // Format the message
        $message = formatCheckoutMessage($checkoutDetails);
        error_log("Formatted Message: {$message}");

        // Send the message to the admin
        sendTelegramMessage(ADMIN_CHAT_ID, $message);

        // Send each product's image separately with a caption
        foreach ($checkoutDetails as $item) {
            $photoUrl = $item['image'] ?? 'default_image.png';
            // Ensure the image URL is accessible (convert relative path to absolute URL if needed)
            $baseUrl = 'http://localhost:127.0.0.1/cafe/'; // Adjust this to your server URL
            $photoUrl = strpos($photoUrl, 'http') === 0 ? $photoUrl : $baseUrl . $photoUrl;
            error_log("Sending photo: {$photoUrl}");

            $caption = "<b>Product:</b> {$item['item']}\n";
            $caption .= "Quantity: {$item['quantity']}\n";
            $caption .= "Original Price: \${$item['original_price']}\n";
            $caption .= "Total for Item: \${$item['item_total']}";
            sendTelegramPhoto(ADMIN_CHAT_ID, $photoUrl, $caption);
        }
    } else {
        // Notify admin of the error
        sendTelegramMessage(ADMIN_CHAT_ID, "Error: Could not retrieve checkout details for sale_id: {$saleId}");
    }
}

// Handle checkout notification when called with sale_id
if (isset($_GET['sale_id'])) {
    $saleId = $_GET['sale_id'];
    error_log("Received sale_id: {$saleId}");
    handleCheckout($saleId);
} else {
    error_log("No sale_id provided in the request.");
}