<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function registerUser($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->db->query("INSERT INTO admins (name, password) VALUES (?, ?)", [$username, $hashedPassword]);
    }

    public function loginUser($username, $password) {
        $stmt = $this->db->query("SELECT password FROM admins WHERE name = ?", [$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && password_verify($password, $user['password']);
    }
}