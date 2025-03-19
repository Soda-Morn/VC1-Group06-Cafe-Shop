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
            margin-top: 20px;
            max-width: 1000px;
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
                    <?php foreach ($orderItems as $item): ?>
                        <tr class="cart-item">
                            <td><img src="<?= $item['product_image'] ?>" alt="<?= $item['product_name'] ?>" class="img-fluid"></td>
                            <td><?= $item['product_name'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>
                                <div class="input-group w-auto justify-content-center">
                                    <button type="button" class="btn btn-warning decrease-btn">−</button>
                                    <input type="number" class="form-control text-center quantity-input"
                                        value="<?= $item['quantity'] ?>" min="1"
                                        data-purchase-item-id="<?= $item['purchase_item_id'] ?>">
                                    <button type="button" class="btn btn-warning increase-btn">+</button>
                                </div>
                            </td>
                            <td>
                                <form action="/restock_checkout/removeStock" method="POST">
                                    <input type="hidden" name="purchase_item_id" value="<?= $item['purchase_item_id'] ?>">
                                    <button type="submit" class="btn-remove">🗑 Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-price text-end fw-bold">
                Total: $<span><?= number_format($total, 2) ?></span>
            </div>

            <div class="text-center mt-4">
                <a href="/purchase_item_add" class="btn btn-outline-warning">Add More</a>
                <form id="previewForm" action="/restock_checkout/saveStockList" method="POST">
                    <!-- Hidden input to store updated quantities -->
                    <?php foreach ($orderItems as $item): ?>
                        <input type="hidden" name="quantities[<?= $item['purchase_item_id'] ?>]"
                            value="<?= $item['quantity'] ?>" id="quantity-<?= $item['purchase_item_id'] ?>">
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-success">Preview</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const updateTotal = () => {
            let total = 0;
            document.querySelectorAll(".cart-item").forEach(row => {
                const price = parseFloat(row.querySelector("td:nth-child(3)").textContent.replace("$", ""));
                const quantity = parseInt(row.querySelector(".quantity-input").value);
                total += price * quantity;
            });
            document.querySelector(".total-price span").textContent = total.toFixed(2);
        };

        const updateHiddenInputs = () => {
            document.querySelectorAll(".quantity-input").forEach(input => {
                const purchaseItemId = input.getAttribute("data-purchase-item-id");
                const hiddenInput = document.querySelector(`#quantity-${purchaseItemId}`);
                hiddenInput.value = input.value;
            });
        };

        document.querySelectorAll(".cart-item").forEach(row => {
            const input = row.querySelector(".quantity-input");
            const increaseBtn = row.querySelector(".increase-btn");
            const decreaseBtn = row.querySelector(".decrease-btn");

            increaseBtn.addEventListener("click", () => {
                input.value = parseInt(input.value) + 1;
                updateTotal();
                updateHiddenInputs();
            });

            decreaseBtn.addEventListener("click", () => {
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateTotal();
                    updateHiddenInputs();
                }
            });

            input.addEventListener("change", () => {
                if (parseInt(input.value) < 1 || isNaN(input.value)) {
                    input.value = 1;
                }
                updateTotal();
                updateHiddenInputs();
            });
        });

        // Update hidden inputs and total on page load
        updateHiddenInputs();
        updateTotal();
    });
</script>