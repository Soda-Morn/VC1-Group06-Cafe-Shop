<?php
require_once "Models/StockListModel.php";

class StocklistController extends BaseController {

    private $stocklist;

    public function __construct()
    {
        $this->stocklist = new StockListModel();
    }

    public function stocklist() {
        $stocklist = $this->stocklist->getStockList();
        $this->view('inventory/stocklist', ['stocklist' => $stocklist]);
    }

    
    public function edit($purchase_item_id)
{
    // Fetch specific stock item by ID
    $stocklist = $this->stocklist->getStockList($purchase_item_id);
    
    if (!$stocklist) {
        die("Stock item not found.");
    }

    // Load the edit form with the stocklist data
    $this->view('inventory/edit_stocklist', ['stocklist' => $stocklist]);
}

public function update($purchase_item_id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stockListId = $_POST['stock_list_id'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $productName = $_POST['product_name'];
        $productImage = $_POST['product_image'];

        // Call the update function from the model
        $updatedRows = $this->stocklist->updateStockAndProduct($stockListId, $quantity, $status, $date, $productName, $productImage);

        if ($updatedRows > 0) {
            // Redirect with success message
            header("Location: /inventory?success=Stock updated successfully");
            exit();
        } else {
            // Redirect with error message
            header("Location: /inventory/edit/$stockListId?error=Failed to update stock");
            exit();
        }
    }
}

    
    // DELETE FUNCTION
    public function delete($purchaseItemId)
    {
        $this->stocklist->deleteStocklist($purchaseItemId);
        $this->redirect('/stocklist');
    }
    
    
     
}