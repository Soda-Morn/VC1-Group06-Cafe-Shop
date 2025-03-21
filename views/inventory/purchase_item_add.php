<div class="container py-4" style="background-color: #f0f4f8;">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Purchase Item</h2>
        <div class="header-controls">
            <a href="/purchase_item_add/create" class="btn btn-outline-primary me-2 shadow-sm">
                <i class="fas fa-plus"></i> Add new
            </a>
        </div>
    </div>
    <!-- Product Cards -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-4" id="product-list">
        <?php foreach ($products as $item): ?>
            <div class="col">
                <div class="card shadow-sm rounded-3 overflow-hidden" 
                     style="background: linear-gradient(135deg, #fffaf5, #fff); border: none;">
                     
                    <!-- Vertical Ellipsis Dropdown Menu -->
                    <div class="edit-delete-icons text-end p-2">
                        <div class="custom-dropdown">
                            <button class="btn btn-sm p-0 product-ellipsis-btn" type="button">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="custom-dropdown-menu">
                                <a class="custom-dropdown-item" href="/purchase_item_add/edit/<?= $item['purchase_item_id'] ?>">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                                <button class="custom-dropdown-item delete-product-item" type="button" data-id="<?= $item['purchase_item_id'] ?>">
                                    <i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div style="height: 200px; display: flex; align-items: center; justify-content: center;">
                        <img src="<?= $item['product_image'] ?>" class="card-img-top" 
                             style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body text-center" style="padding-top: 20px;">
                        <h5 class="fw-bold text-dark" style="font-size: 1.2rem; text-transform: capitalize;">
                            <?= $item['product_name'] ?>
                        </h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-success mb-0" style="font-size: 1rem; font-weight: 700;">
                                $<span class="price"><?= $item['price'] ?></span>
                            </h6>
                            <form action="/restock_checkout/addStock" method="POST" class="d-inline">
                                <input type="hidden" name="purchase_item_id" value="<?= $item['purchase_item_id'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
