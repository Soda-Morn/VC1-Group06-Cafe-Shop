<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .add-new-btn {
            background: #28a745;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            width: auto;
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

        /* Position the Order Now button to the left of Add Product */
        .button-group {
            display: flex;
            gap: 10px;
            /* Space between the buttons */
            align-items: center;
        }

        /* Card styles */
        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            cursor: pointer;
            /* Indicate the card is clickable */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .btn-danger {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s ease;
            z-index: 1;
        }

        .btn-danger:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .card-body {
            padding: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .price-button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
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
            margin-left: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
        }

        /* Checkbox styles */
        .select-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
            display: none;
            /* Hidden by default */
        }

        .card.selected {
            border: 2px solid #28a745;
            background: linear-gradient(145deg, #e6ffe6, #f8f9fa);
        }

        .card.selected .select-checkbox {
            display: block;
            /* Show checkbox when card is selected */
        }

        .checkout-btn {
            background: #007bff;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            transition: background 0.3s ease;
            display: none;
            /* Hidden by default */
        }

        .checkout-btn:hover {
            background: #0056b3;
        }

        .checkout-btn.visible {
            display: block;
        }

        /* Prevent click events on buttons from triggering card selection */
        .btn-danger,
        .btn-primary,
        .add-new-btn,
        .checkout-btn {
            pointer-events: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .add-new-container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-top: 15%;
            }

            .add-new-btn,
            .checkout-btn {
                width: auto;
                font-size: 0.9rem;
            }

            .button-group {
                gap: 5px;
            }

            .row>div {
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
                    <div class="button-group">
                        <button type="submit" form="checkoutForm" class="checkout-btn" id="checkoutBtn">Order Now</button>
                        <a href="/order_menu/create" class="text-white add-new-btn">Add Product</a>
                    </div>
                </div>
                <form id="checkoutForm" action="/orderCard/addMultipleToCart" method="POST">
                    <div class="row">
                        <?php foreach ($products as $item): ?>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card h-100 text-center position-relative">
                                    <input type="checkbox" class="select-checkbox" name="selected_products[]" value="<?= htmlspecialchars($item['product_ID']) ?>">
                                    <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                                    <!-- Delete Icon -->
                                    <form action="/order_menu/destroy/<?= htmlspecialchars($item['product_ID']) ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get all cards and the checkout button
        const cards = document.querySelectorAll('.card');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // Add click event listener to each card
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Prevent the click event from bubbling up if the target is a button
                if (e.target.closest('.btn-danger') || e.target.closest('.btn-primary') || e.target.closest('.add-new-btn') || e.target.closest('.checkout-btn')) {
                    return; // Do nothing if clicking on buttons
                }

                const checkbox = this.querySelector('.select-checkbox');

                // Toggle the checkbox state
                checkbox.checked = !checkbox.checked;

                // Toggle the 'selected' class based on checkbox state
                if (checkbox.checked) {
                    this.classList.add('selected');
                } else {
                    this.classList.remove('selected');
                }

                // Show or hide the checkout button based on selection
                const anyChecked = Array.from(document.querySelectorAll('.select-checkbox')).some(cb => cb.checked);
                checkoutBtn.classList.toggle('visible', anyChecked);
            });
        });
    </script>
</body>

</html>