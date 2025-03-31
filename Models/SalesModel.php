<?php
require_once "Database/Database.php";

class SalesModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_price) AS total_revenue FROM sales";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_revenue'] ?? 0;
    }
    // Append this to the SalesModel.php file
    public function getTotalExpenses()
    {
        $sql = "SELECT SUM(total_price) AS total_expenses FROM purchases";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_expenses'] ?? 0;
    }
}
