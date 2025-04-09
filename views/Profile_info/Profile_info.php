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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($userName); ?>'s Profile</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .container-1 {
      max-width: 900px;
      width: 95%;
      margin: 80px auto;
      padding: 40px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 25px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    @keyframes slideIn {
      from { transform: translateY(100px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .back-button {
      /* position: absolute; */
      top: 20px;
      left: 20px;
      color: #a04d13;
      padding: 10px 15px;
      border-radius: 50%;
    }
    .back-button:hover {
      background: #a04d13;
      color: #ffff;
    }
    .profile-header {
      text-align: center;
      position: relative;
    }

    .avatar {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid #fff;
      
      transition: all 0.4s ease;
    }
    .avatar-placeholder {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      background: linear-gradient(45deg, #ff6b6b, #ffa07a);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 80px;
      font-weight: bold;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    h2 {
      margin-top: 20px;
      font-size: 32px;
      color: #2a5298;
      letter-spacing: 2px;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .profile-info {
      margin: 30px 0;
      padding: 20px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      font-size: 18px;
      transition: all 0.3s ease;
    }

    .profile-info div {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .profile-info i {
      color: #ff6b6b;
      font-size: 20px;
    }

    .profile-info strong {
      color: #2a5298;
      font-weight: 600;
    }

    .btn-group {
      display: flex;
      justify-content: space-between; 
      align-items: center;
      margin-top: 40px;
      padding: 0 20px; 
    }

    .btn-edit {
      background: linear-gradient(45deg, #a04d13, #a04d13);
      padding: 12px 25px;
      text-decoration: none;
      color: white;
      font-weight: 600;
      border-radius: 50px;
      font-size: 16px;
      transition: all 0.4s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Green tones for Edit */
    }

    .btn-logout {
      background: linear-gradient(45deg,rgb(240, 51, 38),rgb(223, 33, 30));
      padding: 12px 25px;
      text-decoration: none;
      color: white;
      font-weight: 600;
      border-radius: 50px;
      font-size: 16px;
      transition: all 0.4s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Red tones for Logout */
    }
    .decorative-bg {
      position: absolute;
      top: -50px;
      right: -50px;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(255, 107, 107, 0.3), transparent);
      z-index: -1;
      animation: float 6s infinite ease-in-out;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0); }
      50% { transform: translate(20px, 20px); }
    }

    /* Remove any potential blue background from profile header */
    .profile-header::before {
      display: none;
    }

    @media (max-width: 768px) {
      .container-1 {
        margin: 40px 10px;
        padding: 25px;
      }

      .avatar, .avatar-placeholder {
        width: 140px;
        height: 140px;
      }

      h2 {
        font-size: 26px;
      }

      .profile-info {
        font-size: 16px;
        padding: 15px;
      }

      .btn-group {
        padding: 0 10px;
      }
    }
  </style>
</head>
<body>
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
</body>
</html>
