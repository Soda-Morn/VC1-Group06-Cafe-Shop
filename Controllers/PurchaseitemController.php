<?php
require_once 'Models/PurchaseItemModel.php';
require_once 'BaseController.php';

class PurchaseItemController extends BaseController
{
    private $model;

    function __construct()
    {
        $this->model = new PurchaseItemModel();
        session_start(); // Start the session to access $_SESSION['cart']
    }

    /**
     * Display the purchase_item_add page with a list of products
     */
    function index()
    {
        $products = $this->model->getPurchases();
        $this->view('/inventory/purchase_item_add', ['products' => $products]);
    }

    /**
     * Handle adding a product to the cart (appends to existing cart)
     */
    function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the product details from the form submission
            $itemId = $_POST['purchase_item_id'] ?? null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($itemId) {
                // Fetch the product details using the model
                $purchaseItem = $this->model->getPurchase($itemId);

                if ($purchaseItem) {
                    // Prepare the item for the cart
                    $purchaseItem['quantity'] = $quantity;

                    // Initialize the cart if it doesn't exist
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    // Check if the item already exists in the cart
                    $existingIndex = array_search($itemId, array_column($_SESSION['cart'], 'purchase_item_id'));

                    if ($existingIndex !== false) {
                        // Update quantity if item already exists
                        $_SESSION['cart'][$existingIndex]['quantity'] = $quantity;
                    } else {
                        // Append the new item to the cart (do not clear)
                        $_SESSION['cart'][] = $purchaseItem;
                    }
                } else {
                    error_log("Item not found for purchase_item_id: " . $itemId);
                }
            } else {
                error_log("No purchase_item_id provided in POST data");
            }

            // Redirect to the checkout page
            $this->redirect('/restock_checkout');
        } else {
            // Redirect back to the purchase_item_add page if not a POST request
            $this->redirect('/purchase_item_add');
        }
    }

    /**
     * Display the form to create a new purchase item
     */
    function create()
    {
        $categories = $this->model->getCategories();
        $units = $this->model->getUnits(); // Fetch units from the model
        $this->view('/inventory/create', ['categories' => $categories, 'units' => $units]); // Pass units to the view
    }

    /**
     * Store a new purchase item
     */
    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $store_unit = $_POST['store_unit'] ?? 1; // Default to unit_id 1 (e.g., "packet")

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
                'store_unit' => $store_unit,
            ];

            $this->model->createPurchase($data);
            $this->redirect('/purchase_item_add');
        } else {
            // If the request method is not POST, redirect back to the create form
            $this->redirect('/purchase_item_add/create');
        }
    }

    /**
     * Display the form to edit a purchase item
     */
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

    /**
     * Update a purchase item
     */
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

    /**
     * Delete a purchase item
     */
    function destroy($purchase_item_id)
    {
        $this->model->deletePurchase($purchase_item_id);
        $this->redirect('/purchase_item_add');
    }
}