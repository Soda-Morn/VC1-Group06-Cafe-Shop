<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }

    public function getUsers()
    {
        $result = $this->db->query("SELECT * FROM admins");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($admin_ID)
    {
        $result = $this->db->query("SELECT * FROM admins WHERE admin_ID = :admin_ID", [':admin_ID' => $admin_ID]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $result = $this->db->query("SELECT * FROM admins WHERE email = :email", [':email' => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($name, $email, $password, $profilePicture = null)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $this->db->query(
                "INSERT INTO admins (name, email, password, profile_picture) VALUES (:name, :email, :password, :profile_picture)",
                [
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashedPassword,
                    ':profile_picture' => $profilePicture
                ]
            );
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // New updateUser function
    public function updateUser($admin_ID, $name, $email, $password = null, $profilePicture = null)
    {
        try {
            $params = [
                ':admin_ID' => $admin_ID,
                ':name' => $name,
                ':email' => $email,
                ':profile_picture' => $profilePicture
            ];
            
            if ($password) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $params[':password'] = $hashedPassword;
                $query = "UPDATE admins SET name = :name, email = :email, password = :password, profile_picture = :profile_picture WHERE admin_ID = :admin_ID";
            } else {
                $query = "UPDATE admins SET name = :name, email = :email, profile_picture = :profile_picture WHERE admin_ID = :admin_ID";
            }

            $this->db->query($query, $params);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // New storeUser function (alternative to addUser with more flexibility)
    public function storeUser($data)
    {
        $defaults = [
            'name' => '',
            'email' => '',
            'password' => '',
            'profile_picture' => null
        ];
        
        $data = array_merge($defaults, $data);
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        try {
            $this->db->query(
                "INSERT INTO admins (name, email, password, profile_picture) VALUES (:name, :email, :password, :profile_picture)",
                [
                    ':name' => $data['name'],
                    ':email' => $data['email'],
                    ':password' => $hashedPassword,
                    ':profile_picture' => $data['profile_picture']
                ]
            );
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }
}