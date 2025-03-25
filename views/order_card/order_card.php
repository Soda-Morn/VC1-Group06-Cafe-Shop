<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-container {
            width: 78%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .quantity-controls button {
            border: none;
            width: 30px;
            height: 30px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            font-size: 1rem;
            border: none;
            outline: none;
        }

        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-remove:hover {
            background: #c82333;
        }
    </style>
</head>

<body>
    <div class="container mt-9">
        <div class="cart-container">
            <h2 class="text-center">🛒 Your Cart</h2>
            <p class="text-center"><strong>Review your selection:</strong></p>

            <form id="checkout-form" action="/orderCard/checkout" method="POST">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        <?php $total = 0; ?>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $index => $item): ?>
                                <tr class="text-center cart-item" data-product-id="<?= $item['product_ID'] ?>">
                                    <td><img src="<?= isset($item['image']) ? $item['image'] : 'default_image.png' ?>"
                                            alt="<?= isset($item['name']) ? $item['name'] : 'N/A' ?>" class="img-fluid"></td>
                                    <td><?= isset($item['name']) ? $item['name'] : 'N/A' ?></td>
                                    <td class="item-price">$<?= isset($item['price']) ? $item['price'] : '0.00' ?></td>
                                    <td class="quantity-controls">
                                        <button type="button" class="btn-decrease">−</button>
                                        <input type="number" name="cart[<?= $index ?>][quantity]" class="quantity-input"
                                            value="<?= isset($item['quantity']) ? $item['quantity'] : '1' ?>" min="1">
                                        <input type="hidden" name="cart[<?= $index ?>][product_id]" value="<?= $item['product_ID'] ?>">
                                        <button type="button" class="btn-increase">+</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-remove" data-product-id="<?= $item['product_ID'] ?>">🗑 Remove</button>
                                    </td>
                                </tr>
                                <?php $total += (isset($item['price']) ? $item['price'] : 0) * (isset($item['quantity']) ? $item['quantity'] : 1); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No items in cart.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="total-price">
                    <span>Total Price: $<span id="total-price"><?= $total ?></span></span>
                </div>

                <div class="text-right mt-4">
                    <a href="/order_menu" class="btn btn-warning"><i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        Add More</a>
                    <button type="submit" class="btn btn-primary ml-2">✅ Checkout</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Function to update the total price
            function updateTotal() {
                let total = 0;
                $('.cart-item').each(function () {
                    let price = parseFloat($(this).find('.item-price').text().replace('$', ''));
                    let quantity = parseInt($(this).find('.quantity-input').val());
                    total += price * quantity;
                });
                $('#total-price').text(total.toFixed(2));
            }

            // Handle quantity increase
            $('.btn-increase').click(function () {
                let input = $(this).siblings('.quantity-input');
                let newValue = parseInt(input.val()) + 1;
                input.val(newValue);
                updateTotal();
            });

            // Handle quantity decrease
            $('.btn-decrease').click(function () {
                let input = $(this).siblings('.quantity-input');
                let newValue = Math.max(1, parseInt(input.val()) - 1);
                input.val(newValue);
                updateTotal();
            });

            // Handle manual quantity input
            $('.quantity-input').on('change', function () {
                let value = parseInt($(this).val());
                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }
                updateTotal();
            });

            // Handle remove button click with AJAX
            $('.btn-remove').click(function () {
                const productId = $(this).data('product-id');
                const row = $(this).closest('tr');

                // Send AJAX request to remove the item
                $.ajax({
                    url: '/orderCard/removeFromCart',
                    type: 'POST',
                    data: { product_id: productId },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            row.remove(); // Remove the row from the UI
                            updateTotal(); // Update the total price
                            if ($('#cartItems .cart-item').length === 0) {
                                $('#cartItems').html('<tr><td colspan="5" class="text-center">No items in cart.</td></tr>');
                            }
                        } else {
                            alert('Failed to remove item: ' + (data.message || 'Unknown error'));
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error removing item:', error);
                        alert('An error occurred while removing the item');
                    }
                });
            });
        });
    </script>

</body>

</html>