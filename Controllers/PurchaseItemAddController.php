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

    // Index function to list products
    function index()
    {
        // Fetch products from the model
        $products = $this->model->getProducts();
        // Pass the products to the view
        $this->view('/inventory/purchase_item_add', ['purchase_items' => $products]);
    }   

 

    // Store function to add a new product
    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get POST data for name, price, and description
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

            // Prepare the data for insertion
            $data = [
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'image' => $image_url,
            ];

            // Store the new product in the database
            $this->model->createProduct($data);
            // Redirect to the purchase item add page after storing the product
            $this->redirect('/purchase_item_add');
        }
    }
}
