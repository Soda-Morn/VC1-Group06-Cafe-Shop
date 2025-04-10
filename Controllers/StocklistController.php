<?php
require_once "Models/StockListModel.php";

class StocklistController extends BaseController
{
    private $stocklist;

    public function __construct()
    {
        $this->stocklist = new StockListModel();
    }

    public function stocklist()
    {
        $stocklist = $this->stocklist->getStockList();
        $this->view('inventory/stocklist', ['stocklist' => $stocklist]);
    }

    public function edit($stock_list_id)
    {
        $stock = $this->stocklist->getStockById($stock_list_id);
        if (!$stock) {
            header("Location: /stocklist?error=Stock item not found");
            exit;
        }
        $this->view('inventory/edit_stocklist', ['stock' => $stock]);
    }

    public function update($stock_list_id)
    {
        $stock = $this->stocklist->getStockById($stock_list_id);
        if (!$stock) {
            header("Location: /stocklist?error=Stock item not found");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newQuantity = (int)($_POST['quantity'] ?? 0);

            // Check if the new quantity is greater than the current quantity
            if ($newQuantity > $stock['quantity']) {
                // Pass a flag for quantity error instead of the error message
                $this->view('inventory/edit_stocklist', [
                    'stock' => $stock,
                    'quantityError' => true // Changed from 'error' to 'quantityError'
                ]);
                return;
            }

            $status = $newQuantity == 0 ? 'Out of Stock' : ($newQuantity <= 3 ? 'Low Stock' : 'In Stock');

            // Update only quantity and status, preserving other fields
            $success = $this->stocklist->editStock(
                $stock_list_id,
                $newQuantity,
                $status,
                $stock['date'], // Preserve existing date
                $stock['product_name'], // Preserve existing product name
                $stock['product_image'] // Preserve existing image
            );

            if ($success) {
                header("Location: /stocklist?success=Quantity updated successfully");
                exit;
            } else {
                // If the update fails, show an error on the form
                $this->view('inventory/edit_stocklist', [
                    'stock' => $stock,
                    'error' => 'Failed to update quantity'
                ]);
                return;
            }
        }

        // If not a POST request, show the form
        $this->view('inventory/edit_stocklist', ['stock' => $stock]);
    }

    public function delete($stock_list_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $this->stocklist->deleteStock($stock_list_id);
            http_response_code($success ? 200 : 400);
            echo json_encode([
                'success' => $success,
                'message' => $success ? 'Stock item deleted successfully' : 'Failed to delete stock item'
            ]);
            exit;
        }
    }

    public function viewDetails($stock_list_id)
    {
        $stock = $this->stocklist->getStockById($stock_list_id);
        if (!$stock) {
            header("Location: /stocklist?error=Stock item not found");
            exit;
        }
        $this->view('inventory/view_stocklist', ['stock' => $stock]);
    }
} 