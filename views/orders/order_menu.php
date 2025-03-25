<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffee Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <style>
        .header {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-new-btn {
            background: #28a745;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 0.9rem;
            padding: 0.375rem 0.75rem;
        }

        .add-new-btn:hover {
            background: #218838;
        }
        .btn-create{
            background: #28a745;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
        }

        /* Custom column width for 5 cards per row with adjusted spacing */
        .col-5-cards {
            width: 20%;
            padding-right: 5px;
            padding-left: 5px;
            margin-bottom: 15px;
        }

        /* Row adjustment to match image spacing */
        .card-row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            height: 92%;
            margin-left: 10px;
            margin-right: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 150px;
            object-fit: contain;
            background-color:rgb(253, 254, 255);
            padding: 5px;
        }
        
        .card-body {
            margin-top: 5px;
        }

        /* Fixed delete button styling */
        .btn-delete {
            background: transparent;
            border: none;
            color: #dc3545; /* Red color */
            font-size: 16px;
            padding: 0;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .btn-delete:hover {
            color: #c82333; /* Darker red on hover */
        }

        .btn {
            background-color: rgb(196, 95, 22);
            border-radius: 6px;
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
            color: white;
            border: none;
        }

        .btn:hover {
            background-color: rgb(175, 85, 20);
        }

        .price-button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
        }

        .card-body {
            padding: 0.75rem;
        }

        .card-title {
            font-size: 0.98rem;
            margin-bottom: 0.10rem;
            font-size: bold;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.3;
        }

        /* Container padding adjustment to match image */
        .container {
            padding-left: 20px;
            padding-right: 20px;
            max-width: 1400px;
        }

        /* Responsive adjustments */
        @media (max-width: 1199.98px) {
            .col-5-cards {
                width: 25%; /* 4 per row on medium screens */
            }
        }

        @media (max-width: 767.98px) {
            .col-5-cards {
                width: 33.333%; /* 3 per row on small screens */
            }
        }

        @media (max-width: 575.98px) {
            .col-5-cards {
                width: 50%; /* 2 per row on extra small screens */
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="header">
            <h2>Coffee Menu</h2>
            <a href="/order_menu/create" class="btn-create add-new-btn">Create Menu</a>
        </div>

        <div class="row card-row">
            <?php foreach ($products as $item): ?>
                <div class="col-5-cards">
                    <div class="card">
                        <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="position-absolute top-0 end-0 m-2">
                            <form action="/order_menu/destroy/<?= htmlspecialchars($item['product_ID']) ?>" method="POST">
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($item['description']) ?></p>
                            <div class="price-button-container">
                                <span class="fw-bold">$<?= number_format($item['price'], 2) ?></span>
                                <form action="/orderCard/addToCart" method="POST">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_ID']) ?>">
                                    <button type="submit" class="btn">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>