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

    // Update a purchase item
    function updatePurchase($purchase_item_id, $data)
    {
        $sql = "UPDATE purchase_items 
                SET product_name = '" . $data['product_name'] . "', 
                    price = '" . $data['price'] . "', 
                    product_image = '" . ($data['product_image'] ?? null) . "' 
                WHERE purchase_item_id = '$purchase_item_id'";

        $this->pdo->query($sql);
    }

    // Delete a purchase item
    function deletePurchase($purchase_item_id)
    {
        $sql = "DELETE FROM purchase_items WHERE purchase_item_id = '$purchase_item_id'";
        $this->pdo->query($sql);
    }
}
