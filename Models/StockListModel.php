<?php
require_once 'Database/Database.php';

class StockListModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getStockList() {
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

    public function getStockById($stock_list_id) {
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
            // First, update stock_lists (always required)
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
            
            $stmt_stock = $this->pdo->query($sql_stock, $params_stock);

            // Then, update purchase_items if it exists (optional due to LEFT JOIN)
            $sql_purchase = "UPDATE purchase_items pi
                            INNER JOIN stock_lists sl ON sl.purchase_item_id = pi.purchase_item_id
                            SET pi.product_name = :product_name";
            
            $params_purchase = [
                ':product_name' => $product_name,
                ':stock_list_id' => $stock_list_id
            ];
            
            if ($product_image !== null) {
                $sql_purchase .= ", pi.product_image = :product_image";
                $params_purchase[':product_image'] = $product_image;
            }
            
            $sql_purchase .= " WHERE sl.stock_list_id = :stock_list_id";
            $stmt_purchase = $this->pdo->query($sql_purchase, $params_purchase);

            // Return true if stock_lists update succeeded (purchase_items is optional)
            return $stmt_stock->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Stock update failed: " . $e->getMessage());
            return false;
        }
    }

    public function deleteStock($stock_list_id) {
        try {
            // Step 1: Get the purchase_item_id for the stock_lists record
            $sql_get_purchase_item = "SELECT purchase_item_id FROM stock_lists WHERE stock_list_id = :stock_list_id";
            $stmt_get_purchase_item = $this->pdo->query($sql_get_purchase_item, [':stock_list_id' => $stock_list_id]);
            $purchase_item_id = $stmt_get_purchase_item->fetchColumn();
    
            if ($purchase_item_id === false) {
                error_log("Stock record not found for stock_list_id: " . $stock_list_id);
                return false; // Stock record not found
            }
    
            // Step 2: Set purchase_item_id to NULL to avoid cascading delete
            $sql_update_stock = "UPDATE stock_lists SET purchase_item_id = NULL WHERE stock_list_id = :stock_list_id";
            $stmt_update_stock = $this->pdo->query($sql_update_stock, [':stock_list_id' => $stock_list_id]);
    
            if ($stmt_update_stock->rowCount() === 0) {
                error_log("Failed to update stock_lists record for stock_list_id: " . $stock_list_id);
                return false; // Failed to update the record
            }
    
            // Step 3: Delete the stock_lists record
            $sql_delete_stock = "DELETE FROM stock_lists WHERE stock_list_id = :stock_list_id";
            $stmt_delete_stock = $this->pdo->query($sql_delete_stock, [':stock_list_id' => $stock_list_id]);
            $deleted = $stmt_delete_stock->rowCount() > 0;
    
            if (!$deleted) {
                error_log("Failed to delete stock_lists record for stock_list_id: " . $stock_list_id);
                return false; // Deletion failed
            }
    
            // Step 4: Check if there are other stock_lists records with the same purchase_item_id
            $sql_check_others = "SELECT COUNT(*) FROM stock_lists WHERE purchase_item_id = :purchase_item_id";
            $stmt_check_others = $this->pdo->query($sql_check_others, [':purchase_item_id' => $purchase_item_id]);
            $other_count = $stmt_check_others->fetchColumn();
    
            // Step 5: If no other stock_lists records reference this purchase_item_id, delete it
            if ($other_count == 0) {
                $sql_delete_purchase = "DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id";
                $stmt_delete_purchase = $this->pdo->query($sql_delete_purchase, [':purchase_item_id' => $purchase_item_id]);
                if ($stmt_delete_purchase->rowCount() > 0) {
                    error_log("Deleted purchase_items record for purchase_item_id: " . $purchase_item_id);
                }
            }
    
            return true;
        } catch (PDOException $e) {
            error_log("Stock delete failed: " . $e->getMessage());
            return false;
        }
    }
}