<?php
require_once 'Models/OrderListModel.php';

class OrderListController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new CardModel();
        session_start();
    }

    public function index() {
        // Fetch all orders from the model (adjust this based on your actual database schema)
        $orders = $this->model->getAllOrders(); // You’ll need to implement this method in CardModel

        // Pass the orders to the view
        $this->view('/orders/order_list', [
            'orders' => $orders,
            'error' => $_GET['error'] ?? '',
            'success' => $_GET['success'] ?? ''
        ]);
    }
}