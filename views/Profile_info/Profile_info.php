<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_ID'])) {
  header('Location: /login.php');
  exit();
}

// Admin data from session
$userName = $_SESSION['name'] ?? 'Admin';
$userEmail = $_SESSION['email'] ?? 'admin@example.com';
$profilePicture = $_SESSION['profile_picture'] ?? '';
?>

<link rel="stylesheet" href="../views/assets/css/profile_info.css">

<div class="container-1">
  <a href="/dashboard" class="back-button" title="Back to Dashboard"><i class="fas fa-arrow-left"></i></a>
  <div class="decorative-bg"></div>

  <div class="profile-header">
    <?php if (!empty($profilePicture)): ?>
      <img src="/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="avatar">
    <?php else: ?>
      <div class="avatar-placeholder">
        <?php echo strtoupper(substr($userName, 0, 1)); ?>
      </div>
    <?php endif; ?>
    <h2><?php echo htmlspecialchars($userName); ?></h2>
  </div>

  <div class="profile-info">
    <div><i class="fas fa-envelope"></i><strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?></div>
    <div><i class="fas fa-user-shield"></i><strong>Role:</strong> Administrator</div>
    <div><i class="fas fa-clock"></i><strong>Last Login:</strong> <?php echo date('F j, Y'); ?></div>
  </div>

  <div class="btn-group">
    <a href="/Profile_info/profile_edit" class="btn-edit"><i class="fas fa-user-edit"></i> Edit Profile</a>
    <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>
<script src="/views/assets/js/Language_options/profile-info-o.js"></script>