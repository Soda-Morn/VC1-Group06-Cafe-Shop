<?php

class ProductDetailController extends BaseController {
    public function index() {
        $this->view('products/product_detail');
    }
}