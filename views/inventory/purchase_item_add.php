<div class="container py-4" style="background-color: #f0f4f8;">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Sip & Shop</h2>
        <div class="header-controls">
            <button class="add-new-btn btn btn-outline-primary me-2 shadow-sm">
                <i class="fas fa-plus"></i> <a href="/purchase_item/create" class="text-decoration-none text-primary">Add New</a>
            </button>
            <button class="add-new-btn btn btn-success shadow-sm">
                <i class="fas fa-shopping-cart"></i> Order Now
            </button>
        </div>
    </div>

    <!-- Product Cards Row: 6 Cards -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 mb-4" id="product-list">
        <?php for ($i = 0; $i < min(10, count($products)); $i++): ?>
            <div class="col">
                <div class="card shadow-sm rounded-3 overflow-hidden" 
                     style="background: linear-gradient(135deg, #fffaf5, #fff); border: none;">
                    <!-- Product Image -->
                    <img src="<?= $products[$i]['product_image'] ?>" class="card-img-top" 
                         style="height: 150px; object-fit: cover; transition: transform 0.3s ease;">
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-dark" style="font-size: 1.2rem; color: #4a2c2a; text-transform: capitalize;">
                            <?= $products[$i]['product_name'] ?>
                        </h5>
                        <h6 class="text-success mb-2" style="font-size: 1rem; font-weight: 700;">
                            $<span class="price"><?= $products[$i]['price'] ?></span>
                        </h6>
                        <a href="/order_now/show" class="btn btn-primary w-100 py-1 mt-auto rounded-pill" 
                           style="background: linear-gradient(90deg, #4a90e2, #63b8ff); border: none;">
                            <i class="fas fa-shopping-cart me-1"></i> Add
                        </a>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

<!-- Inline CSS for extra flair -->
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .add-new-btn {
        padding: 8px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .add-new-btn:hover {
        transform: scale(1.05);
    }
    .header h2 {
        letter-spacing: 0.5px;
        font-size: 2rem;
    }
    .btn-primary {
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #357abd, #50a8ff);
    }
    @media (max-width: 768px) {
        .row-cols-2 .col {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
    @media (max-width: 576px) {
        .row-cols-2 .col {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>