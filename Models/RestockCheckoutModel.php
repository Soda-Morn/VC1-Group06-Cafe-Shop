<?php
require_once "Database/Database.php";

class RestockCheckoutModel {
    private $db;

    public function __construct() {
        // Assuming your Database class handles the connection
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getPurchaseById($purchase_item_id) {
        // Corrected the query to remove the comma and placeholder key issue
        $query = "SELECT purchase_item_id, product_name, price, product_image 
                  FROM purchase_items 
                  WHERE purchase_item_id = :purchase_item_id";

        // Fixed the placeholder and parameter array key to match
        $stmt = $this->db->query($query, ['purchase_item_id' => $purchase_item_id]);

        // Fetching the result as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
