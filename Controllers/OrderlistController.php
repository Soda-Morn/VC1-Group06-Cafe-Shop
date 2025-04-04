<?php
require_once 'Models/OrderListModel.php';

class OrderListController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new OrderListModel();
        session_start();
    }

    public function index() {
        // Fetch all orders from the model (adjust this based on your actual database schema)
        $orders = $this->model->getOrderList(); // This remains unchanged

        // Fetch DOBs and merge with orders
        $ordersWithDOB = $this->mergeDOBWithOrders($orders);

        // Pass the orders to the view
        $this->view('/orders/order_list', [
            'orders' => $ordersWithDOB,
            'error' => $_GET['error'] ?? '',
            'success' => $_GET['success'] ?? ''
        ]);
    }

    // Helper method to merge DOB data with orders
    private function mergeDOBWithOrders($orders) {
        // Fetch DOBs (now sale_date)
        $dobs = $this->model->getCustomerDOBs();

        // Merge DOBs into the orders array
        foreach ($orders as &$order) {
            $saleId = $order['id'];
            $order['date_of_birth'] = isset($dobs[$saleId]) ? $dobs[$saleId] : 'N/A';
        }
        unset($order); // Unset the reference to avoid issues

        return $orders;
    }
}