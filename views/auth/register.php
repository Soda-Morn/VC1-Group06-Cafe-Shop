<?php
session_start();
if (isset($_SESSION['admin_ID'])) {
    header("Location: /dashboard");
    exit();
}
require_once __DIR__ . "/../layouts/header.php";
?>

<link rel="stylesheet" href="views/assets/css/Rigister.css">
<div class="container-1">
    <div class="form-container">
        <h2>Admin Registration</h2>
        <form id="registrationForm">
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="name" id="username" placeholder="Choose a username" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Create a password" required>
                    <button type="button" id="togglePassword" class="password-toggle">👁️</button>
                </div>
            </div>
            <div class="form-group">
                <label for="profilePicture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_picture" id="profilePicture">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <div id="message"></div>
        <div class="mt-3 text-center">
            Already have an account? <a href="/login" class="login-link">Login here</a>
        </div>
    </div>
    <div class="imang"></div>
</div>
<link rel="stylesheet" href="views/assets/js/register.js">

