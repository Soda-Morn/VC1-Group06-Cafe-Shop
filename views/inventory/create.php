<!-- Add New Button -->
<button class="add-new-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
  <i class="fas fa-plus"></i> Add New
</button>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/purchase_item_add/store" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <label for="purchase_id">Purchase ID:</label>
          <input type="text" name="purchase_id" id="purchase_id" required>
          
          <label for="product_id">Product ID:</label>
          <input type="text" name="product_id" id="product_id" required>
          
          <label for="quantity">Quantity:</label>
          <input type="number" name="quantity" id="quantity" required>
          
          <label for="image">Image:</label>
          <input type="file" name="image" id="image">
        </div>
        <div class="modal-footer">
          <input type="submit" value="Add Purchase Item" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Trigger modal show on Add New button click
  document.querySelector('.add-new-btn').addEventListener('click', function () {
    var myModal = new bootstrap.Modal(document.getElementById('productModal'));
    myModal.show();
  });
</script>
