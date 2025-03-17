<body class="bg-light">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h2 class="d-flex align-items-center gap-3">
                <i class="fas fa-coffee text-warning"></i> Product List in Shop
            </h2>
            <div class="d-flex gap-2">
                <button class="btn btn-success"><i class="fas fa-plus"></i> Add New</button>
                <select class="form-select w-auto">
                    <option selected>Sort by</option>
                    <option value="price-low">Low to High</option>
                    <option value="price-high">High to Low</option>
                </select>
                <button id="orderNow" class="btn btn-primary">Order Now</button>
            </div>
        </div>

        <!-- Product Grid with Left and Right Margins (4 Cards Per Row) -->
        <div class="row g-4 mx-3">
            <!-- Product Card 1 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 4.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Cappuccino Coffee</h5>
                        <h4 class="text-success">$250.99</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 4.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Latte Coffee</h5>
                        <h4 class="text-success">$180.50</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 10.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Espresso Supreme</h5>
                        <h4 class="text-success">$199.99</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 8.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Mocha Delight</h5>
                        <h4 class="text-success">$220.75</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 5 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 7.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Caramel Latte</h5>
                        <h4 class="text-success">$150.30</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 6 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 9.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Vanilla Latte</h5>
                        <h4 class="text-success">$170.45</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 7 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 8.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Iced Coffee</h5>
                        <h4 class="text-success">$210.99</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 8 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 6.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Hazelnut Coffee</h5>
                        <h4 class="text-success">$230.50</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 9 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 5.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Macchiato</h5>
                        <h4 class="text-success">$210.00</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 10 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 3.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Flat White</h5>
                        <h4 class="text-success">$190.25</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 11 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 4.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Affogato</h5>
                        <h4 class="text-success">$215.99</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>

            <!-- Product Card 12 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="views/assets/images/image copy 4.png" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title">Irish Coffee</h5>
                        <h4 class="text-success">$265.75</h4>
                        <button class="btn btn-success w-100"><i class="fa fa-cart-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Product Grid -->
    </div>
</body>
