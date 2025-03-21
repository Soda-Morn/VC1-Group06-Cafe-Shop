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
            background-color: #fff; /* Match the white background from the screenshot */
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow: hidden; /* Prevent scrolling, consistent with preview_order.php */
        }

        .checkout-container {
            max-width: 1000px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .checkout-header h2 {
            color: #f5a623;
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .checkout-header p {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        .table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: transparent; /* Remove orange background to match the screenshot */
            color: #000;
        }

        .table th, .table td {
            padding: 10px;
            text-align: center;
            border: none;
        }

        .table tbody tr {
            background-color: #fff;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .quantity-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px; /* Reduced gap for a more compact look */
        }

        .quantity-btn {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 2px 8px; /* Smaller padding for a simpler look */
            font-size: 0.9rem; /* Smaller font size */
            line-height: 1; /* Reduce line height for compactness */
            cursor: pointer;
            border-radius: 3px; /* Slightly rounded corners */
        }

        .quantity-input {
            width: 40px; /* Reduced width to keep it compact */
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 3px;
            padding: 2px;
            font-size: 0.9rem;
        }

        .remove-btn {
            background-color: transparent;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 0.9rem;
            border-radius: 3px;
        }

        .total-and-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Align to the right */
            gap: 10px;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000;
        }

        .total-price span {
            color: #f5a623;
        }

        .btn-add-more {
            background-color: #f5a623; /* Orange to match the screenshot */
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-preview {
            background-color: #28a745; /* Green to match the screenshot */
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="checkout-container w-100">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info">
                    <?= $_SESSION['message'] ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <div class="checkout-header">
                <h2>Checkout</h2>
                <p>Review your items before proceeding.</p>
            </div>

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
                                    <div class="quantity-group">
                                        <button type="button" class="quantity-btn decrease-btn">−</button>
                                        <input type="number" class="quantity-input"
                                            value="<?= $item['quantity'] ?>" min="1"
                                            data-purchase-item-id="<?= $item['purchase_item_id'] ?>">
                                        <button type="button" class="quantity-btn increase-btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <form action="/restock_checkout/removeStock" method="POST" class="d-inline remove-form">
                                        <input type="hidden" name="purchase_item_id" value="<?= $item['purchase_item_id'] ?>">
                                        <button type="submit" class="remove-btn">🗑 Remove</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $total += $item['price'] * $item['quantity']; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="total-and-buttons">
                    <div class="total-price">
                        Total: $<span><?= number_format($total, 2) ?></span>
                    </div>
                    <div>
                        <a href="/purchase_item_add" class="btn btn-add-more">Add More</a>
                        <!-- Hidden inputs for quantities -->
                        <?php foreach ($orderItems as $item): ?>
                            <input type="hidden" name="quantities[<?= $item['purchase_item_id'] ?>]"
                                value="<?= $item['quantity'] ?>" id="quantity-<?= $item['purchase_item_id'] ?>">
                        <?php endforeach; ?>
                        <button type="button" id="previewBtn" class="btn btn-preview">Preview</button>
                    </div>
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

            // Handle quantity increase/decrease
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

            // Handle the Preview button click (AJAX request)
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
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Ensure the server recognizes this as an AJAX request
                    }
                })
                .then(response => {
                    console.log("Response status:", response.status); // Log the response status
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json(); // Parse the JSON response
                })
                .then(data => {
                    console.log("Response data:", data); // Log the response data
                    if (data.status === 'success') {
                        // After saving to the database, redirect to the preview page
                        console.log("Redirecting to /restock_checkout/preview");
                        window.location.href = "/restock_checkout/preview";
                    } else {
                        console.error("Failed to save quantities to the database:", data);
                        alert("Failed to save quantities to the database. Please try again.");
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error); // Log any fetch errors
                    alert("An error occurred while saving the cart. Please try again.");
                });
            });

            // Ensure Remove button forms are not intercepted as AJAX
            document.querySelectorAll(".remove-form").forEach(form => {
                form.addEventListener("submit", function (event) {
                    // Let the form submit naturally (no AJAX)
                    // The server will handle the redirect
                });
            });

            // Update hidden inputs and total on page load
            updateHiddenInputs();
            updateTotal();
        });
    </script>
</body>
</html>