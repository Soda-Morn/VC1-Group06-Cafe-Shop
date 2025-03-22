<?php
require_once 'Models/PurchaseItemModel.php';
require_once 'BaseController.php';

class PurchaseItemController extends BaseController
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
        $categories = $this->model->getCategories();
        $this->view('/inventory/create', ['categories' => $categories]);
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
                } else {
                    // Log or display an error if the file upload fails
                    error_log("Failed to upload image: " . $_FILES['image']['error']);
                }
            }

            // Insert Data (excluding category_id)
            $data = [
                'product_name' => $product_name,
                'price' => $price,
                'product_image' => $image_url,
            ];

            $this->model->createPurchase($data);
            $this->redirect('/purchase_item_add');
        } else {
            // If the request method is not POST, redirect back to the create form
            $this->redirect('/purchase_item_add/create');
        }
    }

    // Edit item form
    function edit($purchase_item_id)
    {
        $product = $this->model->getPurchase($purchase_item_id);
        $categories = $this->model->getCategories();
        if ($product) {
            $this->view('/inventory/edit', ['product' => $product, 'categories' => $categories]);
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
                } else {
                    error_log("Failed to upload image: " . $_FILES['image']['error']);
                }
            }

            // Update Data (excluding category_id)
            $data = [
                'product_name' => $product_name,
                'price' => $price,
                'product_image' => $image_url,
            ];

            $this->model->updatePurchase($purchase_item_id, $data);
            $this->redirect('/purchase_item_add');
        } else {
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
?>