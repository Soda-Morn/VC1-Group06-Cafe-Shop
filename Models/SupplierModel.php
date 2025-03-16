<?php

require_once 'Database/database.php';
class SupplierModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new Database("localhost", "cafe_shop_db", "root", "");
    }


    function getsupplier()
    {
        $supplier = $this->pdo->query("SELECT * FROM supplier ORDER BY supplier_id DESC");
        return $supplier->fetchAll();
    }
    function createsupplier($data)
    {
        $this->pdo->query("INSERT INTO supplier (name,phone_number,address) VALUES (:name, :phone_number​,:address)", [
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
        ]);
    }



    function getsuppliers($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM supplier WHERE id = :id", ['id' => $id]);
        return $stmt->fetch();
    }

    function updatesupplier($id, $data)
    {
        $this->pdo->query(
            "UPDATE supplier SET name = :name, profile = :profile WHERE id = :id",
            [
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                 'address' => $data['address'],
                 'id' => $id
            ]
        );
    }


    function deletesupplier($id)
    {
        $this->pdo->query("DELETE FROM supplier WHERE id = :id", ['id' => $id]);
    }
}
