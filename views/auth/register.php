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
        background: linear-gradient(135deg, #F5E8C7, #D9B38C); /* Warm coffee gradient */
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
    }
    .container-1 {
        width: 90%;
        max-width: 900px;
        margin: 20px auto;
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex; 
        flex-direction: row;
        height: 650px; /* Fixed height for consistency */
    }
    h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: #4A2C1A;
        margin-bottom: 10px;
        margin-top: 10px;
        text-align: center;
        opacity: 0;
        animation: fadeIn 1s ease forwards 0.1s;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .form-container {
        flex: 1;
        padding: 40px;
        background: #FAF3E0;
        border-radius: 10px 0 0 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-label {
        font-weight: 500;
        color: #4A2C1A;
        margin-bottom: 8px;
        display: block;
    }
    .form-control {
        border: 2px solid #D9B38C;
        border-radius: 10px;
        padding: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
    }
    .form-control:focus {
        border-color: #FF8C00;
        box-shadow: 0 0 8px rgba(255, 140, 0, 0.3);
        outline: none;
    }
    .btn-primary {
        width: 100%;
        background: linear-gradient(to right, #FF8C00, #D2691E);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-size: 16px;
        font-weight: 500;
        color: #FFF;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(255, 140, 0, 0.3);
        background: linear-gradient(to right, #E07B00, #B35712);
    }
    .imang {
        flex: 1;
        background: url('/views/assets/images/register.png') no-repeat center;
        background-size: cover;
        position: relative;
    }
    .imang::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3); /* Overlay for contrast */
    }
    #message .alert {
        border-radius: 10px;
        padding: 10px;
        margin-top: 15px;
        text-align: center;
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
    .login-link {
        text-align: center;
        margin-top: 15px;
        color: #4A2C1A;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    .login-link:hover {
        color: #FF8C00;
        text-decoration: underline;
    }
    @media (max-width: 768px) {
        .container-1 {
            flex-direction: column;
            height: auto;
        }
        .form-container, .imang {
            flex: none;
            height: 400px;
        }
        h2 {
            font-size: 24px;
        }
        .form-container {
            padding: 20px;
        }
    }
</style>

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
                <input type="password" class="form-control" name="password" id="password" placeholder="Create a password" required>
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

<script>
    document.getElementById("registrationForm").addEventListener("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("/users/store", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let messageDiv = document.getElementById("message");
                if (data.status === "success") {
                    messageDiv.innerHTML = "<div class='alert alert-success'>" + data.message + "</div>";
                    setTimeout(() => {
                        window.location.href = "/login";
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
</script>