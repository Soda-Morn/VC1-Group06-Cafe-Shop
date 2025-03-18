
<div class="container py-4" style="background-color: #f0f4f8;">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Sip & Shop</h2>
        <div class="header-controls">
            <a href="/purchase_item_add/create" class="btn btn-outline-primary me-2 shadow-sm">
                <i class="fas fa-plus"></i> Add New
            </a>
            <button class="btn btn-success shadow-sm">
                <i class="fas fa-shopping-cart"></i> Order Now
            </button>
        </div>
    </div>

    <!-- Product Cards -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 mb-4" id="product-list">
        <?php foreach ($products as $item): ?>
            <div class="col">
                <div class="card shadow-sm rounded-3 overflow-hidden" 
                     style="background: linear-gradient(135deg, #fffaf5, #fff); border: none;">
                     
                    <!-- Edit and Delete Icons -->
                    <div class="edit-delete-icons text-end p-2">
                        <a href="/purchase_item_add/edit/<?= $item['purchase_item_id'] ?>" class="text-danger me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <i class="fas fa-trash text-danger delete-btn" data-id="<?= $item['purchase_item_id'] ?>" style="cursor: pointer;"></i>
                    </div>

                    <!-- Product Image -->
                    <img src="<?= $item['product_image'] ?>" class="card-img-top" 
                         style="height: 150px; object-fit: cover; transition: transform 0.3s ease;">

                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-dark" style="font-size: 1.2rem; text-transform: capitalize;">
                            <?= $item['product_name'] ?>
                        </h5>
                        <h6 class="text-success mb-2" style="font-size: 1rem; font-weight: 700;">
                            $<span class="price"><?= $item['price'] ?></span>
                        </h6>
                        <a href="/order_now/show" class="btn btn-primary w-100 py-1 mt-auto rounded-pill" 
                           style="background: linear-gradient(90deg, #4a90e2, #63b8ff); border: none;">
                            <i class="fas fa-shopping-cart me-1"></i> Add
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click event listener to all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');
    
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const purchaseItemId = this.getAttribute('data-id');
                
                // Confirm deletion
                if (confirm('Are you sure you want to delete this item?')) {
                    // Perform the delete action
                    window.location.href = '/purchase_item/destroy/' + purchaseItemId;
                }
            });
        });
    });
</script>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .btn-primary {
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #357abd, #50a8ff);
    }
</style>
