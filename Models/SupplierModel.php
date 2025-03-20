<?php
class SupplierModel {
    private $db;

    public function __construct() {
        // Initialize the Database connection
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    /**
     * Get all suppliers
     * @return array List of all suppliers
     */
    public function getSuppliers() {
        try {
            $result = $this->db->query("SELECT * FROM suppliers");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error or handle it as needed
            return [];
        }
    }

    /**
     * Get a supplier by its ID
     * @param int $id The ID of the supplier
     * @return array Supplier data
     */
    public function getSupplierById($id) {
        try {
            $result = $this->db->query("SELECT * FROM suppliers WHERE id = :id", ['id' => $id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error
            return null;
        }
    }

    /**
     * Create a new supplier
     * @param string $name The name of the supplier
     * @param string $phone_number The phone number of the supplier
     * @param string $address The address of the supplier
     * @return bool Whether the supplier was created successfully
     */
    public function createSupplier($name, $phone_number, $address) {
        try {
            $result = $this->db->query("INSERT INTO suppliers (name, phone_number, address) VALUES (:name, :phone_number, :address)", [
                'name' => $name,
                'phone_number' => $phone_number,
                'address' => $address
            ]);
            return $result !== false;
        } catch (PDOException $e) {
            // Handle the error (could log it)
            return false;
        }
    }

    /**
     * Update an existing supplier
     * @param int $id The ID of the supplier
     * @param string $name The name of the supplier
     * @param string $phone_number The phone number of the supplier
     * @param string $address The address of the supplier
     * @return bool Whether the supplier was updated successfully
     */
    public function updateSupplier($id, $name, $phone_number, $address) {
        try {
            $result = $this->db->query("UPDATE suppliers SET name = :name, phone_number = :phone_number, address = :address WHERE id = :id", [
                'id' => $id,
                'name' => $name,
                'phone_number' => $phone_number,
                'address' => $address
            ]);
            return $result !== false;
        } catch (PDOException $e) {
            // Handle the error
            return false;
        }
    }

    /**
     * Delete a supplier
     * @param int $id The ID of the supplier
     * @return bool Whether the supplier was deleted successfully
     */
    public function deleteSupplier($id) {
        try {
            $result = $this->db->query("DELETE FROM suppliers WHERE id = :id", ['id' => $id]);
            return $result !== false;
        } catch (PDOException $e) {
            // Handle the error
            return false;
        }
    }

    /**
     * Get a supplier by their phone number
     * @param string $phone_number The phone number of the supplier
     * @return array Supplier data or null if not found
     */
    public function getSupplierByPhoneNumber($phone_number) {
        try {
            $result = $this->db->query("SELECT * FROM suppliers WHERE phone_number = :phone_number", ['phone_number' => $phone_number]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error
            return null;
        }
    }
}
?>
