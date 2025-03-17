<div class="container-fluid">
    <div class="row">
        <!-- Coffee Menu Section -->
        <div class="col-md-12 p-4 bg-light">
            <h2 class="text-center text-uppercase fw-bold">Coffee Menu</h2>
            <button class="btn btn-secondary btn-sm d-block mx-auto mb-3">
                <a href="/order_menu/create" class="text-white text-decoration-none">Add new</a>
            </button>
            <div class="row">
                <?php foreach ($products as $item): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 text-center position-relative"> <!-- Added position-relative -->
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['name'] ?>"
                                style="height: 150px; object-fit: cover;">
                            <!-- Delete Icon -->
                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" style="z-index: 1;">
                                <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                            </button>
                            <div class="card-body p-2">
                                <h4 class="card-title mb-1"> <?= $item['name'] ?> </h4>
                                <p class="card-text mb-1" style="font-size: 0.9rem;"> <?= $item['description'] ?> </p>
                                <span class="fw-bold">$<?= $item['price'] ?></span>
                                <form action="/orderCard/addToCart" method="POST" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_ID'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>