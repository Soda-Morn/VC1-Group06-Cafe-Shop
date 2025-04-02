<?php
require_once "Models/SalesModel.php";
require_once 'BaseController.php';

class SalesController extends BaseController
{
    private $sale;

    public function __construct()
    {
        $this->sale = new SalesModel();
    }

    public function index()
    {
        // Get top 6 products
        $top_products = $this->sale->getTopProducts(6);

        // Get financial data
        $total_revenue = $this->sale->getTotalRevenue();
        $total_revenue_formatted = number_format($total_revenue, 0, '.', ',');

        $total_expenses = $this->sale->getTotalExpenses();
        $total_expenses_formatted = number_format($total_expenses, 0, '.', ',');

        $total_profit = $total_revenue - $total_expenses;
        $total_profit_formatted = number_format($total_profit, 0, '.', ',');

        // Pass data to view
        $this->view('dashboard/dashboard', [
            'orders' => $top_products,
            'total_revenue_formatted' => $total_revenue_formatted,
            'total_expenses_formatted' => $total_expenses_formatted,
            'total_profit_formatted' => $total_profit_formatted,
            'error' => $_GET['error'] ?? '',
            'success' => $_GET['success'] ?? ''
        ]);
    }
}