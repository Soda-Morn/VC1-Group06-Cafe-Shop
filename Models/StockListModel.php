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
        $stmt = $this->pdo->query("SELECT 
            sl.stock_list_id,
            sl.quantity,
            sl.status,
            sl.date,
            p.product_name,
            p.product_image
        FROM 
            stock_lists sl
        LEFT JOIN 
            purchase_items p ON sl.purchase_item_id = p.purchase_item_id;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}