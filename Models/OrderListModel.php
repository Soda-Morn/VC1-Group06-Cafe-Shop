<?php
require_once "Database/Database.php";

class OrderListModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getOrderList() {
        // SQL query to join sales, sale_items, and products tables
        $query = "
            SELECT 
                s.sale_id AS id,
                p.name AS item,
                p.price AS original_price,
                si.quantity AS quantity,
                (p.price * si.quantity) AS total_price,
                'Completed' AS status
            FROM 
                sales s
            JOIN 
                sale_items si ON s.sale_id = si.sale_id
            JOIN 
                products p ON si.product_id = p.product_id
            ORDER BY 
                s.sale_id ASC
        ";

        // Execute the query
        $stmt = $this->db->query($query);

        // Fetch all rows as an associative array
        $orders = $stmt->fetchAll();

        return $orders;
    }
}