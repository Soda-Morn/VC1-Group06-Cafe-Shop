<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_ID'])) {
  // Redirect to the login page if not logged in
  header('Location: /login.php');
  exit();
}

// User data from session
$userName = $_SESSION['name'] ?? 'User';
$userEmail = $_SESSION['email'] ?? 'user@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? 'default-avatar.png';

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'] ?? '';
    $newEmail = $_POST['email'] ?? '';
    $newProfilePicture = $_FILES['profile_picture'] ?? null;

    // Validate the inputs
    if (!empty($newName)) {
        $_SESSION['name'] = $newName;
    }
    if (!empty($newEmail)) {
        $_SESSION['email'] = $newEmail;
    }

    // Handle profile picture upload
    if ($newProfilePicture && $newProfilePicture['error'] === 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($newProfilePicture['name']);
        if (move_uploaded_file($newProfilePicture['tmp_name'], $uploadFile)) {
            $_SESSION['profile_picture'] = $uploadFile;
        }
    }

    // Redirect to profile page after updating
    header('Location: /Profile_info');
    exit();
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
