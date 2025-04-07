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



  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      color: #333;
    }

    .container-1 {
      max-width: 800px;
      width: 98%;
      margin: 120px auto;
      padding: 30px;
      background: linear-gradient(135deg, #ffffff, #f8f9fa);
      border-radius: 20px;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
      position: relative;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

  
    .avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      
      object-fit: cover;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .avatar-placeholder {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background-color: #ff5722;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 60px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

  
    h2 {
      margin-top: 15px;
      font-size: 26px;
      color: #333;
    }

    .profile-info {
      margin-top: 25px;
      font-size: 16px;
      text-align: left;
      padding: 0 30px;
    }

    .profile-info div {
      margin-bottom: 15px;
    }

    .profile-info strong {
      color: #ff5722;
      margin-right: 10px;
    }

    .btn-group {
      margin-top: 30px;
    }

    .btn {
      padding: 10px 20px;
      text-decoration: none;
      background-color: #ff5722;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      font-size: 14px;
      transition: background-color 0.3s ease, transform 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

   .back-button{
    color: black;
    background-color: white;
   }

    @media (max-width: 768px) {
      .container {
        margin: 60px 15px;
        padding: 25px 15px;
      }

      .avatar,
      .avatar-placeholder {
        width: 120px;
        height: 120px;
      }

      h2 {
        font-size: 22px;
      }

      .profile-info {
        font-size: 14px;
        padding: 0 15px;
      }

      .btn {
        font-size: 13px;
        padding: 8px 16px;
      }
    }
  </style>


  <div class="container-1">
    <a href="/dashboard" class="back-button" title="Back to Dashboard"><i class="fas fa-arrow-left"></i></a>

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
      <div><strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?></div>
      <!-- Additional fields like phone or role can go here -->
    </div>

    <div class="btn-group">
      <a href="/Profile_info/profile_edit" class="btn"><i class="fas fa-user-edit"></i> Edit Profile</a>
    </div>
  </div>

</body>
</html>
