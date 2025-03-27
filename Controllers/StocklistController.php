<?php
require_once "Models/StockListModel.php";

class StocklistController extends BaseController {
    private $stocklist;

    public function __construct()
    {
        ob_start();
        $this->stocklist = new StockListModel();
    }

    public function stocklist() {
        $stocklist = $this->stocklist->getStockList();
        $this->view('inventory/stocklist', ['stocklist' => $stocklist]);
        ob_end_flush();
    }

    public function edit($stock_list_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update($stock_list_id);
        } else {
            // Fetch the stock item
            $stock = $this->stocklist->getStockById($stock_list_id);
            
            // Debugging: Check if stock item is retrieved
            if (!$stock) {
                error_log("Stock item not found for ID: $stock_list_id");
                http_response_code(404);
                echo "Stock item not found.";
                ob_end_flush();
                exit;
            }

            // Debugging: Log successful retrieval
            error_log("Stock item retrieved: " . json_encode($stock));

            // Render the edit view
            $this->view('inventory/edit_stock', ['stock' => $stock]);
        }
        ob_end_flush();
    }

    public function update($stock_list_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = $_POST['quantity'] ?? 0;
            $status = $_POST['status'] ?? 'Out of Stock';
            $date = $_POST['date'] ?? date('Y-m-d');
            $product_name = $_POST['product_name'] ?? '';

            $product_image = null;
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['product_image']['name']);
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetPath)) {
                    $product_image = $targetPath;
                }
            }
            
            $result = $this->stocklist->editStock($stock_list_id, $quantity, $status, $date, $product_name, $product_image);
            
            if ($result === true) {
                $this->redirectToStockList();
            } else {
                http_response_code(500);
                echo "Error updating stock: " . $result;
                ob_end_flush();
                exit;
            }
        } else {
            $this->redirectToStockList();
        }
    }

    public function delete($stock_list_id) {
        $result = $this->stocklist->deleteStock($stock_list_id);
        
        if ($result === true) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                ob_end_flush();
                exit;
            }
            $this->redirectToStockList();
        } else {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => $result]);
            ob_end_flush();
            exit;
        }
    }

    private function redirectToStockList() {
        http_response_code(302);
        header("Location: /stocklist");
        ob_end_flush();
        exit;
    }
}