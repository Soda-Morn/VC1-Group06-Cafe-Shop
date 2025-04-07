<?php
require_once 'Database/Database.php';

class PaymentUploadModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    // Method to store or update the QR code image path in the qr_codes table
    public function storeQRCodeImage($imagePath)
    {
        // Check if a record with id = 1 exists
        $checkSql = "SELECT COUNT(*) FROM qr_codes WHERE id = :id";
        $checkStmt = $this->pdo->query($checkSql, [':id' => 1]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // Update the existing record
            $sql = "UPDATE qr_codes SET image_path = :image_path, updated_at = NOW() WHERE id = :id";
            $params = [
                ':image_path' => $imagePath,
                ':id' => 1
            ];
            $this->pdo->query($sql, $params);
        } else {
            // Insert a new record if id = 1 doesn't exist
            $sql = "INSERT INTO qr_codes (id, image_path, created_at, updated_at) VALUES (:id, :image_path, NOW(), NOW())";
            $params = [
                ':id' => 1,
                ':image_path' => $imagePath
            ];
            $this->pdo->query($sql, $params);
        }

        return true;
    }
}