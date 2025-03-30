<?php
class CategoriesModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    /**
     * Get all categories
     * @return array List of all categories
     */
    public function getCategories() {
        try {
            $query = "SELECT * FROM categories";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a category by its ID
     * @param int $id The ID of the category
     * @return array|null Category data
     */
    public function getCategoryById($id) {
        try {
            $query = "SELECT * FROM categories WHERE Category_id = :Category_id";
            $stmt = $this->db->query($query, [':Category_id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Create a new category
     * @param string $name The name of the category
     * @return bool Whether the category was created successfully
     */
    public function createCategory($name) {
        try {
            $query = "INSERT INTO categories (name) VALUES (:name)";
            return $this->db->query($query, [':name' => $name]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing category
     * @param int $id The ID of the category
     * @param string $name The new name of the category
     * @return bool Whether the category was updated successfully
     */
    public function updateCategory($id, $name) {
        try {
            $query = "UPDATE categories SET name = :name WHERE Category_id = :Category_id";
            return $this->db->query($query, [':name' => $name, ':Category_id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete a category
     * @param int $id The ID of the category
     * @return bool Whether the category was deleted successfully
     */
    public function deleteCategory($id) {
        try {
            $query = "DELETE FROM categories WHERE Category_id = :Category_id";
            return $this->db->query($query, [':Category_id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
