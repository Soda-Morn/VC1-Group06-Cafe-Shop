<div class="container d-flex justify-content-center align-items-center min-vh-20 py-md-2 ">
    <div class="card shadow-sm  w-100 m-5 ">
        <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">View Details</h4>  
            <a href="/stocklist" class="btn fw-bold text-dark">
                <i class="fa-solid fa-xmark"></i>
            </a> 
        </div>
        <div class="card-body text-center d-md-block d-lg-flex d-flex justify-content-center align-items-center">
            <!-- Product Image -->
            <div class="form-group mb-4 mx-auto mx-lg-0" style="max-width: 400px;">
                <div class="image-upload-area" id="image-upload-area">
                    <input type="file" name="product_image" accept="image/*" id="file-input" style="display: none;">
                    <img id="preview-image" 
                         class="preview-image border border-0 mb-3 img-fluid" 
                         src="/<?= htmlspecialchars($stock['product_image']); ?>" 
                         alt="Product Image" 
                         style="width: 100%; max-width: 400px; height: auto; max-height: 400px; object-fit: cover;">
                </div>
            </div>
            <!-- Details -->
            <div class="d-flex flex-column justify-content-center align-items-md-center align-items-lg-start mt-3 mt-lg-0">
                <!-- Product Name -->
                <p class="fw-bold fs-5 mb-2">Name: <?= htmlspecialchars($stock['product_name']); ?></p>
                <!-- Date -->
                <p class="text-muted mb-2">Date: <?= date('F j, Y', strtotime($stock['date'])); ?></p>
                <!-- Quantity -->
                <p class="fw-semibold mb-3">Stocks: <?= htmlspecialchars($stock['quantity']); ?> item</p>
                <!-- Stock Status -->
                <span class="badge px-3 py-2 rounded-pill fw-bold m-2
                    <?php
                    $quantity = $stock['quantity'];
                    echo $quantity == 0 ? 'bg-danger' : ($quantity <= 3 ? 'bg-warning text-dark' : 'bg-success');
                    ?>">
                    <?= $quantity == 0 ? 'Out of Stock' : ($quantity <= 3 ? 'Low Stock' : 'In Stock'); ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
$(document).ready(function() {
    const $previewImage = $('#preview-image');
    const defaultImage = '/assets/images/default-image.jpg';

    // Error handling for image
    $previewImage.on('error', function() {
        console.log('Image failed to load: ' + $(this).attr('src'));
        $(this).attr('src', defaultImage);
    }).on('load', function() {
        console.log('Image loaded: ' + $(this).attr('src'));
    });
});
</script>