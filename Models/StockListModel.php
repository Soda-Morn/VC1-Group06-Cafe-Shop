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
    p.product_id AS ID,
    p.image AS Image,
    p.name AS Products,
    pi.product_name AS ProductName,
    sl.quantity AS Stock,
    sl.status AS STATUS,        -- Get the status from stock_lists
    sl.date AS `DATE ADDED`     -- Get the date from stock_lists
FROM 
    products p
LEFT JOIN 
    purchase_items pi ON p.product_id = pi.product_id
LEFT JOIN 
    stock_lists sl ON pi.purchase_item_id = sl.purchase_item_id
LIMIT 0, 25;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}