<?php
require_once "Database/Database.php";

class SalesModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getTopProducts($limit = 6)
    {
        try {
            $query = "
                SELECT 
                    p.name AS item,
                    p.image AS image,
                    SUM(si.quantity) AS quantity,
                    SUM(p.price * si.quantity) AS total_price,
                    'Completed' AS status
                FROM 
                    sales s
                JOIN 
                    sale_items si ON s.sale_id = si.sale_id
                JOIN 
                    products p ON si.product_id = p.product_id
                GROUP BY 
                    p.product_id,
                    p.name,
                    p.image
                ORDER BY 
                    SUM(si.quantity) DESC
                LIMIT " . (int)$limit;
            
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching top products: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalRevenue()
    {
        try {
            $sql = "SELECT SUM(total_price) AS total_revenue FROM sales";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_revenue'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error fetching total revenue: " . $e->getMessage());
            return 0;
        }
    }

    public function getTotalExpenses()
    {
        try {
            $sql = "SELECT SUM(total_price) AS total_expenses FROM purchases";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_expenses'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error fetching total expenses: " . $e->getMessage());
            return 0;
        }
    }

    public function __destruct() {
        $this->db = null;
    }
}