<?php

class ProductListController extends BaseController {
    public function index() {
        $this->view('products/product_list');
    }
}