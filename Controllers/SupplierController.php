<?php

class SupplierController extends BaseController {
    public function suppliers() {
        $this->view('suppliers/list');
    }
}