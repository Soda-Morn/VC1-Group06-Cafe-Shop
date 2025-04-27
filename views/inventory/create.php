<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="../views/assets/css/Inventory/create.css">

<div class="form-container">
    <!-- Form Header -->
    <div class="form-header">
        <h1 class="form-title">Add a New Product</h1>
        <p class="form-subtitle">Fill in the details below to create a product</p>
    </div>

    <!-- Form -->
    <form action="/purchase_item_add/store" method="POST" enctype="multipart/form-data" id="product-form">
        <!-- Image Upload Section -->
        <div class="form-group">
            <label class="form-label">Product Image</label>
            <div class="image-upload-area" id="image-upload-area">
                <input type="file" name="image" accept="image/*" id="file-input" style="display: none;" required>
                <div class="upload-prompt" id="upload-prompt">
                    <span class="upload-text">
                        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Select Product Image
                    </span>
                </div>
                <div class="image-preview-container" id="image-preview-container">
                    <img id="preview-image" class="preview-image" src="#" alt="Preview">
                    <button type="button" class="change-image-btn" id="change-image-btn">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M23 4v6h-6"></path>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        Change Image
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Name and Price Row -->
        <div class="form-row">
            <!-- Product Name -->
            <div class="form-group">
                <label class="form-label" for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label class="form-label" for="price">Price ($)</label>
                <input type="number" name="price" id="price" class="form-control" step="1" placeholder="Enter price"
                    required>
            </div>
        </div>

        <!-- Store Unit Section -->
        <div class="form-group">
            <label class="form-label" for="store_unit">Unit store</label>
            <select name="store_unit" id="store_unit" class="form-select" required>
                <option value="" disabled selected>Select a unit</option>
                <?php foreach ($units as $unit): ?>
                    <option value="<?= htmlspecialchars($unit['unit_id']) ?>">
                        <?= htmlspecialchars($unit['unit_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Category Section -->
        <div class="form-group">
            <label class="form-label" for="category">Category</label>
            <select name="category" id="category" class="form-select" required>
                <option value="" disabled selected>Select a category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Buttons -->
        <div class="buttons-container">
            <button type="submit" class="btn btn-primary" id="submit-btn">
                Add To Stock
            </button>
            <a href="/purchase_item_add" class="btn btn-danger">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Add this script after your existing <script> tag -->
<script src="/views/assets/js/Language_options/restock-create-o.js"></script>
<script src="/views/assets/js/Inventory/create.js"></script>
