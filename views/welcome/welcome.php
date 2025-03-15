<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Cafe Bliss</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Import modern fonts */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            background: #F3E5AB; /* Fallback background */
            font-family: 'Poppins', sans-serif;
        }
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.8);
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }
        .navbar {
            position: relative;
            z-index: 1;
            padding: 15px;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: #FFF !important;
            transition: color 0.3s ease;
            /* Center the brand */
            display: block;
            text-align: center;
            margin: 0 auto;
        }
        .navbar-brand:hover {
            color: #FF8C00 !important;
        }
        .navbar .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        .navbar .btn-outline-light {
            border-color: #FFF;
            color: #FFF;
        }
        .navbar .btn-outline-light:hover {
            background: #FF8C00;
            border-color: #FF8C00;
            color: #FFF;
        }
        .navbar .btn-dark {
            background: #FF8C00;
            border: none;
            color: #FFF;
        }
        .navbar .btn-dark:hover {
            background: #E07B00;
        }
        .hero-text {
            padding: 50px 0;
            text-align: left;
        }
        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            color: #FFF;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
        }
        .hero-text p {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #EDEDED;
            margin: 0 0 30px 0;
            max-width: 500px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards 0.3s;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .highlight {
            color: #FF8C00;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .start-btn {
            background: linear-gradient(to right, #FF8C00, #D2691E);
            color: #FFF;
            border-radius: 30px;
            padding: 12px 30px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px  #FF8C00;
        }
        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px  #FF8C00;
            background: linear-gradient(to right, #E07B00, #B35712);
        }
        .col-md-6 {
            position: relative;
            z-index: 1;
        }
        /* Button container below text */
        .button-container {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 32px;
            }
            .hero-text p {
                font-size: 14px;
                max-width: 100%;
            }
            .start-btn {
                padding: 10px 20px;
                font-size: 14px;
            }
            .button-container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            .button-container .btn {
                width: fit-content;
            }
        }
    </style>
</head>
<body>
    <!-- Video Background -->
    <video autoplay muted loop class="video-bg">
        <source src="views/assets/images/welcome.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>

    <div class="container mb-3">
        <nav class="navbar navbar-expand-lg py-3">
            <!-- Centered brand name at the top -->
            <a class="navbar-brand fw-bolder mx-2" href="#">Velea Coffee</a>
        </nav>
        <div class="row align-items-center text-start py-5">
            <div class="col-md-6 hero-text">
                <h1>Welcome to <span class="highlight">Velea Coffee</span> <br> Your Perfect Coffee Experience</h1>
                <p>
                    Step into Velea Coffee for rich aromas and exceptional flavors. We source the finest global beans, craft every cup with care, and offer a warm ambiance with delicious pastries. Explore our system to manage orders, reserve seating, or join our dedicated team!
                </p>
                <!-- Buttons moved below the text -->
                <div class="button-container">
                    <a href="/register" class="btn btn-outline-light">Register</a>
                    <a href="/login" class="btn btn-dark">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>