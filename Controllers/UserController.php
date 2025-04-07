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

    // New edit function - Displays the edit form
    public function edit($admin_ID = null)
    {
        session_start();
        if (!isset($_SESSION['admin_ID'])) {
            header("Location: /login");
            exit();
        }

        if ($admin_ID === null) {
            $admin_ID = $_SESSION['admin_ID'];
        }

        $user = $this->user->getUserById($admin_ID);
        if (!$user) {
            echo json_encode(["status" => "error", "message" => "User not found!"]);
            exit();
        }

        // Display the edit form
        require_once "views/auth/edit.php";
    }

    // New update function - Handles the update form submission
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            if (!isset($_SESSION['admin_ID'])) {
                echo json_encode(["status" => "error", "message" => "Please login to update profile!"]);
                exit();
            }

            $admin_ID = $_SESSION['admin_ID'];
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : null;
            $profilePicture = null;

            if (empty($name) || empty($email)) {
                echo json_encode(["status" => "error", "message" => "Name and email are required!"]);
                exit();
            }

            // Check if email is already taken by another user
            $existingUser = $this->user->getUserByEmail($email);
            if ($existingUser && $existingUser['admin_ID'] != $admin_ID) {
                echo json_encode(["status" => "error", "message" => "Email already exists!"]);
                exit();
            }

            // Handle profile picture upload
            if (!empty($_FILES['profile_picture']['name'])) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES["profile_picture"]["name"]);
                $targetFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
                    $profilePicture = $targetFilePath;
                    // Optionally delete old profile picture if it exists
                    if (!empty($_SESSION['profile_picture']) && file_exists($_SESSION['profile_picture'])) {
                        unlink($_SESSION['profile_picture']);
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to upload profile picture!"]);
                    exit();
                }
            }

            $result = $this->user->updateUser($admin_ID, $name, $email, $password, $profilePicture);
            if ($result) {
                // Update session variables
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                if ($profilePicture) {
                    $_SESSION['profile_picture'] = $profilePicture;
                }
                
                echo json_encode(["status" => "success", "message" => "Profile updated successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update profile!"]);
            }
            exit();
        }
    }
}