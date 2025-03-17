<?php

class PurchaseItemAddControlerModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }
    

    // Get all products (purchase items)
    function getProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM purchase_items");
        return $stmt->fetchAll();
    }

    // Create a new product (purchase item)
    public function createProduct($data)
    {
        // Prepare the SQL query with placeholders
        $stmt = $this->pdo->query("INSERT INTO purchase_items (name, price, image, description) 
                                     VALUES (:name, :price, :image, :description)");
    
        // Execute the query with the actual data
        $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $data['image'] ?? null, // Handle case where no image is uploaded
            'description' => $data['description'],
        ]);
    }
    

    // Get a specific product by ID
    function getProduct($purchase_item_ID)
    {
        $stmt = $this->pdo->query("SELECT purchase_item_ID, description, price, image 
                                     FROM purchase_items WHERE purchase_item_ID = :purchase_item_ID");
        $stmt->execute(['purchase_item_ID' => $purchase_item_ID]);
        return $stmt->fetch();
    }
}
