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


    

    <div class="profile-container">
        <!-- Back Button at Top-Left -->
        <a href="/Profile_info" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="profile-edit-container">
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
                        <h2>Edit Profile</h2>
                        <label for="profile_picture"></label>
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
  <script src="/views/assets/js/Language_options/profile-edit-o.js"></script>
</body>
</html>