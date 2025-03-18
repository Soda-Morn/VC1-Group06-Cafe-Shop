<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .checkout-container {
            max-width: 900px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-controls button {
            border: none;
            width: 35px;
            height: 35px;
            font-size: 1.2rem;
            cursor: pointer;
            background: #ffc107;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }

        .quantity-controls button:hover {
            background: #e0a800;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
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
    <div class="container mt-5 d-flex justify-content-center">
        <div class="checkout-container w-100">
            <h2 class="text-center text-warning fw-bold">Checkout</h2>
            <p class="text-center fw-semibold">Review your items before proceeding.</p>
            
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php if (!empty($orderItems)): ?>
                        <?php foreach ($orderItems as $purchase): ?>
                            <tr class="cart-item" data-id="<?= $purchase['purchase_item_id'] ?>">
                                <td><img src="<?= $purchase['product_image'] ?>" alt="<?= $purchase['product_name'] ?>" class="img-fluid"></td>
                                <td><?= $purchase['product_name'] ?></td>
                                <td class="item-price">$<?= number_format($purchase['price'], 2) ?></td>
                                <td class="quantity-controls">
                                    <button class="btn-decrease">−</button>
                                    <input type="number" class="quantity-input" value="<?= $purchase['quantity'] ?>" min="1">
                                    <button class="btn-increase">+</button>
                                </td>
                                <td>
                                    <form action="/restock_checkout/removeStock" method="POST">
                                        <input type="hidden" name="purchase_item_id" value="<?= $purchase['purchase_item_id'] ?>">
                                        <button type="submit" class="btn-remove">🗑 Remove</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $total += $purchase['price'] * $purchase['quantity']; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No items in cart.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div class="total-price">
                Total: $<span id="total-price"><?= number_format($total, 2) ?></span>
            </div>
            
            <div class="text-center mt-4">
                <a href="/purchase_item_add" class="btn btn-outline-warning">Add More</a>
                <a href="/checkout" class="btn btn-success">Proceed to Payment</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function updateCartTotal() {
                let total = 0;
                $(".cart-item").each(function() {
                    let price = parseFloat($(this).find(".item-price").text().replace("$", ""));
                    let quantity = parseInt($(this).find(".quantity-input").val());
                    total += price * quantity;
                });
                $("#total-price").text(total.toFixed(2));
            }
            
            $(".btn-increase").click(function() {
                let input = $(this).siblings(".quantity-input");
                input.val(parseInt(input.val()) + 1);
                updateCartTotal();
            });

            $(".btn-decrease").click(function() {
                let input = $(this).siblings(".quantity-input");
                let newValue = Math.max(1, parseInt(input.val()) - 1);
                input.val(newValue);
                updateCartTotal();
            });

            $(".quantity-input").on("change", function() {
                if ($(this).val() < 1) $(this).val(1);
                updateCartTotal();
            });
        });
    </script>
</body>

</html>
