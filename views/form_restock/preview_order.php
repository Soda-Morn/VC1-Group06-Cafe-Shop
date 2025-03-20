<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
        }

        .preview-container {
            max-width: 1000px;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .preview-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .preview-header h2 {
            color: #f5a623;
            font-weight: bold;
            font-size: 2rem; /* Match the larger font size from the screenshot */
            margin-bottom: 10px;
        }

        .preview-header p {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        .table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: #f5a623;
            color: #fff;
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

        .total-and-button {
            display: flex;
            flex-direction: column; /* Stack total and button vertically */
            align-items: flex-end; /* Align to the right */
            gap: 10px; /* Space between total and button */
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000;
        }

        .total-price span {
            color: #f5a623;
        }

        .btn-confirm {
            background-color: #28a745; /* Match the green color from the screenshot */
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600; /* Match the bold text */
            text-transform: uppercase; /* Match the uppercase text */
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="preview-container w-100">
            <div class="preview-header">
                <h2>Preview</h2>
                <p>Review your order before finalizing.</p>
            </div>

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody id="previewItems">
                    <!-- Items will be populated by JavaScript -->
                </tbody>
            </table>

            <div class="total-and-button">
                <div class="total-price">
                    TOTAL: $<span id="previewTotal">0.00</span>
                </div>
                <button type="button" id="confirmBtn" class="btn btn-confirm">Confirm Order</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Load cart items from localStorage
            const cartItems = JSON.parse(localStorage.getItem("previewCart")) || [];
            const previewItems = document.getElementById("previewItems");
            const previewTotal = document.getElementById("previewTotal");

            let total = 0;

            // Populate the table with cart items
            cartItems.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                const row = document.createElement("tr");
                row.classList.add("cart-item");
                row.innerHTML = `
                    <td><img src="${item.product_image}" alt="${item.product_name}" class="img-fluid"></td>
                    <td>${item.product_name}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>$${subtotal.toFixed(2)}</td>
                `;
                previewItems.appendChild(row);
            });

            // Update the total
            previewTotal.textContent = total.toFixed(2);

            // Handle the Confirm Order button
            document.getElementById("confirmBtn").addEventListener("click", function () {
                localStorage.removeItem("previewCart");
                window.location.href = "/stocklist";
            });
        });
    </script>
</body>
</html>