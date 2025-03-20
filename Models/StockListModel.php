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

//editestock

    public function editStock($stock_list_id, $quantity, $status, $date, $product_name, $product_image) {
           try {
               $stmt = $this->pdo->prepare("UPDATE stock_lists 
                   SET quantity = :quantity, status = :status, date = :date 
                   WHERE stock_list_id = :stock_list_id");

               $stmt->bindParam(':quantity', $quantity);
               $stmt->bindParam(':status', $status);
               $stmt->bindParam(':date', $date);
               $stmt->bindParam(':stock_list_id', $stock_list_id);
               $stmt->bindParam(':product_name', $product_name);
               $stmt->bindParam(':product_image', $product_image);

               return $stmt->execute(); // Returns true on success, false on failure
           } catch (PDOException $e) {
               return "Error: " . $e->getMessage();
           }
       }
    
}