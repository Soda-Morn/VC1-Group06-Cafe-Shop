<?php
session_start();
if (isset($_SESSION['admin_ID'])) {
    header("Location: /dashboard");
    exit();
}
require_once __DIR__ . "/../layouts/header.php";
?>

<link rel="stylesheet" href="views/assets/css/login.css">
<div class="container-1">
    <h2>Admin Login</h2>
    <form id="loginForm">
        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
            <!-- Add password toggle button -->
            <button type="button" id="togglePassword" class="password-toggle">👁️</button>
        </div>
        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="forgot-password">
            <a href="/forgot-password">Forgot Password?</a>
        </div>
    </form>
    <div id="message"></div>
    <div class="register-link mt-3 text-center">
        Don't have an account? <a href="/register">Register here</a>
    </div>
</div>
<link rel="stylesheet" href="views/assets/js/login.js">

