<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_ID'])) {
    // Redirect to the login page if not logged in
    header('Location: /login.php');
    exit();
}

// Include the UserModel
require_once "Models/UserModel.php";

// Create UserModel instance
$userModel = new UserModel();

// User data from session
$userName = $_SESSION['name'] ?? 'User';
$userEmail = $_SESSION['email'] ?? 'user@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? 'default-avatar.png';

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = trim(htmlspecialchars($_POST['name'] ?? ''));
    $newEmail = trim(htmlspecialchars($_POST['email'] ?? ''));
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $newProfilePicture = $_FILES['profile_picture'] ?? null;

    // Validate the inputs
    if (empty($newName) || empty($newEmail)) {
        $error = "Name and email are required!";
    } else {
        // Check if email is already taken by another user
        $existingUser = $userModel->getUserByEmail($newEmail);
        if ($existingUser && $existingUser['admin_ID'] != $_SESSION['admin_ID']) {
            $error = "Email is already in use by another account!";
        } else {
            // Handle password update if provided
            $passwordToUpdate = null;
            if (!empty($newPassword) || !empty($confirmPassword) || !empty($currentPassword)) {
                // All password fields must be filled if any are provided
                if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                    $error = "All password fields are required when changing password!";
                } else {
                    // Verify current password
                    $user = $userModel->getUserById($_SESSION['admin_ID']);
                    if (!password_verify($currentPassword, $user['password'])) {
                        $error = "Current password is incorrect!";
                    } elseif ($newPassword !== $confirmPassword) {
                        $error = "New passwords do not match!";
                    } elseif (strlen($newPassword) < 6) {
                        $error = "New password must be at least 6 characters long!";
                    } else {
                        $passwordToUpdate = $newPassword;
                    }
                }
            }

            if (!isset($error)) {
                $profilePicturePath = $profilePicture;
                
                // Handle profile picture upload
                if ($newProfilePicture && $newProfilePicture['error'] === 0) {
                    $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = time() . '_' . basename($newProfilePicture['name']);
                    $uploadFile = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($newProfilePicture['tmp_name'], $uploadFile)) {
                        $profilePicturePath = $uploadFile;
                        // Delete old profile picture if it exists and isn't the default
                        if ($profilePicture !== 'default-avatar.png' && file_exists($profilePicture)) {
                            unlink($profilePicture);
                        }
                    }
                }

                // Update the user in the database
                $result = $userModel->updateUser(
                    $_SESSION['admin_ID'],
                    $newName,
                    $newEmail,
                    $passwordToUpdate, // Pass new password if validated, null otherwise
                    $profilePicturePath
                );

                if ($result) {
                    // Update session variables
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
    <style>
        /* Profile edit container */
        .profile-edit-container {
            margin: 120px auto;
            padding: 50px 25px;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 16px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        /* Profile picture preview */
        .profile-preview {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        .profile-preview img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ccc;
        }

        .save-button {
            padding: 14px 32px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .save-button:active {
            background-color: #d84315;
            transform: translateY(1px);
        }

        .error-message {
            color: #d84315;
            margin-bottom: 15px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .profile-edit-container {
                padding: 40px 20px;
            }

            .form-group input {
                font-size: 14px;
            }

            .save-button {
                font-size: 16px;
                padding: 12px 25px;
            }
        }
    </style>
</head>
<body>

<div class="profile-edit-container">
    <h2>Edit Profile</h2>

    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <!-- Profile Picture -->
        <div class="form-group">
            <div class="profile-preview">
                <img id="preview" src="<?php echo htmlspecialchars($profilePicture); ?>" >
            </div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" required>
        </div>

        <!-- Current Password -->
        <div class="form-group">
            <label for="current_password">Current Password (required if changing password)</label>
            <input type="password" id="current_password" name="current_password" placeholder="Enter current password">
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="new_password">New Password (optional)</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
        </div>

        <!-- Confirm New Password -->
        <div class="form-group">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="save-button">Save Changes</button>
    </form>
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