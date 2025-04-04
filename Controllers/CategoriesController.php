<?php
require_once "Models/CategoriesModel.php";
require_once 'BaseController.php';

class CategoriesController extends BaseController {
    private $categories;

    public function __construct() {
        $this->categories = new CategoriesModel();
    }

    /**
     * List all categories
     */
    public function index() {
        $categories = $this->categories->getCategories();
        $this->view("Categories/Categories", ['categories' => $categories]);
    }

    /**
     * Show the category creation form
     */
    public function create() {
        $this->view("Categories/create");
    }

    /**
     * Store a new category
     */
    public function store() {
        $name = htmlspecialchars(trim($_POST['name']));

        if (empty($name)) {
            $_SESSION['error'] = "Category name cannot be empty.";
            header("Location: /Categories/create");
            exit();
        }

        $success = $this->categories->createCategory($name);

        $_SESSION[$success ? 'success' : 'error'] = $success 
            ? "Category created successfully!" 
            : "Failed to create category.";

        header("Location: /Categories");
        exit();
    }

    /**
     * Show the edit form for a category
     */
    public function edit($id) {
        $category = $this->categories->getCategoryById($id);

        if (!$category) {
            $_SESSION['error'] = "Category not found.";
            header("Location: /Categories");
            exit();
        }

        $this->view("Categories/edit", ['category' => $category]);
    }

    /**
     * Update an existing category
     */
    public function update($id) {
        $name = htmlspecialchars(trim($_POST['name']));

        if (empty($name)) {
            $_SESSION['error'] = "Category name cannot be empty.";
            header("Location: /Categories/edit/$id");
            exit();
        }

        $success = $this->categories->updateCategory($id, $name);

        $_SESSION[$success ? 'success' : 'error'] = $success 
            ? "Category updated successfully!" 
            : "Failed to update category.";

        header("Location: /Categories");
        exit();
    }

    /**
     * Delete a category
     */
    public function delete($id) {
        // Optional: Confirm if the user is sure about deleting the category
        $category = $this->categories->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Category not found.";
            header("Location: /Categories");
            exit();
        }

        // Now proceed to delete the category
        $success = $this->categories->deleteCategory($id);

        $_SESSION[$success ? 'success' : 'error'] = $success 
            ? "Category deleted successfully!" 
            : "Failed to delete category.";

        header("Location: /Categories");
        exit();
    }

    /**
     * Destroy a category (Alternative deletion method, might be redundant)
     */
    public function destroy($id) {
        $success = $this->categories->deleteCategory($id);

        $_SESSION[$success ? 'success' : 'error'] = $success 
            ? "Category deleted successfully!" 
            : "Failed to delete category.";

        header("Location: /Categories");
        exit();
    }
}
?>
