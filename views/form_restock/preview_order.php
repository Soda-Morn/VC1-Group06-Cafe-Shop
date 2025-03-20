<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="bg-white p-4 rounded shadow-lg w-100" style="max-width: 900px;">
            <h1 class="text-warning fw-bold">Preview Order</h1>
            <p class="fw-semibold mt-2">Your selection:</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="border-bottom">
                        <tr>
                            <th class="text-start p-3">IMAGE</th>
                            <th class="text-start p-3">NAME</th>
                            <th class="text-start p-3">PRICE</th>
                            <th class="text-end p-3">QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-end">
                <p class="fs-4 fw-bold">Total Price: <span id="grand-total">$0.00</span></p>
                <div class="mt-3 d-flex flex-column flex-sm-row justify-content-end gap-3">
                    <a href="/purchase_item_add" class="btn btn-warning text-white w-sm-auto">Add More</a>
                    <a href="/stocklist" class="btn btn-success text-white w-sm-auto">Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch cart data from localStorage
            const cartItems = JSON.parse(localStorage.getItem("previewCart")) || [];
            const orderList = document.getElementById("order-list");
            const grandTotalElement = document.getElementById("grand-total");

            let totalPrice = 0;

            if (cartItems.length === 0) {
                // If no items, display a message
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td colspan="4" class="text-center p-3">No items to preview.</td>
                `;
                orderList.appendChild(row);
            } else {
                // Populate the table with cart items
                cartItems.forEach(item => {
                    const row = document.createElement("tr");
                    row.classList.add("border-bottom");
                    row.innerHTML = `
                        <td class="p-2">
                            <img src="${item.product_image}" alt="Product" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td class="p-2">${item.product_name}</td>
                        <td class="p-2">$${item.price.toFixed(2)}</td>
                        <td class="p-2 text-end">
                            <span class="fw-bold">${item.quantity}</span>
                        </td>
                    `;
                    orderList.appendChild(row);

                    // Calculate total price
                    totalPrice += item.price * item.quantity;
                });
            }

            // Update the total price
            grandTotalElement.textContent = `$${totalPrice.toFixed(2)}`;

            // Clear localStorage after rendering to prevent old data from persisting
            localStorage.removeItem("previewCart");
        });
    </script>
</body>
</html>