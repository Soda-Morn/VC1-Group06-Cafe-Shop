<?php require_once 'views/layouts/header.php'; ?>
<section class="h-100 gradient-form" style="background-color: #f4f7fc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-8 col-lg-10">
                <div class="card rounded-3 shadow-lg text-black">
                    <div class="row g-0">
                        <!-- Left Column (Login Form) -->
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center mb-4">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" 
                                         style="width: 130px;" alt="logo">
                                    <h4 class="mt-2 mb-3">Welcome Back, Admin</h4>
                                    <p class="text-muted">Sign in to your account</p>
                                </div>
                                <form>
                                    <!-- Email Input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Email Address</label>
                                        <input type="email" id="form2Example11" class="form-control" placeholder="Email address or phone number" required 
                                               style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"/>
                                    </div>
                                    <!-- Password Input -->
                                    <div class="form-outline mb-4 position-relative">
                                        <label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" class="form-control" placeholder="Password" required 
                                               style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"/>
                                        <!-- Eye Icon for toggling password visibility -->
                                        <i class="eye-icon position-absolute" id="togglePassword" style="right: 15px; top: 35%; cursor: pointer;">
                                            <i class="bi bi-eye" style="font-size: 20px; color: #6c757d;"></i>
                                        </i>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <input type="checkbox" id="rememberMe" /> 
                                            <label for="rememberMe" class="text-muted">Remember Me</label>
                                        </div>
                                        <a href="#" class="text-muted">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block w-100 py-3" 
                                                style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); transition: background-color 0.3s ease;">
                                            Log In
                                        </button>
                                    </div>
                                    <div class="text-center mt-4">
                                        <p class="mb-0 text-muted">Don't have an account? 
                                            <a href="#" class="text-primary">Create New</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Right Column (Image) -->
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2" 
                             style="height: 100%; background-color: #2d3e56;">
                            <img src="views/assets/img/login/image_login.jpg" alt="Login Image" class="img-fluid"
                                 style="max-width: 100%; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

