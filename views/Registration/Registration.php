<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

<style>
    body {
        background-color: #f7f7f7;
        font-family: 'Arial', sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        padding: 30px;
        margin-top: 50px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .imang img {
        width: 100%;
        height: 470px;
        border-radius: 12px;
        margin: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .form-container {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 12px;
        background-color: #ffffff;
        margin-bottom: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-label {
        font-weight: 600;
        font-size: 16px;
    }

    h2 {
        font-size: 28px;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 20px;
        margin-left: 90px;
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .invalid-feedback {
        font-size: 14px;
        color: red;
    }

    .form-control {
        border-radius: 6px;
        border-color: #ccc;
        box-shadow: none;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    /* Media Queries for mobile responsiveness */
    @media (max-width: 767px) {
        h2 {
            margin-left: 0;
            text-align: center;
        }

        .container {
            padding: 20px;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .imang img {
            height: auto; /* Make the image responsive */
        }

        .row {
            flex-direction: column;
            align-items: center;
        }

        .col-md-6 {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

<body>
<div class="container mt-5">
    <h2>User Registration</h2>

    <div class="row">
        <!-- Form Section with Box Shadow -->
        <div class="col-md-6">
            <div class="form-container">
                <form id="registrationForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Choose a username" required>
                        <div class="invalid-feedback" id="usernameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Create a password" required>
                        <div class="invalid-feedback" id="passwordError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>

        <!-- Image Section with Box Shadow -->
        <div class="col-md-6">
            <div class="imang">
                <img src="views/assets/images/image copy 2.png" alt="Profile Image">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
