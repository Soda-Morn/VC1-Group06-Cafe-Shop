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
        // Set headers for JSON response
        header('Content-Type: application/json');

        try {
            // Validate the product ID
            if (!$product_ID || !is_numeric($product_ID)) {
                throw new Exception('Invalid product ID');
            }

            // Check if the product exists
            $product = $this->model->getProduct($product_ID);
            if (!$product) {
                throw new Exception('Product not found');
            }

            // Delete the product image if it exists
            if ($product['image'] && file_exists($product['image'])) {
                unlink($product['image']);
            }

            // Delete the product from the database
            $result = $this->model->deleteProduct($product_ID);
            if (!$result) {
                throw new Exception('Failed to delete product from database');
            }

            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'Product deleted successfully'
            ]);
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Error deleting product: " . $e->getMessage());

            // Return error response
            http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}