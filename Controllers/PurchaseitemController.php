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
        $this->view('/inventory/create');
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
                    mkdir($target_dir, 0755, true);
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
            $this->redirect('/purchase_item_add');
        }
    }

    // Edit item form
    function edit($purchase_item_id)
    {
        $product = $this->model->getPurchase($purchase_item_id);
        if ($product) {
            $this->view('/inventory/edit', ['product' => $product]);
        } else {
            $this->redirect('/purchase_item_add');
        }
    }

    // Update item
    function update($purchase_item_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';

            // Handling Image Upload
            $image_url = $_POST['existing_image'] ?? null;
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $image_name = time() . "_" . basename($_FILES['image']['name']);
                $target_file = $target_dir . $image_name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image_url = $target_file;
                }
            }

            // Update Data
            $data = [
                'product_name' => $product_name,
                'price' => $price,
                'product_image' => $image_url,
            ];

            $this->model->updatePurchase($purchase_item_id, $data);
            $this->redirect('/purchase_item_add');
        }
    }

    // Destroy a specific purchase item by ID
    function destroy($purchase_item_id)
    {
        $this->model->deletePurchase($purchase_item_id);
        $this->redirect('/purchase_item_add');
    }

}
