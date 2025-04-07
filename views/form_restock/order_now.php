
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow-x: hidden;
        }

        /* Container styles */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .checkout-container {
            max-width: 1000px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            position: relative;
            /* Added for back button positioning */
        }

        /* Header styles */
        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
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

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: transparent;
            color: #000;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
            border: none;
        }

        .table tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Cart item styles */
        .cart-item img {
            width: 60px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .placeholder-image {
            width: 70px;
            height: 90px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin: 0 auto;
        }

        /* Quantity controls */
        .quantity-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .quantity-btn {
            background-color: rgb(183, 90, 23);
            color: #fff;
            border: none;
            border-radius: 2px;
            padding: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quantity-btn:hover {
            background-color: rgb(220, 120, 23);
        }

        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #555;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.2s ease;
            z-index: 10;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
        }

        .btn-back:hover {
            color: #f5a623;
            transform: translateX(-3px);
            background-color: rgba(245, 166, 35, 0.1);
        }

        .btn-back svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 3px;
            padding: 2px;
            font-size: 0.9rem;
        }

        /* Action buttons */
        .remove-btn {
            background-color: #e53935;
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 0.8rem;
            border-radius: 4px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.2s ease;
        }

        .remove-btn:hover {
            background-color: #c62828;
        }

        .btn-add-more {
            margin-right: 600px;
        }

        /* Product select */
        .product-select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            font-size: 0.9rem;
        }

        /* Footer area */
        .checkout-footer {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        @media (min-width: 640px) {
            .checkout-footer {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-end;
            }
        }

        .total-and-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
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

        .button-group {
            margin-bottom: 20px;
            /* Space below the button */
            text-align: left;
            /* Align to the left */
        }

        .btn-back {
            background-color: transparent;
            /* No background */
            color: #555;
            /* Text color */
            text-decoration: none;
            /* Remove underline */
            font-size: 1rem;
            /* Font size */
            display: flex;
            /* Align icon and text */
            align-items: center;
            /* Center vertically */
        }

        .btn-back svg {
            margin-right: 5px;
            /* Space between icon and text */
            width: 24px;
            /* Icon size */
            height: 24px;
            /* Icon size */
        }

        /* Buttons */
        .btn {
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-add-more {
            background-color: rgb(183, 90, 23);
            color: #fff;
        }

        .btn-add-more:hover {
            background-color: rgb(220, 120, 23);
        }

        .btn-preview {
            background-color: rgb(183, 90, 23);
            color: #fff;
        }

        .btn-preview:hover {
            background-color: rgb(220, 120, 23);
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #0069d9;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .btn-add-more {
                margin-right: 0;
            }

            .button-group {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 768px) {
            .checkout-header h2 {
                font-size: 1.5rem;
            }

            .table th,
            .table td {
                padding: 8px 5px;
                font-size: 0.9rem;
            }

            .quantity-btn {
                width: 22px;
                height: 22px;
            }

            .quantity-input {
                width: 35px;
            }

            .btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }

            .checkout-footer {
                flex-direction: column;
            }

            .total-and-buttons {
                width: 100%;
            }

            .button-group {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .checkout-container {
                padding: 15px;
                box-shadow: none;
                border-radius: 0;
            }

            .checkout-header h2 {
                font-size: 1.3rem;
            }

            .checkout-header p {
                font-size: 0.9rem;
            }

            .table th,
            .table td {
                padding: 6px 3px;
                font-size: 0.8rem;
            }

            .table th:nth-child(1),
            .table td:nth-child(1) {
                width: 50px;
            }

            .cart-item img,
            .placeholder-image {
                width: 40px;
                height: 40px;
            }

            .remove-btn {
                padding: 4px 8px;
                font-size: 0.7rem;
            }

            .total-price {
                font-size: 1rem;
            }

            .button-group {
                flex-wrap: wrap;
                gap: 8px;
            }

            .btn {
                padding: 5px 10px;
                font-size: 0.75rem;
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .checkout-container {
                padding: 10px;
            }

            .table th:nth-child(5),
            .table td:nth-child(5) {
                width: 70px;
            }

            .quantity-group {
                gap: 2px;
            }

            .quantity-btn {
                width: 20px;
                height: 20px;
            }

            .quantity-input {
                width: 30px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 360px) {
            .table {
                font-size: 0.7rem;
            }

            .table th,
            .table td {
                padding: 4px 2px;
            }

            .cart-item img,
            .placeholder-image {
                width: 35px;
                height: 35px;
            }

            .quantity-btn {
                width: 18px;
                height: 18px;
                font-size: 0.8rem;
            }

            .quantity-input {
                width: 25px;
                font-size: 0.7rem;
            }

            .remove-btn {
                padding: 3px 6px;
                font-size: 0.65rem;
            }

            .remove-btn::before {
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="container d-flex justify-content-center">
        <div class="checkout-container w-100">
            <!-- Back button inside the card, clears cart before redirecting -->
            <a href="/restock_checkout/clearCartAndRedirect" class="btn-back">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>

            <div class="checkout-header">
                <h2>Checkout</h2>
                <p>Review your items before proceeding.</p>
            </div>

            <form action="/restock_checkout/submit" method="POST">
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
                    <tbody id="cartItems">
                        <?php
                        $total = 0;
                        if (!empty($orderItems)) {
                            foreach ($orderItems as $item):
                                if (!isset($item['purchase_item_id'])) {
                                    error_log("Missing purchase_item_id for item: " . print_r($item, true));
                                    continue;
                                }
                        ?>
                                <tr class="cart-item" data-item-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                    <td>
                                        <img src="<?= htmlspecialchars($item['product_image'] ?? '') ?>"
                                            alt="<?= htmlspecialchars($item['product_name'] ?? 'No image') ?>"
                                            class="img-fluid">
                                    </td>
                                    <td><?= htmlspecialchars($item['product_name'] ?? 'Unknown') ?></td>
                                    <td class="item-price">$<?= number_format($item['price'] ?? 0, 2) ?></td>
                                    <td>
                                        <div class="quantity-group">
                                            <button type="button" class="quantity-btn decrease-btn">-</button>
                                            <input type="number" class="quantity-input"
                                                name="quantities[<?= htmlspecialchars($item['purchase_item_id']) ?>]"
                                                value="<?= htmlspecialchars($item['quantity'] ?? 1) ?>" min="1"
                                                data-purchase-item-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            <button type="button" class="quantity-btn increase-btn">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="remove-btn"
                                            data-purchase-item-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            Remove</button>
                                    </td>
                                </tr>
                        <?php
                                $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                            endforeach;
                        } else {
                            echo '<tr><td colspan="5">No items in cart</td></tr>';
                        }
                        ?>
                   
                </table>

                <div class="total-and-buttons">
                    <div class="total-price">
                        Total: $<span id="total-price"><?= number_format($total, 2) ?></span>
                    </div>
                    <div class="button-group">
                        <button type="button" id="addMoreBtn" class="btn btn-add-more">Add More</button>
                        <a href="/restock_checkout/preview"><button type="button" id="previewBtn"
                                class="btn btn-preview">Preview</button></a>
                        <button type="submit" id="submitBtn" class="btn btn-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Define necessary variables
        const purchaseItems = <?= json_encode($purchaseItems) ?>;
        const defaultImage = "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9InVybCgjZ3JhZGllbnQpIi8+CjxwYXRoIGQ9Ik0yMiAyM0gzOE0yMiAyM0MyMiAyMS4zNDMgMjMuMzQzIDIwIDI1IDIwSDM1QzM2LjY1NyAyMCAzOCAyMS4zNDMgMzggMjNMMzggMzdIMjJMMjIgMjNabTExIDEwSDI3VjI3SDMzVjMzWiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjIiLz4KPHRleHQgeD0iMTUiIHk9IjUwIiBmaWxsPSIjRkZGRkZGIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iOCIgZm9udC13ZWlnaHQ9IjUwMCI+Tm8gSW1hZ2U8L3RleHQ+CjxkZWZzPgo8bGluZWFyR3JhZGllbnQgaWQ9ImdyYWRpZW50IiB4MT0iMCIgeTE9IjAiIHgyPSI2MCIgeTI9IjYwIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzc3Q0ZGRiIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM0NUI5RjUiLz4KPC9saW5lYXJHcmFkaWVudD4KPC9kZWZzPgo8L3N2Zz4=";
        const cartItemsContainer = document.getElementById("cartItems");

        /**
         * Get the list of purchase_item_ids currently in the cart
         * @returns {Set} - A set of purchase_item_ids in the cart
         */
        function getCartItemIds() {
            const cartItemIds = new Set();
            document.querySelectorAll('.cart-item').forEach(row => {
                const itemId = row.getAttribute('data-item-id');
                if (itemId && !itemId.startsWith('new-')) {
                    cartItemIds.add(itemId);
                }
            });
            return cartItemIds;
        }

        /**
         * Creates a new cart item row
         * @param {Object} item - The item object containing purchase_item_id, product_image, product_name, price, and quantity
         * @returns {HTMLElement} - The created table row element
         */
        const createCartItemRow = (item) => {
            const row = document.createElement("tr");
            row.classList.add("cart-item");
            row.setAttribute("data-purchase-item-id", item.purchase_item_id);
            row.setAttribute("data-item-id", item.purchase_item_id); // For tracking in getCartItemIds

            // Determine the image source; use the default image if none exists
            const imageSrc = item.product_image || defaultImage;
            const imageAlt = item.product_name || "No image";
            const imageDisplay = `<img src="${imageSrc}" alt="${imageAlt}" class="img-fluid">`;

            // Get the list of items already in the cart
            const cartItemIds = getCartItemIds();

            // For new items, create a dropdown with products excluding those already in the cart
            const productDisplay = item.purchase_item_id.startsWith("new-") ?
                `<select class="product-select">
                    <option value="" disabled selected>Select a product</option>
                    ${purchaseItems
                    .filter(p => !cartItemIds.has(p.purchase_item_id.toString()))
                    .map(p => `<option value="${p.purchase_item_id}" data-image="${p.product_image}" data-name="${p.product_name}" data-price="${p.price}">${p.product_name}</option>`)
                    .join('')}
                </select>` :
                item.product_name;

            // Use a button for removal (handled by event listener)
            const removeButton = `<button type="button" class="remove-btn" data-purchase-item-id="${item.purchase_item_id}">🗑 Remove</button>`;

            row.innerHTML = `
                <td class="item-image">${imageDisplay}</td>
                <td class="item-name">${productDisplay}</td>
                <td class="item-price">$${item.price.toFixed(2)}</td>
                <td>
                    <div class="quantity-group">
                        <button type="button" class="quantity-btn decrease-btn">−</button>
                        <input type="number" class="quantity-input" name="quantities[${item.purchase_item_id}]" value="${item.quantity}" min="0" data-purchase-item-id="${item.purchase_item_id}">
                        <button type="button" class="quantity-btn increase-btn">+</button>
                    </div>
                </td>
                <td>${removeButton}</td>
            `;

            // Attach quantity button event listeners
            setupQuantityButtons(row);

            return row;
        };

        /**
         * Sets up quantity increase/decrease buttons for a row and updates session cart
         * @param {HTMLElement} row - The table row element
         */
        const setupQuantityButtons = (row) => {
            const input = row.querySelector(".quantity-input");
            const increaseBtn = row.querySelector(".increase-btn");
            const decreaseBtn = row.querySelector(".decrease-btn");

            const updateSessionCart = () => {
                const purchaseItemId = input.getAttribute('data-purchase-item-id');
                const quantity = parseInt(input.value) || 0;

                // Only update if the item is not a new placeholder
                if (!purchaseItemId.startsWith('new-')) {
                    fetch('/restock_checkout/updateQuantity', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `purchase_item_id=${encodeURIComponent(purchaseItemId)}&quantity=${quantity}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                alert('Failed to update quantity: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error updating quantity:', error);
                            alert('An error occurred while updating the quantity');
                        });
                }
            };

            increaseBtn.addEventListener("click", () => {
                input.value = parseInt(input.value) + 1;
                updateTotalPrice();
                updateSessionCart();
            });

            decreaseBtn.addEventListener("click", () => {
                const currentValue = parseInt(input.value);
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                    updateTotalPrice();
                    updateSessionCart();
                }
            });

            input.addEventListener("change", () => {
                const value = parseInt(input.value);
                if (isNaN(value) || value < 0) {
                    input.value = 0;
                }
                updateTotalPrice();
                updateSessionCart();
            });
        };

        /**
         * Updates the total price of all visible items in the UI
         */
        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const priceText = item.querySelector('.item-price').textContent.replace('$', '');
                const price = parseFloat(priceText) || 0;
                const quantity = parseInt(item.querySelector('.quantity-input').value) || 0;
                total += price * quantity;
            });
            document.getElementById('total-price').textContent = total.toFixed(2);
        }

        /**
         * Handles the "Add More" button click to add a new row with a product selection dropdown
         */
        document.getElementById("addMoreBtn").addEventListener("click", () => {
            const newItem = {
                purchase_item_id: `new-${Date.now()}`,
                product_image: "",
                product_name: "",
                price: 0.00,
                quantity: 0
            };
            const newRow = createCartItemRow(newItem);
            cartItemsContainer.appendChild(newRow);

            // Handle product selection
            const select = newRow.querySelector(".product-select");
            select.addEventListener("change", () => {
                const selectedOption = select.options[select.selectedIndex];
                const purchaseItemId = selectedOption.value;
                const image = selectedOption.getAttribute("data-image");
                const name = selectedOption.getAttribute("data-name");
                const price = parseFloat(selectedOption.getAttribute("data-price"));

                newRow.setAttribute("data-purchase-item-id", purchaseItemId);
                newRow.setAttribute("data-item-id", purchaseItemId); // Update for tracking
                const imgElement = newRow.querySelector("td:nth-child(1) img");
                imgElement.src = image || defaultImage;
                newRow.querySelector("td:nth-child(2)").innerHTML = name;
                newRow.querySelector(".item-price").textContent = `$${price.toFixed(2)}`;
                const quantityInput = newRow.querySelector(".quantity-input");
                quantityInput.value = 1;
                quantityInput.setAttribute("data-purchase-item-id", purchaseItemId);
                quantityInput.setAttribute("name", `quantities[${purchaseItemId}]`);

                // Update the remove button's data-purchase-item-id
                const removeBtn = newRow.querySelector(".remove-btn");
                removeBtn.setAttribute("data-purchase-item-id", purchaseItemId);

                // Add the new item to the session cart via AJAX
                fetch('/restock_checkout/addStock', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `purchase_item_id=${encodeURIComponent(purchaseItemId)}&quantity=${quantityInput.value}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert('Failed to add item to cart: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error adding item to cart:', error);
                    });

                updateTotalPrice();
            });

            // Handle row removal for new items
            const removeBtn = newRow.querySelector(".remove-btn");
            if (removeBtn) {
                removeBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    const purchaseItemId = removeBtn.getAttribute('data-purchase-item-id');

                    if (!purchaseItemId.startsWith('new-')) {
                        // Send AJAX request to remove the item from the session cart
                        fetch('/restock_checkout/removecard', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `purchase_item_id=${encodeURIComponent(purchaseItemId)}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    newRow.remove();
                                    updateTotalPrice();
                                } else {
                                    alert('Failed to remove item: ' + (data.message || 'Unknown error'));
                                }
                            })
                            .catch(error => {
                                console.error('Error removing item:', error);
                                alert('An error occurred while removing the item');
                            });
                    } else {
                        // For new items, just remove the row
                        newRow.remove();
                        updateTotalPrice();
                    }
                });
            }

            updateTotalPrice();
        });

        // Handle removal via AJAX for existing items
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const purchaseItemId = button.getAttribute('data-purchase-item-id');
                if (!purchaseItemId) {
                    console.error('No purchase_item_id found for removal');
                    return;
                }

                // Send AJAX request to remove the item
                fetch('/restock_checkout/removecard', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `purchase_item_id=${encodeURIComponent(purchaseItemId)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = button.closest('tr');
                            row.remove();
                            updateTotalPrice();
                        } else {
                            alert('Failed to remove item: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error removing item:', error);
                        alert('An error occurred while removing the item');
                    });
            });
        });

        // Initialize quantity buttons for existing items
        document.querySelectorAll('.cart-item').forEach(row => {
            setupQuantityButtons(row);
        });

        // Initialize total price on page load
        updateTotalPrice();
    </script>
    <script src="/views/assets/js/Language_options/order-now-o.js"></script>
 
