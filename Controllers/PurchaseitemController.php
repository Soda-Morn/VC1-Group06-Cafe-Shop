<?php
require_once 'Models/PurchaseItemModel.php';
require_once 'BaseController.php';


class PurchaseitemController extends BaseController
{
    private $model;

    function __construct()
    {
        $this->model = new PurchaseItemModel();
    }

    function index()
    {
        $products = $this->model->getPurchases();
        $this->view('/inventory/purchase_item_add', ['products' => $products]);
    }   
    function create()
    {
        $products = $this->model->getPurchases();
        $this->view('/inventory/create', ['products' => $products]);
    }
    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';

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
                'product_name' => $product_name,
                'price' => $price,
                'product_image' => $image_url,
            ];

            $this->model->createPurchase($data);
            $this->redirect('/purchase_item');
        }
    }
}