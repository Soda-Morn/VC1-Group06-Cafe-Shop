<?php
require_once "Database/Database.php";

class RestockCheckoutModel
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    // Get purchase item details by ID
    public function getPurchaseById($purchase_item_id)
    {
        $query = "SELECT purchase_item_id, product_id, product_name, price, product_image 
                  FROM purchase_items 
                  WHERE purchase_item_id = :purchase_item_id";

        $stmt = $this->db->query($query, ['purchase_item_id' => $purchase_item_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Clear all pending items in stock_lists
    public function clearPendingStock()
    {
        $query = "DELETE FROM stock_lists WHERE status = 'pending'";
        $this->db->query($query);
    }

    // Save or update the stock list when preview is clicked
    public function saveStockList($orderItems)
    {
        foreach ($orderItems as $item) {
            // Check if the product already exists in the stock_lists table with a 'pending' status
            $checkQuery = "SELECT * FROM stock_lists WHERE purchase_item_id = :purchase_item_id AND status = 'pending'";
            $checkStmt = $this->db->query($checkQuery, ['purchase_item_id' => $item['purchase_item_id']]);
            $existingItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                // If the product exists, update the quantity
                $updateQuery = "UPDATE stock_lists SET quantity = :quantity WHERE purchase_item_id = :purchase_item_id AND status = 'pending'";
                $this->db->query($updateQuery, [
                    'quantity' => $item['quantity'],
                    'purchase_item_id' => $item['purchase_item_id']
                ]);
            } else {
                // If the product does not exist, insert a new record
                $insertQuery = "INSERT INTO stock_lists (purchase_item_id, product_id, quantity, status, date) 
                                VALUES (:purchase_item_id, :product_id, :quantity, 'pending', NOW())";
                $this->db->query($insertQuery, [
                    'purchase_item_id' => $item['purchase_item_id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity']
                ]);
            }
        }
    }

    // Fetch items for preview (not used in this JavaScript-based approach)
    public function getPreviewItems()
    {
        $query = "
            SELECT p.purchase_item_id, p.product_id, p.product_name AS name, p.price, p.product_image AS image, 
                COALESCE(s.quantity, 0) AS quantity
            FROM purchase_items p
            LEFT JOIN stock_lists s ON p.purchase_item_id = s.purchase_item_id AND s.status = 'pending'
        ";

        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>