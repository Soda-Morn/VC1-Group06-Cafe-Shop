<?php

class DashboardController extends BaseController {
    public function index() {
        $this->view('dashboard/dashboard');
    }
}