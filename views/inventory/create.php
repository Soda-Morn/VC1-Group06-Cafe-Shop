<!-- Modal for Adding Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add product form -->
                <form action="/inventory/store" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Choose Product Image</label>
                        <input type="file" class="form-control" name="image" id="profilePicture" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Enter category..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quality">Quality</label>
                        <select class="form-control" name="quality" id="quality" required>
                            <option value="">Select Quality</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter product description..." required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="purchase_id">Purchase ID</label>
                        <input type="number" class="form-control" name="purchase_id" id="purchase_id" placeholder="Enter Purchase ID..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity..." required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
