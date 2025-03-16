<?php
require_once 'Database/Database.php';

class PurchaseItemAddControlerModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    function getPurchaseItems()
    {
        $stmt = $this->pdo->query("SELECT * FROM purchase_items");
        return $stmt->fetchAll();
    }

    function createPurchaseItem($data)
    {
        $stmt = $this->pdo->query("INSERT INTO purchase_items (name, category, quality, image, description) VALUES (:name, :category, :quality, :image, :description)", [
            'name' => $data['name'],
            'category' => $data['category'],
            'quality' => $data['quality'],
            'image' => $data['image'] ?? null,
            'description' => $data['description'],
        ]);
    }

    function getPurchaseItem($item_ID)
    {
        $stmt = $this->pdo->query("SELECT item_ID, category, quality, description, price, image FROM purchase_items WHERE item_ID = :item_ID", ['item_ID' => $item_ID]);
        return $stmt->fetch();
    }
}
