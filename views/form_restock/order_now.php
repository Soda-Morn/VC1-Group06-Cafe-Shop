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

        .quantity-btn {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
        }

        .remove-btn {
            background-color: transparent;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="checkout-container w-100">
            <h2 class="text-center text-warning fw-bold">Checkout</h2>
            <p class="text-center fw-semibold">Review your items before proceeding.</p>

            <form id="checkoutForm" action="/restock_checkout/saveStockList" method="POST">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>IMAGE</th>
                            <th>ITEM</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($orderItems as $item): ?>
                            <tr class="cart-item">
                                <td><img src="<?= $item['product_image'] ?>" alt="<?= $item['product_name'] ?>"
                                        class="img-fluid"></td>
                                <td><?= $item['product_name'] ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>
                                    <div class="input-group w-auto justify-content-center">
                                        <button type="button" class="quantity-btn decrease-btn">−</button>
                                        <input type="number" class="form-control quantity-input"
                                            value="<?= $item['quantity'] ?>" min="1"
                                            data-purchase-item-id="<?= $item['purchase_item_id'] ?>">
                                        <button type="button" class="quantity-btn increase-btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <form action="/restock_checkout/removeStock" method="POST" class="d-inline">
                                        <input type="hidden" name="purchase_item_id" value="<?= $item['purchase_item_id'] ?>">
                                        <button type="submit" class="remove-btn">🗑 Remove</button>
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

                <div class="text-end mt-4">
                    <a href="/purchase_item_add" class="btn btn-warning text-white">Add More</a>
                    <!-- Hidden inputs for quantities -->
                    <?php foreach ($orderItems as $item): ?>
                        <input type="hidden" name="quantities[<?= $item['purchase_item_id'] ?>]"
                            value="<?= $item['quantity'] ?>" id="quantity-<?= $item['purchase_item_id'] ?>">
                    <?php endforeach; ?>
                    <button type="button" id="previewBtn" class="btn btn-success">Preview</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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

            const saveCartToLocalStorage = () => {
                const cartItems = [];
                document.querySelectorAll(".cart-item").forEach(row => {
                    const item = {
                        product_image: row.querySelector("td:nth-child(1) img").src,
                        product_name: row.querySelector("td:nth-child(2)").textContent,
                        price: parseFloat(row.querySelector("td:nth-child(3)").textContent.replace("$", "")),
                        quantity: parseInt(row.querySelector(".quantity-input").value)
                    };
                    cartItems.push(item);
                });
                localStorage.setItem("previewCart", JSON.stringify(cartItems));
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

            // Handle the Preview button click
            document.getElementById("previewBtn").addEventListener("click", function () {
                // Update hidden inputs with the latest quantities
                updateHiddenInputs();

                // Save the current cart to localStorage
                saveCartToLocalStorage();

                // Submit the form to save the quantities to the database using AJAX
                const form = document.getElementById("checkoutForm");
                const formData = new FormData(form);

                fetch(form.action, {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // After saving to the database, redirect to the preview page
                        window.location.href = "/restock_checkout/preview";
                    } else {
                        console.error("Failed to save quantities to the database");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });

            // Update hidden inputs and total on page load
            updateHiddenInputs();
            updateTotal();
        });
    </script>
</body>
</html>