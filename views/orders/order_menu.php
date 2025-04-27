<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="../views/assets/css/order_menu/order_menu.css">
<script src="views/assets/js/Language_options/order-menu-o.js"></script>

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
        <div class="row card-row" id="cardContainer">
            <?php
            $cardsPerPage = 15;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $cardsPerPage;
            $currentProducts = array_slice($products, $start, $cardsPerPage);

            foreach ($currentProducts as $item): ?>
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
        <div class="pagination">
            <?php
            $totalPages = ceil(count($products) / $cardsPerPage);
            $prevPage = $page > 1 ? $page - 1 : 1;
            $nextPage = $page < $totalPages ? $page + 1 : $totalPages;
            ?>
            <button type="button" class="pagination-btn" onclick="window.location.href='?page=<?= $prevPage ?>'" <?= $page === 1 ? 'disabled' : '' ?>>Previous</button>
            <button type="button" class="pagination-btn" onclick="window.location.href='?page=<?= $nextPage ?>'" <?= $page === $totalPages ? 'disabled' : '' ?>>Next</button>
        </div>
    </form>
</div>
