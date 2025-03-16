<div class="container-fluid">
    <div class="row">
        <!-- Coffee Menu Section -->
        <div class="col-md-9 p-4 bg-light"> <!-- Adjusted to col-md-9 -->
            <h2 class="text-center text-uppercase fw-bold">Coffee Menu</h2>
            <button class="btn btn-secondary btn-sm d-block mx-auto mb-3">
                <a href="/order_menu/create" class="text-white text-decoration-none">Add new</a>
            </button>
            <div class="row">
                <?php foreach ($products as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 text-center" style="height: 250px;">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['name'] ?>" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <h4 class="card-title mb-1"><?= $item['name'] ?></h4>
                                <p class="card-text mb-1" style="font-size: 0.9rem;"><?= $item['description'] ?></p>
                                <span class="fw-bold">$<?= $item['price'] ?></span>
                                <div class="mt-2">
                                    <form method="POST" action="/cart/add">
                                        <input type="hidden" name="product_id" value="<?= $item['product_ID'] ?>" />
                                        <button class="btn btn-primary btn-sm view-details">Add to cart</button>
                                    </form>
                                    <button class="btn btn-secondary btn-sm view-details mt-1">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="col-md-3 p-4 bg-danger-subtle"> <!-- Adjusted to col-md-3 -->
            <h2 class="text-center text-uppercase fw-bold">Cart Order <span class="fw-normal">#3343</span></h2>
            <div class="card-container">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between p-2">
                                <span class="card-title"><?= $item['name'] ?></span>
                                <span class="fw-bold"><?= $item['quantity'] ?> x $<?= $item['price'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No items in cart</p>
                <?php endif; ?>
            </div>
            <div class="mt-3 p-3 border-top">
                <div class="d-flex justify-content-between">
                    <span>Items</span><span class="total-items fw-bold">$<?= isset($totalAmount) ? $totalAmount : '0.00' ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Discounts</span><span class="total-discounts text-danger">-$3.00</span>
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span><span class="total-amount text-success">$<?= isset($totalAmount) ? $totalAmount : '0.00' ?></span>
                </div>
            </div>
            <button class="btn btn-warning w-100 mt-3">Place an order</button>
        </div>
    </div>
</div>