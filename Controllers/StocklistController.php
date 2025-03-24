<?php
require_once "Models/StockListModel.php";

class StocklistController extends BaseController {

    private $stocklist;

    public function __construct()
    {
        $this->stocklist = new StockListModel();
    }

    public function stocklist() {
        $stocklist = $this->stocklist->getStockList();
        $this->view('inventory/stocklist', ['stocklist' => $stocklist]);
    }
}