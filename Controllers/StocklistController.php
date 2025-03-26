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
  
    public function edit($purchaseItemId)
    {
        // Fetch specific stock item by ID
        // $stocklist = $this->stocklist->getStockById($purchaseItemId);
    
        // if (!$stocklist) {
        //     die("Stock item not found!"); // Handle case where item doesn't exist
        // }
    
        $this->view('inventory/edit_stocklist',);
    }
    

    
     
}