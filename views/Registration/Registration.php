<?php require_once 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <h2>User Registration</h2>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Form Section with Box Shadow -->
        <div class="col-md-6">
            <div class="form-container">
                <form action="/registration" method="POST" id="registrationForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Choose a username" required>
                        <div class="invalid-feedback" id="usernameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Create a password" required>
                        <div class="invalid-feedback" id="passwordError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" name="profilePicture" class="form-control" id="profilePicture">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>

        <!-- Image Section with Box Shadow -->
        <div class="col-md-6">
            <div class="imang">
                <img src="views/assets/images/image copy 2.png" alt="Profile Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
