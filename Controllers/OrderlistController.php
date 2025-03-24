<?php

class OrderlistController extends BaseController
{
    private $orderListModel;

    public function __construct() {
        $this->orderListModel = new OrderListModel();
    }

    public function index() {
        $orders = $this->orderListModel->getOrderList();
        $data = [
            'orders' => $orders
        ];
        $this->view('orders/order_list', $data);
    }
}