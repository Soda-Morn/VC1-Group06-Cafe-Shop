<?php

require_once "Models/UserModel.php";

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function register()
    {
        // Display the registration form
        require_once "views/auth/register.php";
    }

    public function login()
    {
        // Display the login form
        require_once "views/auth/login.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $profilePicture = null;

            if (empty($name) || empty($email) || empty($password)) {
                echo json_encode(["status" => "error", "message" => "All fields are required!"]);
                exit();
            }

            if ($this->user->getUserByEmail($email)) {
                echo json_encode(["status" => "error", "message" => "Email already exists!"]);
                exit();
            }

            if (!empty($_FILES['profile_picture']['name'])) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES["profile_picture"]["name"]);
                $targetFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
                    $profilePicture = $targetFilePath;
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to upload profile picture!"]);
                    exit();
                }
            }

            $result = $this->user->addUser($name, $email, $password, $profilePicture);
            if ($result) {
                echo json_encode(["status" => "success", "message" => "Registration successful!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Registration failed!"]);
            }
            exit();
        }
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            if (empty($email) || empty($password)) {
                echo json_encode(["status" => "error", "message" => "Email and password are required!"]);
                exit();
            }

            $user = $this->user->getUserByEmail($email);
            if (!$user) {
                echo json_encode(["status" => "error", "message" => "Invalid email or password!"]);
                exit();
            }

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['admin_ID'] = $user['admin_ID'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                
                echo json_encode(["status" => "success", "message" => "Login successful!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Invalid email or password!"]);
            }
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /login");
        exit();
    }
}

