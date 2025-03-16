<?php
require_once 'BaseController.php';
require_once 'Models/SupplierModel.php';

class SupplierController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model = new SupplierModel;
    }

    function index()
    {
        $supplier = $this->model->getsupplier();
        $this->view('supplier/list', ['supplier' => $supplier]);
    }

    function create()
    {
        $supplier = $this->model->getsupplier();
        $this->view('supplier/create.php', ['supplier' => $supplier]);
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'qty' => $_POST['qty'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
            ];

            $this->model->createsupplier($data);
            $this->redirect('/supplier');
        }
    }




    function edit($id)
    {
        $supplier = $this->model->getsupplier($id);
        $supplier = $this->model->getsupplier();
        $this->view('supplier/edit.php', ['supplier' => $supplier, 'suppliers' => $supplier]);
    }


    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'qty' => $_POST['qty'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
            ];

            $this->model->updatesupplier($id, $data);
            $this->redirect('/supplier');
        }
    }

    function destroy($id)
    {
        $this->model->deletesupplier($id);
        $this->redirect('/supplier');
    }
}
