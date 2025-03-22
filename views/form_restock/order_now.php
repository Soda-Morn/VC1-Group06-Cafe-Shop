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
            background-color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow: auto;
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
            width: 100%;
        }

        .table thead {
            background-color: transparent;
            color: #000;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table th, .table td {
            padding: 10px;
            text-align: center;
            border: none;
        }

        .table th:nth-child(1), .table td:nth-child(1) { /* Image column */
            width: 100px;
        }
        .table th:nth-child(2), .table td:nth-child(2) { /* Item column */
            width: 200px;
        }
        .table th:nth-child(3), .table td:nth-child(3) { /* Price column */
            width: 100px;
        }
        .table th:nth-child(4), .table td:nth-child(4) { /* Quantity column */
            width: 150px;
        }
        .table th:nth-child(5), .table td:nth-child(5) { /* Action column */
            width: 100px;
        }

        .table tbody {
            display: block;
            max-height: 400px;
            overflow-y: auto;
        }

        .table tbody::-webkit-scrollbar {
            width: 8px;
        }

        .table tbody::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table tbody::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .table tbody::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .table tbody {
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
        }

        .table thead, .table tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-item img.default-image {
            width: 60px !important;
            height: 60px !important;
            border-radius: 50% !important;
            object-fit: cover;
        }

        .quantity-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .quantity-btn {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 2px 8px;
            font-size: 0.9rem;
            line-height: 1;
            cursor: pointer;
            border-radius: 3px;
        }

        .quantity-input {
            width: 40px;
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
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000;
        }

        .total-price span {
            color: #f5a623;
        }

        .right-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-add-more, .btn-preview, .btn-submit {
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease;
        }

        .btn-add-more {
            background-color: #007bff;
            color: #fff;
        }

        .btn-add-more:hover {
            background-color: #0056b3;
        }

        .btn-preview {
            background-color: #28a745;
            color: #fff;
        }

        .btn-preview:hover {
            background-color: #218838;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        /* Animation for removing items */
        .removing {
            animation: fadeOutSlide 0.5s ease forwards;
        }

        @keyframes fadeOutSlide {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-20px);
                height: 0;
                padding: 0;
                margin: 0;
                border: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="checkout-container w-100">
            <div class="checkout-header">
                <h2>Checkout</h2>
                <p>Review your items before proceeding.</p>
            </div>

            <form id="checkoutForm" action="/restock_checkout/submitOrder" method="POST">
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
                    <tbody id="cart-items">
                        <!-- Items will be populated by JavaScript -->
                    </tbody>
                </table>

                <div class="total-and-buttons">
                    <button type="button" id="addMoreBtn" class="btn btn-add-more">Add More</button>
                    <div class="total-price">
                        Total: $<span id="total-price">0.00</span>
                    </div>
                    <div class="right-buttons">
                        <button type="button" id="previewBtn" class="btn btn-preview">Preview</button>
                        <button type="submit" id="submitBtn" class="btn btn-submit">Submit</button>
                    </div>
                    <!-- Hidden inputs for quantities will be populated by JavaScript -->
                    <div id="hidden-inputs"></div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Store purchase items data for JavaScript to use
        const purchaseItems = <?= json_encode($purchaseItems) ?>;
        const defaultImage = "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9InVybCgjZ3JhZGllbnQpIi8+CjxwYXRoIGQ9Ik0yMiAyM0gzOE0yMiAyM0MyMiAyMS4zNDMgMjMuMzQzIDIwIDI1IDIwSDM1QzM2LjY1NyAyMCAzOCAyMS4zNDMgMzggMjNMMzggMzdIMjJMMjIgMjNabTExIDEwSDI3VjI3SDMzVjMzWiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjIiLz4KPHRleHQgeD0iMTUiIHk9IjUwIiBmaWxsPSIjRkZGRkZGIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iOCIgZm9udC13ZWlnaHQ9IjUwMCI+Tm8gSW1hZ2U8L3RleHQ+CjxkZWZzPgo8bGluZWFyR3JhZGllbnQgaWQ9ImdyYWRpZW50IiB4MT0iMCIgeTE9IjAiIHgyPSI2MCIgeTI9IjYwIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzc3Q0ZGRiIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM0NUI5RjUiLz4KPC9saW5lYXJHcmFkaWVudD4KPC9kZWZzPgo8L3N2Zz4=";

        // Initial server-side cart data
        const serverCartItems = <?= json_encode($orderItems) ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const cartItemsContainer = document.getElementById("cart-items");
            const hiddenInputsContainer = document.getElementById("hidden-inputs");
            const checkoutForm = document.getElementById("checkoutForm");

            // Function to save cart to localStorage
            const saveCartToLocalStorage = () => {
                const cartItems = [];
                document.querySelectorAll(".cart-item").forEach(row => {
                    const item = {
                        product_image: row.querySelector("td:nth-child(1) img").src,
                        product_name: row.querySelector("td:nth-child(2)").textContent,
                        price: parseFloat(row.querySelector(".item-price").textContent),
                        quantity: parseInt(row.querySelector(".quantity-input").value),
                        purchase_item_id: row.getAttribute("data-purchase-item-id")
                    };
                    cartItems.push(item);
                });
                localStorage.setItem("previewCart", JSON.stringify(cartItems));
            };

            // Function to update total and save to localStorage
            const updateTotal = () => {
                let total = 0;
                document.querySelectorAll(".cart-item").forEach(row => {
                    const price = parseFloat(row.querySelector(".item-price").textContent);
                    const quantity = parseInt(row.querySelector(".quantity-input").value);
                    total += price * quantity;
                });
                document.querySelector("#total-price").textContent = total.toFixed(2);
                saveCartToLocalStorage();
            };

            // Function to update hidden inputs for form submission
            const updateHiddenInputs = () => {
                hiddenInputsContainer.innerHTML = "";
                document.querySelectorAll(".cart-item").forEach(row => {
                    const purchaseItemId = row.getAttribute("data-purchase-item-id");
                    const quantity = row.querySelector(".quantity-input").value;
                    if (!purchaseItemId.startsWith("new-")) {
                        const hiddenInput = document.createElement("input");
                        hiddenInput.type = "hidden";
                        hiddenInput.name = `quantities[${purchaseItemId}]`;
                        hiddenInput.id = `quantity-${purchaseItemId}`;
                        hiddenInput.value = quantity;
                        hiddenInputsContainer.appendChild(hiddenInput);
                    }
                });
            };

            // Function to create a cart item row
            const createCartItemRow = (item) => {
                const row = document.createElement("tr");
                row.classList.add("cart-item");
                row.setAttribute("data-purchase-item-id", item.purchase_item_id);
                row.innerHTML = `
                    <td><img src="${item.product_image}" alt="${item.product_name}" class="img-fluid"></td>
                    <td>${item.product_name}</td>
                    <td>$<span class="item-price">${item.price.toFixed(2)}</span></td>
                    <td>
                        <div class="quantity-group">
                            <button type="button" class="quantity-btn decrease-btn">−</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-purchase-item-id="${item.purchase_item_id}">
                            <button type="button" class="quantity-btn increase-btn">+</button>
                        </div>
                    </td>
                    <td>
                        ${item.purchase_item_id.startsWith("new-") ? 
                            `<button type="button" class="remove-btn" data-id="${item.purchase_item_id}">🗑 Remove</button>` :
                            `<button type="button" class="remove-btn" data-id="${item.purchase_item_id}">🗑 Remove</button>`
                        }
                    </td>
                `;
                return row;
            };

            // Function to handle quantity increase/decrease
            const setupQuantityButtons = (row) => {
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
            };

            // Function to remove an item with animation
            const removeItemWithAnimation = (row, callback) => {
                row.classList.add("removing");
                row.addEventListener("animationend", () => {
                    row.remove();
                    if (callback) callback();
                });
            };

            // Load cart items from localStorage or server
            const loadCartItems = () => {
                const localCart = JSON.parse(localStorage.getItem("previewCart"));
                const initialItems = localCart || serverCartItems;

                cartItemsContainer.innerHTML = "";
                let total = 0;

                initialItems.forEach(item => {
                    const row = createCartItemRow(item);
                    cartItemsContainer.appendChild(row);
                    setupQuantityButtons(row);
                    total += item.price * item.quantity;

                    // Attach remove event listener to the button
                    const removeBtn = row.querySelector(".remove-btn");
                    removeBtn.addEventListener("click", () => {
                        const purchaseItemId = row.getAttribute("data-purchase-item-id");
                        if (purchaseItemId.startsWith("new-")) {
                            // Client-side removal with animation
                            removeItemWithAnimation(row, () => {
                                updateTotal();
                                updateHiddenInputs();
                            });
                        } else {
                            // Server-side removal with AJAX
                            $.ajax({
                                url: "/restock_checkout/removeStock",
                                method: "POST",
                                data: { purchase_item_id: purchaseItemId },
                                success: function () {
                                    removeItemWithAnimation(row, () => {
                                        updateTotal();
                                        updateHiddenInputs();
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error("Failed to remove item:", error);
                                }
                            });
                        }
                    });
                });

                document.querySelector("#total-price").textContent = total.toFixed(2);
                updateHiddenInputs();
            };

            // Handle Add More button
            document.getElementById("addMoreBtn").addEventListener("click", () => {
                const newRow = document.createElement("tr");
                newRow.classList.add("cart-item");
                const tempId = "new-" + Date.now();
                newRow.setAttribute("data-purchase-item-id", tempId);

                newRow.innerHTML = `
                    <td><img src="${defaultImage}" alt="No image" class="img-fluid default-image"></td>
                    <td>
                        <select class="product-select">
                            <option value="" disabled selected>Select a product</option>
                            ${purchaseItems.map(item => `
                                <option value="${item.purchase_item_id}" 
                                        data-image="${item.product_image}" 
                                        data-name="${item.product_name}" 
                                        data-price="${item.price}">
                                    ${item.product_name}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td>$<span class="item-price">0.00</span></td>
                    <td>
                        <div class="quantity-group">
                            <button type="button" class="quantity-btn decrease-btn">−</button>
                            <input type="number" class="quantity-input" value="0" min="1" data-purchase-item-id="${tempId}">
                            <button type="button" class="quantity-btn increase-btn">+</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="remove-btn" data-id="${tempId}">🗑 Remove</button>
                    </td>
                `;

                cartItemsContainer.appendChild(newRow);
                setupQuantityButtons(newRow);

                const select = newRow.querySelector(".product-select");
                select.addEventListener("change", () => {
                    const selectedOption = select.options[select.selectedIndex];
                    const purchaseItemId = selectedOption.value;
                    const image = selectedOption.getAttribute("data-image");
                    const name = selectedOption.getAttribute("data-name");
                    const price = parseFloat(selectedOption.getAttribute("data-price"));

                    newRow.setAttribute("data-purchase-item-id", purchaseItemId);
                    const imgElement = newRow.querySelector("td:nth-child(1) img");
                    imgElement.src = image;
                    imgElement.classList.remove("default-image");
                    newRow.querySelector("td:nth-child(2)").innerHTML = name;
                    newRow.querySelector(".item-price").textContent = price.toFixed(2);
                    const quantityInput = newRow.querySelector(".quantity-input");
                    quantityInput.value = 1;
                    quantityInput.setAttribute("data-purchase-item-id", purchaseItemId);

                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = `quantities[${purchaseItemId}]`;
                    hiddenInput.id = `quantity-${purchaseItemId}`;
                    hiddenInput.value = 1;
                    hiddenInputsContainer.appendChild(hiddenInput);

                    // Update the remove button's data-id
                    const removeBtn = newRow.querySelector(".remove-btn");
                    removeBtn.setAttribute("data-id", purchaseItemId);

                    updateTotal();
                    updateHiddenInputs();
                });

                const removeBtn = newRow.querySelector(".remove-btn");
                removeBtn.addEventListener("click", () => {
                    removeItemWithAnimation(newRow, () => {
                        updateTotal();
                        updateHiddenInputs();
                    });
                });

                updateTotal();
            });

            // Handle Preview button click
            document.getElementById("previewBtn").addEventListener("click", function () {
                updateHiddenInputs();
                saveCartToLocalStorage();
                window.location.href = "/restock_checkout/preview";
            });

            // Handle form submission with AJAX to clear localStorage
            checkoutForm.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                updateHiddenInputs(); // Ensure hidden inputs are up-to-date
                const formData = new FormData(checkoutForm);

                $.ajax({
                    url: "/restock_checkout/submitOrder",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Clear localStorage after successful submission
                        localStorage.removeItem("previewCart");

                        // Clear the cart UI
                        cartItemsContainer.innerHTML = "";
                        document.querySelector("#total-price").textContent = "0.00";
                        updateHiddenInputs();

                        // Optionally, redirect to the checkout page to refresh server-side state
                        window.location.href = "/restock_checkout";
                    },
                    error: function (xhr, status, error) {
                        console.error("Failed to submit order:", error);
                        // Optionally handle the error (e.g., show a message to the user)
                    }
                });
            });


        });
    </script>
</body>
</html>