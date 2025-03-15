<?php
session_start();
if (isset($_SESSION['admin_ID'])) {
    header("Location: /dashboard");
    exit();
}
require_once __DIR__ . "/../layouts/header.php";
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap');

    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: url('/views/assets/images/login.jpg') no-repeat center center;
        background-size: cover; /* Changed back to 'cover' to fill the entire screen */
        background-attachment: fixed; /* Fixed for a parallax-like effect */
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
        position: relative;
    }
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.45)); /* Gradient overlay for contrast */
        z-index: 0;
    }
    .container-1 {
        width: 90%;
        max-width: 400px; /* Narrower to match your screenshot */
        margin: 20px auto;
        background: linear-gradient(135deg, #DEBD97, rgba(210, 166, 121, 0.9)); /* Deeper coffee gradient */
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        padding: 30px;
        position: relative;
        z-index: 1;
        overflow: hidden;
        text-align: center; /* Center all content within the card */
    }
    .container-1::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(#DEBD97); /* Richer coffee tones */
        z-index: -1;
        border-radius: 25px;
        filter: blur(10px);
        opacity: 0.6;
        animation: glow 3s ease-in-out infinite; /* Glowing animation */
    }
    @keyframes glow {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 0.9; }
    }
    h2 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: #4A2C1A;
        margin: 0 auto 25px auto; /* Centered with bottom margin */
        text-align: center;
        opacity: 0;
        animation: fadeIn 1s ease forwards 0.5s;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .form-group {
        margin-bottom: 20px;
        opacity: 0;
        animation: fadeIn 1s ease forwards;
        animation-delay: 0.7s;
        text-align: left; /* Align form groups to the left within the centered card */
    }
    .form-label {
        font-weight: 500;
        color: #4A2C1A;
        margin-bottom: 6px;
        display: block;
        font-size: 14px;
    }
    .form-control {
        border: 2px solid #D9B38C;
        border-radius: 8px;
        padding: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        background: #FFF;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    .form-control:focus {
        border-color: #FF8C00;
        box-shadow: 0 0 6px rgba(255, 140, 0, 0.3);
        outline: none;
    }
    .remember-me {
        margin-top: 10px;
        display: flex;
        align-items: center;
        opacity: 0;
        animation: fadeIn 1s ease forwards;
        animation-delay: 0.9s;
        text-align: left; /* Align checkbox to the left */
    }
    .remember-me label {
        color: #4A2C1A;
        font-size: 13px;
        margin-left: 8px;
        transition: color 0.3s ease;
    }
    .remember-me input[type="checkbox"]:checked + label {
        color: #FF8C00;
    }
    .btn-primary {
        width: 100%;
        background: linear-gradient(to right, #A0522D, #D2691E); /* Coffee-themed gradient */
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-size: 16px;
        font-weight: 500;
        color: #FFF;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(165, 42, 42, 0.3); /* Adjusted shadow color */
        opacity: 0;
        animation: fadeIn 1s ease forwards;
        animation-delay: 1.1s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(165, 42, 42, 0.4);
        background: linear-gradient(to right, #8B4513, #CD5C5C);
    }
    .forgot-password, .register-link {
        text-align: center;
        margin-top: 15px;
        font-size: 13px;
        opacity: 0;
        animation: fadeIn 1s ease forwards;
        animation-delay: 1.3s;
    }
    .forgot-password a, .register-link a {
        color: #4A2C1A;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .forgot-password a:hover, .register-link a:hover {
        color: #FFFFFF; /* White for better contrast on hover */
        text-decoration: underline;
    }
    #message .alert {
        border-radius: 8px;
        padding: 10px;
        margin-top: 15px;
        text-align: center;
        animation: fadeIn 1s ease forwards;
    }
    #message .alert-success {
        background: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
    }
    #message .alert-danger {
        background: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }
    @media (max-width: 768px) {
        .container-1 {
            width: 95%;
            padding: 20px;
        }
        h2 {
            font-size: 22px;
        }
        .form-group, .remember-me, .btn-primary, .forgot-password, .register-link {
            animation-delay: 0.5s;
        }
    }
</style>

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

<script>
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("/users/authenticate", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let messageDiv = document.getElementById("message");
                if (data.status === "success") {
                    messageDiv.innerHTML = "<div class='alert alert-success'>" + data.message + "</div>";
                    setTimeout(() => {
                        window.location.href = "/dashboard";
                    }, 2000);
                } else {
                    messageDiv.innerHTML = "<div class='alert alert-danger'>" + data.message + "</div>";
                }
            })
            .catch(error => {
                console.error("Error:", error);
                document.getElementById("message").innerHTML = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
            });
    });

    // Add subtle background zoom effect
    window.addEventListener('scroll', function() {
        const bg = document.body;
        const scrollPosition = window.scrollY;
        bg.style.backgroundSize = `${100 + scrollPosition / 40}%`; /* Subtle zoom effect */
    });
</script>

