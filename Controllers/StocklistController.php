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

    
    
    public function edit($purchaseItemId)
    {
        // Fetch specific stock item by ID
        $stocklist = $this->stocklist->getStockList($purchaseItemId);
        
        // Load the edit form with the stocklist data
        $this->view('inventory/edit_stocklist', ['stocklist' => $stocklist]);
    }
    
    public function update($purchaseItemId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $productName = htmlspecialchars($_POST['product_name'] ?? '', ENT_QUOTES, 'UTF-8');
    
            // Handle file upload (if a new image is provided)
            $productImage = '';
            if (!empty($_FILES['product_image']['name'])) {
                $targetDir = "uploads/";
                $fileName = basename($_FILES["product_image"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
                // Allowed file formats
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
                        $productImage = $targetFilePath;
                    } else {
                        die("Error uploading file.");
                    }
                } else {
                    die("Invalid file format.");
                }
            } else {
                // Keep existing image if no new image is uploaded
                $currentStock = $this->stocklist->getStockList($purchaseItemId);
                $productImage = $currentStock['product_image'];
            }
    
            // Update database
            $this->stocklist->updateStocklist($purchaseItemId, $productName, $productImage);
            $this->redirect('/stocklist');
        }
    }
    
    // DELETE FUNCTION
    public function delete($purchaseItemId)
    {
        $this->stocklist->deleteStocklist($purchaseItemId);
        $this->redirect('/stocklist');
    }
    
    
     
}