<?php
class Database
{
    private $db;

    public function __construct()
    {
        $host = "maglev.proxy.rlwy.net";
        $dbname = "railway";
        $username = "root";
        $password = "llwRSjTkpowntofUGcLqEzHQOgOvCLCW";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
