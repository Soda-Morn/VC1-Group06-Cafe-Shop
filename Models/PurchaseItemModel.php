<?php
require_once 'Database/Database.php';

class PurchaseItemModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    // Fetch all purchase items with their stock quantity
    function getPurchases()
    {
        $sql = "SELECT pi.purchase_item_id, pi.product_name, pi.price, pi.product_image, 
                       COALESCE(SUM(sl.quantity), 0) as stock_quantity
                FROM purchase_items pi
                LEFT JOIN stock_lists sl ON pi.purchase_item_id = sl.purchase_item_id
                GROUP BY pi.purchase_item_id, pi.product_name, pi.price, pi.product_image";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new purchase item
    function createPurchase($data)
    {
        $sql = "INSERT INTO purchase_items (product_name, product_image, price) 
                VALUES (:product_name, :product_image, :price)";
        $this->pdo->query($sql, [
            'product_name' => $data['product_name'],
            'product_image' => $data['product_image'] ?? null,
            'price' => $data['price']
        ]);
    }

    // Get a specific purchase item by ID
    function getPurchase($purchase_item_id)
    {
        $stmt = $this->pdo->query(
            "SELECT purchase_item_id, product_name, price, product_image 
             FROM purchase_items 
             WHERE purchase_item_id = :purchase_item_id",
            ['purchase_item_id' => $purchase_item_id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a purchase item
    function updatePurchase($purchase_item_id, $data)
    {
        $sql = "UPDATE purchase_items 
                SET product_name = :product_name, 
                    price = :price, 
                    product_image = :product_image 
                WHERE purchase_item_id = :purchase_item_id";
        $this->pdo->query($sql, [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'product_image' => $data['product_image'] ?? null,
            'purchase_item_id' => $purchase_item_id
        ]);
    }

    // Delete related records in stock_lists
    function deleteRelatedStockLists($purchase_item_id)
    {
        $sql = "DELETE FROM stock_lists WHERE purchase_item_id = :purchase_item_id";
        $this->pdo->query($sql, ['purchase_item_id' => $purchase_item_id]);
    }

    // Delete a purchase item
    function deletePurchase($purchase_item_id)
    {
        // First, delete related records in stock_lists
        $this->deleteRelatedStockLists($purchase_item_id);

        // Then delete the purchase item
        $sql = "DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id";
        $this->pdo->query($sql, ['purchase_item_id' => $purchase_item_id]);
    }
}
?>