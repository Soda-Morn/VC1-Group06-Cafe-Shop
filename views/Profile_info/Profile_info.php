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

<div class="profile-container">
    <!-- Profile Picture -->
    <div class="avatar-container">
        <?php if (!empty($profilePicture)): ?>
            <img src="/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="avatar">
        <?php else: ?>
            <div class="avatar-placeholder">
                <?php echo strtoupper(substr($userName, 0, 1)); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Profile Information -->
    <div class="profile-info">
        <div class="profile-item">
            <strong>Name:</strong> <?php echo htmlspecialchars($userName); ?>
        </div>
        <div class="profile-item">
            <strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?>
        </div>
    </div>

    <!-- Edit Profile Button -->
    <a href="/Profile_info/profile_edit" class="edit-button">Edit Profile</a>
</div>

<style>
/* General profile page container */
.profile-container {
    margin: 120px auto;
    padding: 50px 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 900px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    font-family: 'Arial', sans-serif;
    text-align: center;
    transition: all 0.3s ease;
}

/* Avatar styles */
.avatar-container {
    margin-bottom: 40px;
}

.avatar {
    border-radius: 50%;
    width: 160px;
    height: 160px;
    object-fit: cover;
    border: 4px solid #ffffff;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

/* Placeholder for no profile picture */
.avatar-placeholder {
    background-color: #ff5722;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 60px;
    width: 160px;
    height: 160px;
    border-radius: 50%;
    font-weight: bold;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

/* Profile info styles */
.profile-info {
    margin-top: 20px;
    text-align: left;
    width: 100%;
}

.profile-item {
    font-size: 18px;
    color: black; /* Changed text color to black */
    margin-bottom: 10px;
}

.profile-item strong {
    color: #ff5722;
    margin-right: 10px;
}

/* Edit button styles */
.edit-button {
    margin-top: 30px;
    padding: 14px 32px;
    background-color: #ff5722;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    display: inline-block;
}

.edit-button:active {
    background-color: #d84315;
    transform: translateY(1px);
}

/* Adding responsiveness */
@media (max-width: 768px) {
    .profile-container {
        padding: 40px 20px;
    }

    .avatar {
        width: 140px;
        height: 140px;
    }

    .profile-item {
        font-size: 16px;
    }

    .profile-info {
        text-align: left;
    }

    .edit-button {
        font-size: 16px;
        padding: 12px 25px;
    }
}

@media (max-width: 480px) {
    .profile-container {
        padding: 30px 15px;
    }

    .avatar {
        width: 120px;
        height: 120px;
    }

    .profile-item {
        font-size: 14px;
    }

    .edit-button {
        font-size: 14px;
        padding: 10px 20px;
    }
}
</style>
<script src="views/assets/js/Language_options/profile-info-o.js"></script>