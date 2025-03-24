<?php
require_once "Database/Database.php";

class RestockCheckoutModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    /**
     * Get purchase item details by ID
     */
    public function getPurchaseById($purchase_item_id)
    {
        $query = "SELECT purchase_item_id, product_id, product_name, price, product_image 
                  FROM purchase_items 
                  WHERE purchase_item_id = :purchase_item_id";

        $stmt = $this->db->query($query, ['purchase_item_id' => $purchase_item_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all purchase items for the dropdown
     */
    public function getAllPurchaseItems()
    {
        $query = "SELECT purchase_item_id, product_id, product_name, price, product_image 
                  FROM purchase_items";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update or insert stock quantity in the stock_lists table
     */
    public function updateStock($purchaseItemId, $quantity)
    {
        $purchaseItem = $this->getPurchaseById($purchaseItemId);
        if (!$purchaseItem) {
            error_log("Purchase item not found for purchase_item_id: $purchaseItemId");
            return false;
        }

        $productId = $purchaseItem['product_id'];

        $query = "SELECT stock_list_id, quantity FROM stock_lists WHERE purchase_item_id = :purchase_item_id AND status = 'pending'";
        $stmt = $this->db->query($query, ['purchase_item_id' => $purchaseItemId]);
        $existingStock = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingStock) {
            $newQuantity = $existingStock['quantity'] + $quantity;
            $updateQuery = "UPDATE stock_lists 
                            SET quantity = :quantity, date = NOW() 
                            WHERE stock_list_id = :stock_list_id";
            try {
                $this->db->query($updateQuery, [
                    'quantity' => $newQuantity,
                    'stock_list_id' => $existingStock['stock_list_id']
                ]);
            } catch (Exception $e) {
                error_log("Failed to update stock_lists: " . $e->getMessage());
                return false;
            }
        } else {
            $insertQuery = "INSERT INTO stock_lists (purchase_item_id, product_id, quantity, date, status) 
                            VALUES (:purchase_item_id, :product_id, :quantity, NOW(), 'pending')";
            try {
                $this->db->query($insertQuery, [
                    'purchase_item_id' => $purchaseItemId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            } catch (Exception $e) {
                error_log("Failed to insert into stock_lists: " . $e->getMessage());
                return false;
            }
        }

        return true;
    }
}