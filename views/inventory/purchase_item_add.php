
<div class="container">
    <!-- Header Section -->
    <div class="header">
        <h2>Purchase Item Add</h2>
        <div class="header-controls">
            <!-- Add New Button triggers the Modal -->
            <button class="add-new-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal"><i class="fas fa-plus"></i> Add New</button>
            <select class="sort-dropdown form-select">
                <option value="">Sort by</option>
                <option value="price-low">Low to High</option>
                <option value="price-high">High to Low</option>
            </select>
            <button class="order btn btn-success"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>

   

<!-- Modal for Adding Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="profilePicture" class="form-label">Choose Product</label>
                    <input type="file" class="form-control" id="profilePicture">
                </div>
                <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter product name...">
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" placeholder="Enter category...">
                </div>
                <div class="form-group mb-3">
                    <label for="quality">Quality</label>
                    <select class="form-control" id="quality">
                        <option value="">Select Quality</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Enter product description..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>

