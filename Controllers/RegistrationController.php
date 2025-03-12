<?php
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        require 'views/Registration/login.php';
    }

    public function authenticate() {
        session_start();
        
        $username = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;
        
        if (!$username || !$password) {
            require 'views/Registration/login.php';
            return;
        }
        
        if ($this->userModel->loginUser($username, $password)) {
            $_SESSION['user'] = $username;
            header('Location: /');
        } else {
            require 'views/dashboard/dashboard.php.';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }
}