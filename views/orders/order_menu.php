<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffee Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Added jQuery for AJAX -->
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

        .btn-create {
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
            position: relative;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 150px;
            object-fit: contain;
            background-color: rgb(253, 254, 255);
            padding: 5px;
        }

        .card-body {
            margin-top: 5px;
            padding: 0.75rem;
        }

        /* Delete button styling (matching the first page) */
        .btn-danger {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s ease;
            z-index: 1;
            background: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: rgba(255, 0, 0, 0.8);
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

        .card-title {
            font-size: 0.98rem;
            margin-bottom: 0.10rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
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

        /* Checkbox styles (from the first page, adapted to fit the second page's design) */
        .select-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
            display: none;
        }

        .card.selected {
            border: 2px solid #28a745;
            background: linear-gradient(145deg, #e6ffe6, #f8f9fa);
        }

        .card.selected .select-checkbox {
            display: block;
        }

        .checkout-btn {
            background: #007bff;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            border: none;
            transition: background 0.3s ease;
            display: none;
        }

        .checkout-btn:hover {
            background: #0056b3;
        }

        .checkout-btn.visible {
            display: inline-block;
        }

        /* Prevent click events on buttons from triggering card selection */
        .btn-danger,
        .btn,
        .add-new-btn,
        .checkout-btn {
            pointer-events: auto;
        }

        /* Adjust the button group spacing to make Order Now and Create Menu appear closer */
        .button-group {
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }

        /* Responsive adjustments */
        @media (max-width: 1199.98px) {
            .col-5-cards {
                width: 25%;
            }
        }

        @media (max-width: 767.98px) {
            .col-5-cards {
                width: 33.333%;
            }
        }

        @media (max-width: 575.98px) {
            .col-5-cards {
                width: 50%;
            }

            .button-group {
                gap: 0.15rem;
            }

            .checkout-btn,
            .btn-create {
                font-size: 0.9rem;
                padding: 0.3rem 0.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="header">
            <h2>Coffee Menu</h2>
            <div class="button-group">
                <button type="submit" form="checkoutForm" class="checkout-btn" id="checkoutBtn">Order Now</button>
                <a href="/order_menu/create" class="btn-create add-new-btn">Create Menu</a>
            </div>
        </div>

        <form id="checkoutForm" action="/orderCard/addMultipleToCart" method="POST">
            <div class="row card-row">
                <?php foreach ($products as $item): ?>
                    <div class="col-5-cards">
                        <div class="card" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">
                            <input type="checkbox" class="select-checkbox" name="selected_products[]" value="<?= htmlspecialchars($item['product_ID']) ?>">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button type="button" class="btn btn-danger btn-sm btn-remove" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
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
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Handle remove button click with AJAX
            $('.btn-remove').click(function(e) {
                e.stopPropagation(); // Prevent the card's click event from triggering

                const productId = $(this).data('product-id');
                const card = $(this).closest('.card');

                // Send AJAX request to delete the product
                $.ajax({
                    url: `/order_menu/destroy/${productId}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            // Remove the card from the UI
                            card.closest('.col-5-cards').remove();

                            // If no cards are left, show a message
                            if ($('.card').length === 0) {
                                $('.card-row').html('<div class="col-12 text-center">No products available.</div>');
                            }

                            // Update the visibility of the "Order Now" button
                            const anyChecked = Array.from(document.querySelectorAll('.select-checkbox')).some(cb => cb.checked);
                            document.getElementById('checkoutBtn').classList.toggle('visible', anyChecked);
                        } else {
                            alert('Failed to delete product: ' + (data.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting product:', {
                            status: status,
                            error: error,
                            responseText: xhr.responseText
                        });
                        alert('An error occurred while deleting the product: ' + (xhr.responseText || error));
                    }
                });
            });

            // Get all cards and the checkout button
            const cards = document.querySelectorAll('.card');
            const checkoutBtn = document.getElementById('checkoutBtn');

            // Add click event listener to each card for multi-select
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Prevent the click event from bubbling up if the target is a button
                    if (e.target.closest('.btn-danger') || e.target.closest('.btn') || e.target.closest('.add-new-btn') || e.target.closest('.checkout-btn')) {
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
        });
    </script>
</body>

</html>