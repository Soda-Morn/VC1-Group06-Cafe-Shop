<?php
class DashboardController extends BaseController {


    public function __construct() {
        $this-> topProduct =DashboardModel();
        
    }
        
    }
    public function index() {
        $this->view('dashboard/dashboard');
    }
}
