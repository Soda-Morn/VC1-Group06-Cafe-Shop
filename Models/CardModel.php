<?php
class CardModel {
    private $db;

    public function __construct() {
        require_once "Database.php";
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }
    
    public function getProductById($productId) {
        $query = "SELECT product_ID, name, price, image, description FROM products WHERE product_ID = :productId";
        $stmt = $this->db->query($query, ['productId' => $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
