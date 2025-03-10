<?php require_once 'views/layouts/header.php'; ?>
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