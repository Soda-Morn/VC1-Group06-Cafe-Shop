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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = (int)($_POST['quantity'] ?? 0);
            $product_name = $_POST['product_name'] ?? '';
            $date = $_POST['date'] ?? date('Y-m-d');
            $status = $quantity == 0 ? 'Out of Stock' : ($quantity <= 3 ? 'Low Stock' : 'In Stock');

            // Handle file upload
            $product_image = null;
            if (!empty($_FILES['product_image']['name'])) {
                $upload_dir = 'uploads/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $product_image = $upload_dir . basename($_FILES['product_image']['name']);
                move_uploaded_file($_FILES['product_image']['tmp_name'], $product_image);
            }

            $success = $this->stocklist->editStock(
                $stock_list_id,
                $quantity,
                $status,
                $date,
                $product_name,
                $product_image
            );

            header("Location: /stocklist" . ($success ? "?success=Stock updated successfully" : "?error=Failed to update stock"));
            exit;
        }
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
}
