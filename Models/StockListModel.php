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
    public function updateStocklist($purchaseItemId, $productName, $productImage)
    {
        $stmt = $this->pdo->prepare("UPDATE purchase_items 
                                     SET product_name = :product_name, 
                                         product_image = :product_image 
                                     WHERE purchase_item_id = :purchase_item_id");
    
        $stmt->execute([
            ':product_name' => $productName,
            ':product_image' => $productImage,
            ':purchase_item_id' => $purchaseItemId
        ]);
    
        return $stmt->rowCount();
    }
    
    // DELETE FUNCTION
    public function deleteStocklist($purchaseItemId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id");
        $stmt->execute([':purchase_item_id' => $purchaseItemId]);
    
        return $stmt->rowCount();
    }
    
    

//delete stock list
// function deletestocklist($purchaseItemId)
// {
//     $stmt = $this->pdo->query("DELETE FROM purchase_items WHERE purchase_item_id = :purchase_item_id");
//     $stmt->execute([':purchase_item_id' => $purchaseItemId]);

//     return $stmt->rowCount(); 
// }
    
}