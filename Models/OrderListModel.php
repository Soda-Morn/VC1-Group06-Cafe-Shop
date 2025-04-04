<?php
require_once __DIR__ . '/../Database/Database.php';

class OrderListModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getOrderList() {
        try {
            $query = "
                SELECT 
                    s.sale_id AS id,
                    p.name AS item,
                    p.price AS original_price,
                    si.quantity AS quantity,
                    (p.price * si.quantity) AS total_price,
                    p.image AS image,
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
            $stmt = $this->db->query($query);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $orders;
        } catch (PDOException $e) {
            error_log("Error fetching order list: " . $e->getMessage());
            return [];
        }
    }

    // Updated method to fetch sale_date as a placeholder for DOB
    public function getCustomerDOBs() {
        try {
            $query = "
                SELECT 
                    s.sale_id,
                    s.sale_date AS date_of_birth  -- Using sale_date as a placeholder for DOB
                FROM 
                    sales s
            ";
            $stmt = $this->db->query($query);
            $dobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Return an associative array with sale_id as the key and sale_date as the value
            $dobArray = [];
            foreach ($dobs as $dob) {
                $dobArray[$dob['sale_id']] = $dob['date_of_birth'];
            }
            return $dobArray;
        } catch (PDOException $e) {
            error_log("Error fetching sale dates: " . $e->getMessage());
            return [];
        }
    }

    public function __destruct() {
        $this->db = null;
    }
}