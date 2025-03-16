<?php
require_once 'Models/PurchaseItemAddControlerModel.php';
require_once 'BaseController.php';
class PurchaseItemAddController extends BaseController
{
    private $model;

    function __construct()
    {
        $this->model = new PurchaseItemAddControlerModel();
    }

    function index()
    {
        $items = $this->model->getPurchaseItems();
        $this->view('/inventory/purchase_item_add', ['items' => $items]);
    }

    function create()
    {
      echo "creat";
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capture the POST data from the form
            $purchase_id = $_POST['purchase_id'] ?? '';
            $product_id = $_POST['product_id'] ?? '';
            $quantity = $_POST['quantity'] ?? '';

            // Handling Image Upload
            $image_url = null;
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true); // Ensure upload directory exists
                }
                $image_name = time() . "_" . basename($_FILES['image']['name']);
                $target_file = $target_dir . $image_name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image_url = $target_file;
                }
            }

            // Insert Data
            $data = [
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'image' => $image_url
            ];

            $this->model->createPurchaseItem($data); // Pass data to model for DB insertion
            $this->redirect('/purchase_item_add');
        }
    }

    function show($item_ID)
    {
        $item = $this->model->getPurchaseItem($item_ID);
        $this->view('/inventory/show', ['item' => $item]);
    }
}


