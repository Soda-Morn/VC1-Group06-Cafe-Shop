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

    public function getTotalExpenses()
    {
        $sql = "SELECT SUM(total_price) AS total_expenses FROM purchases";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_expenses'] ?? 0;
    }

    // New method to fetch weekly revenue (by day of the week)
    public function getWeeklyRevenue()
    {
        $sql = "
            SELECT 
                DAYNAME(sale_date) AS day_label,
                SUM(total_price) AS total_revenue
            FROM sales
            GROUP BY DAYNAME(sale_date), DAYOFWEEK(sale_date)
            ORDER BY DAYOFWEEK(sale_date)
        ";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $labels = [];
        $data = [];
        foreach ($result as $row) {
            $labels[] = $row['day_label'];
            $data[] = $row['total_revenue'];
        }
        return ['labels' => $labels, 'data' => $data];
    }

    // New method to fetch monthly revenue
    public function getMonthlyRevenue()
    {
        $sql = "
            SELECT 
                DATE_FORMAT(sale_date, '%b') AS month_label,
                SUM(total_price) AS total_revenue
            FROM sales
            GROUP BY MONTH(sale_date), month_label
            ORDER BY MONTH(sale_date)
        ";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $labels = [];
        $data = [];
        foreach ($result as $row) {
            $labels[] = $row['month_label'];
            $data[] = $row['total_revenue'];
        }
        return ['labels' => $labels, 'data' => $data];
    }

    // New method to fetch yearly revenue
    public function getYearlyRevenue()
    {
        $sql = "
            SELECT 
                YEAR(sale_date) AS year_label,
                SUM(total_price) AS total_revenue
            FROM sales
            GROUP BY YEAR(sale_date)
            ORDER BY YEAR(sale_date)
        ";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $labels = [];
        $data = [];
        foreach ($result as $row) {
            $labels[] = $row['year_label'];
            $data[] = $row['total_revenue'];
        }
        return ['labels' => $labels, 'data' => $data];
    }
}