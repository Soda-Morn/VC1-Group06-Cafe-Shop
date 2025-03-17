<?php
require_once 'Database/Database.php';

class PurchaseItemModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    // Fetch all purchase items
    function getPurchases()
    {
        $stmt = $this->pdo->query("SELECT * FROM purchase_items");
        return $stmt->fetchAll();
    }

    // Create a new purchase item
    function createPurchase($data)
    {
        // Use query for insertion with placeholders
        $sql = "INSERT INTO purchase_items (product_name, product_image, price) 
                VALUES ('" . $data['product_name'] . "', 
                        '" . ($data['product_image'] ?? null) . "', 
                        '" . $data['price'] . "')";
        $this->pdo->query($sql);
    }

    // Get a specific purchase item by ID
    function getPurchase($purchase_item_id)
    {
        $stmt = $this->pdo->query("SELECT purchase_item_id, product_name, price, product_image 
                                   FROM purchase_items 
                                   WHERE purchase_item_id = '$purchase_item_id'");
        return $stmt->fetch();
    }
}
