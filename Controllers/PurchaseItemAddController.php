<?php
require_once "Models/PurchaseItemAddModel.php";

class PurchaseItemAddController extends BaseController {
    private $products;

    public function __construct()
    {
        $this->products = new PurchaseItemAddModel();
    }

    public function index() {
        $purchaseItem = $this->products->getPurchaseItemAdd();
        
        // Pass the data correctly to the view
        $this->view('inventory/purchase_item_add', ['products' => $purchaseItem]);
    }



    public function show() {
   
        $this->view('form_order/order_now');
    }

    public function shows() {
   
        $this->view('form_order/preview_order');
    }
}