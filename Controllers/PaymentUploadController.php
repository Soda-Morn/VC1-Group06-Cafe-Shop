<?php
require_once 'Models/PaymentUploadModel.php';
require_once 'BaseController.php';

class PaymentUploadController extends BaseController
{
    private $model;

    function __construct()
    {
        $this->model = new PaymentUploadModel();
        session_start(); // Ensure session is started
    }

    function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = ['success' => false, 'message' => ''];

            // Check if a file was uploaded
            if (isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['qr_image'];
                $fileName = $file['name'];
                $fileTmpPath = $file['tmp_name'];
                $fileSize = $file['size'];

                // Validate file type (only allow images)
                $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
                $fileType = mime_content_type($fileTmpPath);
                if (!in_array($fileType, $allowedTypes)) {
                    $response['message'] = 'Invalid file type. Only PNG, JPEG, JPG, and GIF are allowed.';
                    echo json_encode($response);
                    return;
                }

                // Validate file size (e.g., max 5MB)
                $maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if ($fileSize > $maxSize) {
                    $response['message'] = 'File is too large. Maximum size is 5MB.';
                    echo json_encode($response);
                    return;
                }

                // Define the upload directory
                $uploadDir = 'uploads/qr_codes/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
                }

                // Generate a unique file name to avoid overwriting
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = 'qr_code_' . time() . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;

                // Move the uploaded file to the destination
                if (move_uploaded_file($fileTmpPath, $destination)) {
                    // Store the QR code image path in the database
                    if ($this->model->storeQRCodeImage($destination)) {
                        $response['message'] = 'QR code uploaded successfully!';
                        $response['success'] = true;
                    } else {
                        $response['message'] = 'Failed to store QR code in the database.';
                        unlink($destination); // Delete file if DB fails
                    }
                } else {
                    $response['message'] = 'Failed to upload the file.';
                }
            } else {
                $response['message'] = 'Please select a file to upload.';
            }

            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }

        // For GET request, just render the view without any message
        $this->view('/payment/upload_payment', []);
    }
}