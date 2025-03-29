<?php
require_once 'Database/Database.php';

class StockListModel {
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getStockList()
    {
        $sql = "SELECT 
            sl.stock_list_id,
            sl.quantity,
            sl.status,
            sl.date,
            p.product_name,
            p.product_image
        FROM 
            stock_lists sl
        LEFT JOIN 
            purchase_items p ON sl.purchase_item_id = p.purchase_item_id";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStockById($stock_list_id)
    {
        $sql = "SELECT 
            sl.stock_list_id,
            sl.quantity,
            sl.status,
            sl.date,
            p.product_name,
            p.product_image
        FROM 
            stock_lists sl
        LEFT JOIN 
            purchase_items p ON sl.purchase_item_id = p.purchase_item_id
        WHERE sl.stock_list_id = :stock_list_id";
        
        $stmt = $this->pdo->query($sql, [':stock_list_id' => $stock_list_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editStock($stock_list_id, $quantity, $status, $date, $product_name, $product_image = null) {
        try {
            $sql_purchase = "UPDATE purchase_items pi
                            INNER JOIN stock_lists sl ON sl.purchase_item_id = pi.purchase_item_id
                            SET pi.product_name = :product_name";
            
            $params_purchase = [':product_name' => $product_name];
            
            if ($product_image) {
                $sql_purchase .= ", pi.product_image = :product_image";
                $params_purchase[':product_image'] = $product_image;
            }
            
            $sql_purchase .= " WHERE sl.stock_list_id = :stock_list_id";
            $params_purchase[':stock_list_id'] = $stock_list_id;
            
            $this->pdo->query($sql_purchase, $params_purchase);

            $sql_stock = "UPDATE stock_lists 
                         SET quantity = :quantity, 
                             status = :status, 
                             date = :date 
                         WHERE stock_list_id = :stock_list_id";
            
            $params_stock = [
                ':quantity' => $quantity,
                ':status' => $status,
                ':date' => $date,
                ':stock_list_id' => $stock_list_id
            ];
            
            $stmt = $this->pdo->query($sql_stock, $params_stock);
            return $stmt !== false;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteStock($stock_list_id) {
        try {
            $sql = "DELETE FROM stock_lists WHERE stock_list_id = :stock_list_id";
            $params = [':stock_list_id' => $stock_list_id];
            
            $stmt = $this->pdo->query($sql, $params);
            return $stmt !== false;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}