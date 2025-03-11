<?php

class OrderlistController extends BaseController
{
    public function index()
    {
        $this->view('orders/order_list');
    }
}
