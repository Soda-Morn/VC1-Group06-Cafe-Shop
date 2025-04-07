<?php
require_once 'Database/Database.php';

class PaymentModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    // Method to get the QR code image path from the qr_codes table
    public function getQRCodeImage()
    {
        $sql = "SELECT image_path FROM qr_codes WHERE id = :id";
        $params = [':id' => 1]; // Assuming you want the QR code with id = 1, adjust as needed
        $stmt = $this->pdo->query($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['image_path'] : null; // Return the image path or null if not found
    }
}