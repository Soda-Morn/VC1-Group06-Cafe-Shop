<!-- views/inventory/edit_stock.php -->
<div class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Edit Stock List</h4>
                    <h6 class="text-muted">Update stock details below</h6>
                </div>

                <form action="/stocklist/edit/<?= htmlspecialchars($stock['stock_list_id']); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="stock_list_id" value="<?= htmlspecialchars($stock['stock_list_id']); ?>">

                    <!-- Product Image Field -->
                    <div class="mb-3">
                        <label class="fw-bold">Product Image</label>
                        <div class="border border-primary border-2 rounded-3 p-4 text-center bg-primary-subtle" onclick="document.getElementById('file-input').click();">
                            <input type="file" name="product_image" accept="image/*" id="file-input" class="d-none">
                            <img src="/Views/assets/img1/icons/upload.svg" alt="Upload Image" class="mb-2" width="50">
                            <h5 class="text-muted">Select Product Image</h5>
                        </div>
                    </div>

                    <?php if (!empty($stock['product_image'])): ?>
                        <div class="mb-3 text-center">
                            <p class="fw-bold">Current Image:</p>
                            <img src="/<?= htmlspecialchars($stock['product_image']); ?>" alt="Current Image" class="img-thumbnail" width="150">
                        </div>
                    <?php endif; ?>

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($stock['product_name']); ?>" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($stock['quantity']); ?>" required>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="In Stock" <?= $stock['status'] == 'In Stock' ? 'selected' : ''; ?>>In Stock</option>
                            <option value="Low Stock" <?= $stock['status'] == 'Low Stock' ? 'selected' : ''; ?>>Low Stock</option>
                            <option value="Out of Stock" <?= $stock['status'] == 'Out of Stock' ? 'selected' : ''; ?>>Out of Stock</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="<?= htmlspecialchars(date('Y-m-d', strtotime($stock['date']))); ?>" required>
                    </div>

                    <div id="file-name" class="text-success mt-2"></div>

                    <!-- Buttons -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-2">Update <i class="fas fa-check"></i></button>
                        <button type="button" class="btn btn-danger me-2 delete-stock-item" data-id="<?= htmlspecialchars($stock['stock_list_id']); ?>">Delete <i class="fas fa-trash"></i></button>
                        <a href="/stocklist" class="btn btn-danger">Cancel <i class="fas fa-times"></i></a>
                    </div>
                </form>
            </div>
        </form>
    </div>

    <script>
        // DOM Elements
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imageUploadArea = document.getElementById('image-upload-area');
        const changeImageBtn = document.getElementById('change-image-btn');

        // Make the upload area clickable
        imageUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Change image button functionality
        changeImageBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent triggering the upload area click
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                // Create and display image preview
                const imageUrl = URL.createObjectURL(file);
                previewImage.src = imageUrl;
                uploadPrompt.style.display = 'none';
                imagePreviewContainer.style.display = 'flex';

                // Free memory when image is loaded
                previewImage.onload = () => {
                    URL.revokeObjectURL(imageUrl);
                };
            } else {
                resetImageDisplay();
            }
        });

        // Reset image display
        function resetImageDisplay() {
            uploadPrompt.style.display = 'flex';
            imagePreviewContainer.style.display = 'none';
        }

        // On page load, show the existing image
        window.addEventListener('load', () => {
            if (previewImage.src) {
                uploadPrompt.style.display = 'none';
                imagePreviewContainer.style.display = 'flex';
            }
        });
<<<<<<< HEAD
    </script>
</body>
</html>
=======

        // Add event listener for the Delete button
        document.querySelector('.delete-stock-item').addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this item?')) {
                const stockId = this.getAttribute('data-id');
                console.log('Attempting to delete stock item with ID:', stockId); // Debug log

                fetch('/stocklist/delete/' + stockId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status); // Debug log
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data); // Debug log
                    if (data.success) {
                        window.location.href = '/stocklist';
                    } else {
                        alert('Error deleting item: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error); // Debug log
                    alert('Error connecting to server: ' + error.message);
                });
            }
        });
    </script>
</div>
>>>>>>> 1099725539e322eb7d9aa856c967d99242a02e23
