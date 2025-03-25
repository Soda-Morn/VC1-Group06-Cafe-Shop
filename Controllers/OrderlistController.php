<?php
require_once 'Models/OrderListModel.php';

class OrderlistController extends BaseController
{
    private $OrderListModel;

    public function __construct() {
        $this->OrderListModel = new OrderListModel();
    }

    public function index() {
        // Fetch the orders
        $orders = $this->OrderListModel->getorderList();
        
        // Prepare data for the view
        $data = [
            'orders' => $orders
        ];
        
        // Load the view with the data
        $this->view('orders/order_list', $data);
    }
}