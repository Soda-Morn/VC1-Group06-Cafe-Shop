<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['admin_ID'])) {
    header('Location: /login.php');
    exit();
}

require_once "Models/UserModel.php";
$userModel = new UserModel();

// User data from session
$userName = $_SESSION['name'] ?? 'User';
$userEmail = $_SESSION['email'] ?? 'user@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? 'uploads/default-avatar.png';

// Ensure the profile picture exists, fallback to default if not
if (!file_exists($profilePicture)) {
    $profilePicture = 'uploads/default-avatar.png';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = trim(htmlspecialchars($_POST['name'] ?? ''));
    $newEmail = trim(htmlspecialchars($_POST['email'] ?? ''));
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $newProfilePicture = $_FILES['profile_picture'] ?? null;

    if (empty($newName) || empty($newEmail)) {
        $error = "Name and email are required!";
    } else {
        $existingUser = $userModel->getUserByEmail($newEmail);
        if ($existingUser && $existingUser['admin_ID'] != $_SESSION['admin_ID']) {
            $error = "Email is already in use by another account!";
        } else {
            $passwordToUpdate = null;
            if (!empty($newPassword)) {
                if (empty($currentPassword) || empty($newPassword)) {
                    $error = "All password fields are required when changing password!";
                } else {
                    $user = $userModel->getUserById($_SESSION['admin_ID']);
                    if (!password_verify($currentPassword, $user['password'])) {
                        $error = "Current password is incorrect!";
                    } elseif (strlen($newPassword) < 6) {
                        $error = "New password must be at least 6 characters long!";
                    } else {
                        $passwordToUpdate = $newPassword;
                    }
                }
            }

            if (!isset($error)) {
                $profilePicturePath = $profilePicture;
                if ($newProfilePicture && $newProfilePicture['error'] === 0) {
                    $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = time() . '_' . basename($newProfilePicture['name']);
                    $uploadFile = $uploadDir . $fileName;

                    if (move_uploaded_file($newProfilePicture['tmp_name'], $uploadFile)) {
                        $profilePicturePath = $uploadFile;
                        if ($profilePicture !== 'uploads/default-avatar.png' && file_exists($profilePicture)) {
                            unlink($profilePicture);
                        }
                    }
                }

                $result = $userModel->updateUser(
                    $_SESSION['admin_ID'],
                    $newName,
                    $newEmail,
                    $passwordToUpdate,
                    $profilePicturePath
                );

                if ($result) {
                    $_SESSION['name'] = $newName;
                    $_SESSION['email'] = $newEmail;
                    $_SESSION['profile_picture'] = $profilePicturePath;
                    header('Location: /Profile_info');
                    exit();
                } else {
                    $error = "Failed to update profile. Please try again.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            margin: 120px auto;
            padding: 50px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .profile-edit-container {
            width: 100%;
        }

        .profile-edit-container h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            font-size: 13px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 6px 10px;
            font-size: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fafafa;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #ff5722;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.15);
        }

        .profile-preview {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            width: 100%;
        }

        .profile-preview img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e0e0e0;
        }

        .save-button {
            width: 100%;
            padding: 10px;
            background-color: #ff5722;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-bottom: 15px;
        }

        .save-button:hover {
            background-color: #e64a19;
        }

        .save-button:active {
            transform: scale(0.98);
        }

        .error-message {
            color: #d32f2f;
            background-color: #ffebee;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #607d8b;
            color: white;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .back-button i {
            margin-right: 8px;
        }

        .back-button:hover {
            background-color: #455a64;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 40px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .save-button, .back-button {
                font-size: 12px;
                padding: 8px 15px;
            }
        }

        @media (max-width: 480px) {
            .profile-container {
                padding: 30px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Profile Edit Form -->
        <div class="profile-edit-container">
            <h2>Edit Profile</h2>

            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <div class="profile-preview">
                            <?php if (!empty($profilePicture) && file_exists($profilePicture)): ?>
                                <img id="preview" src="/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
                            <?php else: ?>
                                <img id="preview" src="/uploads/default-avatar.png" alt="Profile Picture">
                            <?php endif; ?>
                        </div>
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Current password">
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="New password">
                    </div>

                    <div class="form-group full-width">
                        <button type="submit" class="save-button">Save Changes</button>
                    </div>
                </div>
            </form>

            <a href="/Profile_info" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>