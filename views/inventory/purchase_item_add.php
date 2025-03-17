

<div class="container ">
    <!-- Header Section -->
    <div class="header mt-0">
        <h2>Purchase Item Add</h2>
        <div class="header-controls">
            <button class="add-new-btn"><i class="fas fa-plus"></i><a href="/purchase_item/create"> Add New</a></button>
            <button class="add-new-btn order-btn"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>

    <!-- <?php print_r($purchase_items); ?> -->
    <!-- Product Cards -->
    <div class="d-flex flex-wrap justify-content-center gap-3" id="product-list">
        <?php foreach ($products as $item): ?>
            <div class="card shadow-lg p-0 rounded d-flex flex-column align-items-center text-center" style="width: 280px; height: 380px;">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit" style="color: #f7020f;"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <!-- Adjusted image height -->
                <img src="<?= $item['product_image'] ?>" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                <div class="p-3">
                    <h4 class="font-weight-bold"><?= $item['product_name'] ?></h4>
                    <h4 class="text-success">$<?= $item['price'] ?></h4>
                    <a href="/order_now/show" class="btn btn-primary w-100 mt-0 m-2"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
