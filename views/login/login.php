<?php require_once 'views/layouts/header.php'; ?>
<section class="h-100 gradient-form" style="background-color: #eee;">
    <!-- Your existing HTML content -->
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6" width="300">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                        style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Welcome, Admin. Empowering the system with your decisions.</h4>
                                </div>
                                <form>
                                    <p>Please login to your account</p>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Email address</label>
                                        <input type="email" id="form2Example11" class="form-control"
                                            placeholder="Phone number or email address" />
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" class="form-control"
                                            placeholder="Password" />
                                    </div>
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Log
                                            in</button>
                                        <a class="text-muted" href="#!">Forgot password?</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Create new</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex align-items-end gradient-custom-2" style="height: 100%;">
                            <div>
                                <img src="views/assets/img/login/image_login.jpg" alt="Login Image" width="500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>