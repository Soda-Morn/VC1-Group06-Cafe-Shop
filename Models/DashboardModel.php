<?php
class DashboardModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }
    function getProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
        
    }

}
?>