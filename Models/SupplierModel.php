<?php
require_once 'Database/Database.php';
class SupplierModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }

    function getSuppliers()
    {
        $stmt = $this->pdo->query("SELECT * FROM supplier");
        return $stmt->fetchAll();
    }

    function createSupplier($data)
    {
        $stmt = $this->pdo->query("INSERT INTO supplier (name, phone_number, address) VALUES (:name, :phone_number, :address)", [
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            
        ]);
    }

    function getSupplier($supplier_id)
    {
        $stmt = $this->pdo->query("SELECT supplier_id, name, phone_number, address FROM supplier WHERE supplier_id = :supplier_id", ['supplier_id' => $supplier_id]);
        return $stmt->fetch();
    }
}