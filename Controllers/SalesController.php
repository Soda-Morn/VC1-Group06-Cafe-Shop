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
        $total_revenue = $this->sale->getTotalRevenue();
        $total_revenue_formatted = number_format($total_revenue, 0, '.', ',');

        // Add expenses calculation
        $total_expenses = $this->sale->getTotalExpenses();
        $total_expenses_formatted = number_format($total_expenses, 0, '.', ',');

        // Add profit calculation
        $total_profit = $total_revenue - $total_expenses;
        $total_profit_formatted = number_format($total_profit, 0, '.', ',');

        $data = [
            'total_revenue_formatted' => $total_revenue_formatted,
            'total_expenses_formatted' => $total_expenses_formatted,
            'total_profit_formatted' => $total_profit_formatted
        ];
        $this->view('dashboard/dashboard', $data);
    }
}
