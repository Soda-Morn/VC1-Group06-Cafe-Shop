<?php
require_once 'Database/Database.php';

class OrdermenuModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    function getProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    function createProduct($data)
    {
        $stmt = $this->pdo->query("INSERT INTO products (name, price, image, description) VALUES (:name, :price, :image, :description)", [
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $data['image'] ?? null,
            'description' => $data['description'],
        ]);
    }

    function getProduct($product_ID)
    {
        $stmt = $this->pdo->query("SELECT product_ID, description, price, image FROM products WHERE product_ID = :product_ID", ['product_ID' => $product_ID]);
        return $stmt->fetch();
    }

    function deleteProduct($product_ID)
    {
        try {
            $stmt = $this->pdo->query(
                "DELETE FROM products WHERE product_ID = :product_ID", 
                ['product_ID' => $product_ID]
            );
            return $stmt->rowCount() > 0; // Return true if a row was deleted, false otherwise
        } catch (Exception $e) {
            error_log("Error deleting product: " . $e->getMessage());
            return false;
        }
    }
}