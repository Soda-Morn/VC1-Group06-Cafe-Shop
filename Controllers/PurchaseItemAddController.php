<?php

class PurchaseItemAddController extends BaseController {
    private $model;
    public function index() {
        $this->view('inventory/purchase_item_add');
    }

    public function show() {
   
        $this->view('form_order/order_now');
    }

    public function shows() {
   
        $this->view('form_order/preview_order');
    }
}