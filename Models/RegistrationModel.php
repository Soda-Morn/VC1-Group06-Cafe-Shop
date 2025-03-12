<?php

class RegistrationModel
{
    private $db;

    public function __construct()
    {
        // Get database connection
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'cafe_shop_db';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASS') ?: '';
        
        $this->db = new Database($host, $dbname, $username, $password);
    }

    /**
     * Check if email already exists in the database
     * 
     * @param string $email The email to check
     * @return bool True if email exists, false otherwise
     */
    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM admin WHERE email = ?";
        $result = $this->db->query($sql, [$email]);
        return $result->fetchColumn() > 0;
    }

    /**
     * Check if username already exists in the database
     * 
     * @param string $name The name to check
     * @return bool True if name exists, false otherwise
     */
    public function nameExists($name)
    {
        $sql = "SELECT COUNT(*) FROM admin WHERE name = ?";
        $result = $this->db->query($sql, [$name]);
        return $result->fetchColumn() > 0;
    }

    /**
     * Register a new admin
     * 
     * @param string $email Admin's email
     * @param string $name Admin's name
     * @param string $password Admin's hashed password
     * @param string|null $profilePicture Path to profile picture
     * @return bool True if registration successful, false otherwise
     */
    public function registerAdmin($email, $name, $password, $profilePicture = null)
    {
        try {
            $sql = "INSERT INTO admin (email, name, password, profile_picture, created_at) 
                    VALUES (?, ?, ?, ?, NOW())";
            
            $this->db->query($sql, [$email, $name, $password, $profilePicture]);
            return true;
        } catch (PDOException $e) {
            // Log error
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }
}

