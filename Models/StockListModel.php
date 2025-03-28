<?php
require_once 'Database/Database.php';

class StockListModel {

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }
// Fetch all stock lists
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

    //update stock list
    function updateStockList($stock_list_id, $quantity, $status, $date)
{
    $stmt = $this->pdo->prepare("UPDATE stock_lists 
        SET quantity = :quantity, status = :status, date = :date 
        WHERE stock_list_id = :stock_list_id");

    $stmt->execute([
        ':stock_list_id' => $stock_list_id,
        ':quantity' => $quantity,
        ':status' => $status,
        ':date' => $date
    ]);

    return $stmt->rowCount(); // Returns the number of affected rows
}

    
    // DELETE FUNCTION
    public function deleteStocklist($stock_list_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM stock_lists WHERE stock_list_id = :stock_list_id");
        $stmt->execute([':stock_list_id' => $stock_list_id]);

        return $stmt->rowCount(); // Returns the number of affected rows
    }
    // {
    //     $stmt = $this->pdo->prepare("DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id");
    //     $stmt->execute([':purchase_item_id' => $purchaseItemId]);
    
    //     return $stmt->rowCount();
    // }
    
    

//delete stock list
// function deletestocklist($purchaseItemId)
// {
//     $stmt = $this->pdo->query("DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id");
//     $stmt->execute([':purchase_item_id' => $purchaseItemId]);

//     return $stmt->rowCount(); 
// }
    
}