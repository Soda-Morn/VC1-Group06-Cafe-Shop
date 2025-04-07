<?php

class Profile_infoController extends BaseController {
    public function index() {
        $this->view('Profile_info/Profile_info');
    }
    public function edit() {
        $this->view('Profile_info/profile_edit');
    }
}