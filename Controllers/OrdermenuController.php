<?php
require_once 'Models/OrdermenuModel.php';
require_once 'BaseController.php';

class OrdermenuController extends BaseController
{
    private $model;

    function __construct()
    {
        $this->model = new OrdermenuModel();
    }

    function index()
    {
        $products = $this->model->getProducts();
        $this->view('/orders/order_menu', ['products' => $products]);
    }   

    function create()
    {
        $products = $this->model->getProducts();
        $this->view('/orders/create', ['products' => $products]);
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $description = $_POST['description'] ?? '';

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
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'image' => $image_url,
            ];

            $this->model->createProduct($data);
            $this->redirect('/order_menu');
        }
    }
    function destroy($product_ID)
    {
        $product = $this->model->getProduct($product_ID);
        if ($product && $product['image'] && file_exists($product['image'])) {
            unlink($product['image']);
        }
        $this->model->deleteProduct($product_ID);
        $this->redirect('/order_menu');
    }
}
