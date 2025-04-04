
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: white;
        }
        
        .header {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-input {
            width: 200px;
            padding: 8px 15px 8px 35px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23999' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 10px center;
            background-size: 16px 16px;
        }

        .search-input:focus {
            outline: none;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .add-new-btn {
            background: #28a745;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-create {
            background: #28a745;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
        }

        /* Custom column width for 5 cards per row with adjusted spacing */
        .col-5-cards {
            width: 20%;
            padding-right: 5px;
            padding-left: 5px;
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
            box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
            height: 92%;
            margin-left: 10px;
            margin-right: 10px;
            background-color: white;
        }

        .card-img-top {
            height: 150px;
            object-fit: contain;
            background-color: white;
            padding: 5px;
        }

        .card-body {
            margin-top: 5px;
            background-color: white;
        }

        /* Delete button styling */
        .btn-delete {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 16px;
            color: #dc3545;
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            z-index: 1;
        }

        #add-card{
            background-color: rgb(196, 95, 22);
            border-radius: 6px;
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
            color: white;
            border: none;
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

        /* Container padding adjustment */
        .container {
            padding-left: 20px;
            padding-right: 20px;
            max-width: 1400px;
        }

        /* Checkbox styles */
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
        /* Adjust the button group spacing */
        .button-group {
            display: flex;
            gap: 10px;
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
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-container {
                width: 100%;
            }
            .search-input {
                width: 100%;
            }
            .button-group {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 575.98px) {
            .col-5-cards {
                width: 50%;
            }
            .button-group {
                gap: 5px;
            }
            .checkout-btn,
            .btn-create {
                font-size: 0.9rem;
                padding: 0.3rem 0.6rem;
            }
        }
    </style>

    <div class="container">
        <div class="header">
            <h2>Drink Menu</h2>
            <div class="button-group">
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search menu......" onkeyup="filterProducts()">
                </div>
                <button type="submit" form="checkoutForm" class="checkout-btn" id="checkoutBtn">Order Now</button>
                <a href="/order_menu/create" class="btn-create add-new-btn">Create Menu</a>
            </div>
        </div>
        <form id="checkoutForm" action="/orderCard/addMultipleToCart" method="POST">
            <div class="row card-row">
                <?php foreach ($products as $item): ?>
                    <div class="col-5-cards product-card" data-name="<?= htmlspecialchars(strtolower($item['name'])) ?>">
                        <div class="card" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">
                            <input type="checkbox" class="select-checkbox" name="selected_products[]" value="<?= htmlspecialchars($item['product_ID']) ?>">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button type="button" class="btn-delete btn-sm btn-remove" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($item['description']) ?></p>
                                <div class="price-button-container">
                                    <span class="fw-bold">$<?= number_format($item['price'], 2) ?></span>
                                    <button type="button" id="add-card" class="btn btn-add-to-cart" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
 
    