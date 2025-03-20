<?php
require_once "Models/StockListModel.php";
class StocklistController extends BaseController {

    private $stocklist;

    public function __construct()
    {
        $this->stocklist= new StockListModel();
    }
    public function stocklist() {
        
        $stocklist= $this->stocklist->getStockList();
        $this->view('inventory/stocklist',['stocklist' => $stocklist]);
    }

    function edit($stock_list_id)
    {
        $stock = $this->model->getStockItem($stock_list_id);
            $this->view('/inventory/edit', ['stock' => $stock]);

        // if ($stock) {
        // } else {
        //     $this->redirect('/stock_list');
        // }
    }

    // Update function - Save changes to the item
    // function update($stock_list_id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $product_name = $_POST['product_name'] ?? '';
    //         $quantity = $_POST['quantity'] ?? 0;
    //         $status = $_POST['status'] ?? '';
    //         $date = $_POST['date'] ?? '';

    //         // Handling Image Upload
    //         $image_url = $_POST['existing_image'] ?? null;
    //         if (!empty($_FILES['product_image']['name']) && $_FILES['product_image']['error'] == 0) {
    //             $target_dir = "uploads/";
    //             if (!is_dir($target_dir)) {
    //                 mkdir($target_dir, 0755, true);
    //             }
    //             $image_name = time() . "_" . basename($_FILES['product_image']['name']);
    //             $target_file = $target_dir . $image_name;

    //             if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
    //                 $image_url = $target_file;
    //             }
    //         }

    //         // Update Data Array
    //         $data = [
    //             'product_name' => $product_name,
    //             'quantity' => $quantity,
    //             'status' => $status,
    //             'date' => $date,
    //             'product_image' => $image_url,
    //         ];

    //         // Call the Model to Update
    //         $this->model->updateStockItem($stock_list_id, $data);

    //         // Redirect After Update
    //         $this->redirect('/stock_list');
    //     }
    // }
}