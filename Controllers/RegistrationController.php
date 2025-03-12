<?php

class RegistrationController extends BaseController
{
    private $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
    }

    /**
     * Show the registration form
     */
    public function showForm()
    {
        $this->view('Registration');
    }

    /**
     * Process the registration form submission
     */
    public function register()
    {
        // Validate form data
        $email = $_POST['email'] ?? '';
        $name = $_POST['username'] ?? ''; // Form field is 'username' but we'll store as 'name'
        $password = $_POST['password'] ?? '';
        
        // Basic validation
        if (empty($email) || empty($name) || empty($password)) {
            $error = "All fields are required";
            $this->view('Registration', ['error' => $error]);
            return;
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
            $this->view('Registration', ['error' => $error]);
            return;
        }
        
        // Check if email already exists
        if ($this->registrationModel->emailExists($email)) {
            $error = "Email already registered";
            $this->view('Registration', ['error' => $error]);
            return;
        }
        
        // Check if name already exists
        if ($this->registrationModel->nameExists($name)) {
            $error = "Name already taken";
            $this->view('Registration', ['error' => $error]);
            return;
        }
        
        // Handle profile picture upload
        $profilePicturePath = null;
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'views/assets/images/profiles/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = time() . '_' . basename($_FILES['profilePicture']['name']);
            $targetFilePath = $uploadDir . $fileName;
            
            // Check file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['profilePicture']['type'];
            
            if (!in_array($fileType, $allowedTypes)) {
                $error = "Only JPG, PNG, and GIF files are allowed";
                $this->view('Registration', ['error' => $error]);
                return;
            }
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath)) {
                $profilePicturePath = $targetFilePath;
            } else {
                $error = "Failed to upload profile picture";
                $this->view('Registration', ['error' => $error]);
                return;
            }
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Register admin
        $result = $this->registrationModel->registerAdmin($email, $name, $hashedPassword, $profilePicturePath);
        
        if ($result) {
            // Redirect to login page or dashboard
            $this->redirect('/');
        } else {
            $error = "Registration failed. Please try again.";
            $this->view('Registration', ['error' => $error]);
        }
    }
}

