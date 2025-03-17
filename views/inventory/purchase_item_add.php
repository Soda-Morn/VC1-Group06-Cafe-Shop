

<div class="container mt-7">
    <!-- Header Section -->
    <div class="header">
        <h2>Purchase Item Add</h2>
        <div class="header-controls">
            <button class="add-new-btn"><i class="fas fa-plus"></i> Add New</button>
            <select class="sort-dropdown">
                <option value="">Sort by</option>
                <option value="price-low">Low to High</option>
                <option value="price-high">High to Low</option>
            </select>
            <button class="add-new-btn order-btn"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>
    <!-- Product Cards -->
    <div class="d-flex flex-wrap justify-content-start gap-2" id="product-list">
        <?php foreach ($products as $item): ?>
            <div class="card shadow-lg p-0 rounded d-flex flex-column align-items-center text-center" style="width: 280px;">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="<?= $item['image'] ?>" class="card-img-top " style="width: 100%; height: 300px; object-fit: cover;">
                <div class=" p-6">
                    <h4 class="font-weight-bold"><?= $item['name'] ?></h4>
                    <h4 class="text-success">$<?= $item['price'] ?></h4>
                    <a href="/order_now/show" class="btn btn-primary w-10 mt-0 m-2"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
