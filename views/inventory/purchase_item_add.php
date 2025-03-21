<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .add-new-btn {
            background: #28a745;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
            transition: background 0.3s ease;
        }

        .add-new-btn:hover {
            background: #218838;
        }

        .add-new-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 5%;
        }

        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px; /* Adjusted height */
            object-fit: cover; /* Full display */
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .btn-danger {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            padding: 5px;
            border-radius: 50%;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background: rgba(255, 0, 0, 1);
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .price-button-container {
            display: flex; /* Align price and button in a row */
            justify-content: space-between; /* Space them out */
            align-items: center; /* Center vertically */
            margin-top: auto; /* Push it to the bottom of the card */
        }

        .card-title {
            font-size: 18px;
            margin: 10px 0;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            margin-bottom: 10px;
            color: #666;
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #00a8ff);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            transition: background 0.3s ease;
            margin-left: 10px; /* Space between price and button */
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .add-new-container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-top: 15%;
            }

            .add-new-btn {
                margin-top: 0;
                width: auto;
                font-size: 0.9rem;
            }

            .row > div {
                flex: 1 0 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Coffee Menu Section -->
            <div class="col-md-12 p-4 bg-light">
                <div class="add-new-container">
                    <h2 class="text-uppercase fw-bold mb-0">Coffee Menu</h2>
                    <a href="/order_menu/create" class="text-white add-new-btn">Add new</a>
                </div>
                <div class="row">
                    <?php foreach ($products as $item): ?>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100 text-center position-relative">
                                <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="card-body">
                                    <h4 class="card-title mb-1"><?= htmlspecialchars($item['name']) ?></h4>
                                    <p class="card-text mb-1"><?= htmlspecialchars($item['description']) ?></p>
                                    <div class="price-button-container">
                                        <span class="fw-bold">$<?= number_format($item['price'], 2) ?></span>
                                        <form action="/orderCard/addToCart" method="POST" class="d-inline">
                                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_ID']) ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>