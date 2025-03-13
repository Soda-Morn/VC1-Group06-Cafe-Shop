<?php
session_start();
if (isset($_SESSION['admin_ID'])) {
    header("Location: /dashboard");
    exit();
}
require_once __DIR__ . "/../layouts/header.php";
?>

<style>
    .container-1 {
        width: 70%;
        margin: auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-container {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .btn-primary {
        width: 100%;
        background: #007bff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    .imang img {
        width: 100%;
        max-width: 500px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: block;
        margin: auto;
    }

    .forgot-password {
        display: block;
        margin-top: 10px;
        text-align: center;
        font-size: 14px;
    }

    .forgot-password a {
        color: #007bff;
        text-decoration: none;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .remember-me {
        margin-top: 10px;
    }
</style>

<div class="container-1">
    <h2>Admin Login</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-container">
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>

                    <!-- Remember Me checkbox -->
                    <div class="remember-me">
                        <label>
                            <input type="checkbox" name="remember" id="remember"> Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>

                    <!-- Forgot password link -->
                    <div class="forgot-password">
                        <a href="/forgot-password">Forgot Password?</a>
                    </div>
                </form>

                <div id="message"></div>
                <div class="mt-3 text-center">
                    Don't have an account? <a href="/register">Register here</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="imang">
                <img src="/views/assets/images/login.png" alt="Login Image">
            </div>
        </div>
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
</script>
