<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['admin_ID'])) {
  // Redirect to the login page if not logged in
  header('Location: /login.php');
  exit();
}

// User data from session
$userName = $_SESSION['name'] ?? 'User';
$userEmail = $_SESSION['email'] ?? 'user@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="views/assets/css/styles.css">
    <style>
        /* Add some custom styles for the profile page */
        .profile-container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .avatar {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
        .profile-info {
            margin-top: 20px;
            text-align: center;
        }
        .profile-info h2 {
            font-size: 24px;
        }
        .profile-info p {
            font-size: 16px;
            color: #666;
        }
        .edit-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-button:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Profile Picture -->
        <div class="avatar-container">
            <?php if (!empty($profilePicture)): ?>
                <img src="/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="avatar">
            <?php else: ?>
                <div class="avatar" style="background-color: #ff5722; display: flex; justify-content: center; align-items: center; color: white;">
                    <?php echo strtoupper(substr($userName, 0, 1)); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Profile Information -->
        <div class="profile-info">
            <h2><?php echo htmlspecialchars($userName); ?></h2>
            <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>
        </div>

        <!-- Edit Profile Button -->
        <a href="/profile_edit.php" class="edit-button">Edit Profile</a>
    </div>
</body>
</html>