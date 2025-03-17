<?php
require_once "Database/Database.php";
class CardModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }
    
    public function getProductById($productId) {
        $query = "SELECT product_ID, name, price, image, description FROM products WHERE product_ID = :product_ID";
        $stmt = $this->db->query($query, ['product_ID' => $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
