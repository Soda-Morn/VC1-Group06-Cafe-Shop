<?php
// Start session if not active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['admin_ID'])) {
    header('Location: /login.php');
    exit;
}

require_once "Models/UserModel.php";
$userModel = new UserModel();

// Load user data from session with defaults
$userName = $_SESSION['name'] ?? 'User';
$userEmail = $_SESSION['email'] ?? 'user@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? 'uploads/default-avatar.png';

// Validate profile picture existence
$profilePicture = file_exists($profilePicture) ? $profilePicture : 'uploads/default-avatar.png';

// Handle form submission
$error = null;
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
        if ($existingUser && $existingUser['admin_ID'] !== $_SESSION['admin_ID']) {
            $error = "Email is already in use!";
        } elseif (!empty($newPassword)) {
            if (empty($currentPassword)) {
                $error = "Current password required to change password!";
            } else {
                $user = $userModel->getUserById($_SESSION['admin_ID']);
                if (!password_verify($currentPassword, $user['password'])) {
                    $error = "Incorrect current password!";
                } elseif (strlen($newPassword) < 6) {
                    $error = "New password must be 6+ characters!";
                }
            }
        }

        if (!$error) {
            $profilePicturePath = $profilePicture;
            if ($newProfilePicture && $newProfilePicture['error'] === UPLOAD_ERR_OK) {
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

            $passwordToUpdate = $newPassword ?: null;
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
                exit;
            } else {
                $error = "Update failed. Try again.";
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
</head>
<body>
    <div class="profile-container">
        <a href="/Profile_info" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="profile-edit-container">
            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="profile-form">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img id="preview" src="/<?= htmlspecialchars($profilePicture) ?>" alt="Profile">
                        <div class="avatar-overlay">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </div>
                    <h1>Edit Your Profile</h1>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($userName) ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($userEmail) ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="current_password" name="current_password" placeholder="Current password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-key"></i>
                            <input type="password" id="new_password" name="new_password" placeholder="New password">
                        </div>
                    </div>

                    <button type="submit" class="save-button">
                        <span>Save Changes</span>
                        <i href="/dashboard" class="fas fa-save" ></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.add('loaded');
                };
                reader.readAsDataURL(file);
            }
        }

        // Add animation on form focus
        document.querySelectorAll('.input-wrapper input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });
    </script>

    <style>


        .profile-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 800px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a04d13;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #a04d13;
            color: #ffff;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h1 {
            color: #333;
            font-size: 28px;
            margin-top: 15px;
            background: linear-gradient(45deg, #6e8efb, #a777e3);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .profile-avatar {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-avatar:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay i {
            color: #fff;
            font-size: 24px;
        }

        .avatar-overlay input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            color: #555;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .input-wrapper {
            position: relative;
            transition: all 0.3s ease;
        }

        .input-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6e8efb;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 15px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .input-wrapper.focused i {
            color: #a777e3;
        }

        .input-wrapper.focused input {
            border-color: #6e8efb;
            box-shadow: 0 0 0 3px rgba(110, 142, 251, 0.2);
        }

        .save-button {
            grid-column: 1 / -1;
            padding: 12px;
            background: linear-gradient(45deg, #a04d13, #a04d13);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 20;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .save-button:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(255, 82, 82, 0.1);
            color: #d32f2f;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #d32f2f;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .profile-container {
                padding: 30px;
            }
        }
    </style>
</body>
</html>