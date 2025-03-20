<?php
require_once "Models/SupplierModel.php";

class SupplierController extends BaseController {
    private $suppliers;

    public function __construct() {
        $this->suppliers = new SupplierModel();
    }

    /**
     * List all suppliers
     */
    public function index() {
        // Fetch all suppliers from the model
        $suppliers = $this->suppliers->getSuppliers();
        // Pass suppliers data to the view
        $this->view("suppliers/list", ['suppliers' => $suppliers]);
    }

    /**
     * Show the form to create a new supplier
     */
    public function create() {
        // Display the supplier creation form
        $this->view("suppliers/create");
    }

    /**
     * Store a new supplier
     */
    public function store() {
        // Get supplier data from the POST request
        $name = htmlspecialchars($_POST['name']);
        $phone_number = htmlspecialchars($_POST['phone_number']);
        $address = htmlspecialchars($_POST['address']);
        
        // Call the model to store the supplier data
        $this->suppliers->createSupplier($name, $phone_number, $address);
        
        // Redirect to the supplier list
        header("Location: /suppliers");
    }

    /**
     * Show the form to edit an existing supplier
     * @param int $id The ID of the supplier to edit
     */
    public function edit($id) {
        // Get the supplier data by ID
        $supplier = $this->suppliers->getSupplierById($id);
        
        // Pass supplier data to the edit form view
        $this->view("suppliers/edit", ['supplier' => $supplier]);
    }

    /**
     * Update an existing supplier
     * @param int $id The ID of the supplier to update
     */
    public function update($id) {
        // Get the updated supplier data from the POST request
        $name = htmlspecialchars($_POST['name']);
        $phone_number = htmlspecialchars($_POST['phone_number']);
        $address = htmlspecialchars($_POST['address']);
        
        // Call the model to update the supplier data
        $this->suppliers->updateSupplier($id, $name, $phone_number, $address);
        
        // Redirect to the supplier list
        header("Location: /suppliers");
    }

    /**
     * Delete a supplier
     * @param int $id The ID of the supplier to delete
     */
    public function delete($id) {
        // Call the model to delete the supplier by ID
        $this->suppliers->deleteSupplier($id);
        
        // Redirect to the supplier list
        header("Location: /suppliers");
    }
}
?>
