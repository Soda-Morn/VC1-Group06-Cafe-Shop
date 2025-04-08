<?php
require_once 'Database/Database.php';

// Telegram bot token
$botToken = '7542835761:AAEJsRLsIlzS9QDMkKs6tyZHKCAwM3eklZY';

// Initialize the database
$db = new Database("localhost", "cafe_shop_db", "root", "");

// Read incoming Telegram update
$update = json_decode(file_get_contents('php://input'), true);

// Check if the update contains a message
if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $text = $update['message']['text'];

    // Check if the user sent the /start command
    if ($text === '/start') {
        // Store the chat ID in the database (replace any existing entry)
        $query = "INSERT INTO telegram_chats (chat_id, created_at) VALUES (:chat_id, NOW()) 
                  ON DUPLICATE KEY UPDATE chat_id = :chat_id, created_at = NOW()";
        $params = ['chat_id' => $chatId];
        $db->query($query, $params);

        // Send a confirmation message to the user
        $message = "✅ Your Telegram chat ID has been registered! You will now receive checkout notifications.";
        $url = "https://api.telegram.org/bot$botToken/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Log the response for debugging
        error_log("Telegram webhook response: " . $response);
    }
}

// Respond to Telegram to acknowledge receipt of the update
http_response_code(200);
echo "OK";
?>