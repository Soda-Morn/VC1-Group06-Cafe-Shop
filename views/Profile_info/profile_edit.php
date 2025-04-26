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
                        <i class="fas fa-save"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

  <script src="/views/assets/js/Language_options/profile-edit-o.js"></script>
  <script src="/views/assets/js/profile/profile_edit.js"></script>
