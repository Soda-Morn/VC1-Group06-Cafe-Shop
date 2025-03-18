<?php
require_once 'Database/Database.php';
class StockListModel {

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    function getStockList()
    {
        $stmt = $this->pdo->query("SELECT * FROM stock_lists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}