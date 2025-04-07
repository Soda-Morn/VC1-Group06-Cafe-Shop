<div class="container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4 w-75 bg-light" style="border-radius: 15px;">
        <h1 class="text-center text-primary mb-4">Edit Supplier</h1>
        <form action="/suppliers/update/<?= htmlspecialchars($supplier['id']) ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Supplier Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($supplier['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                <input type="text" class="form-control " id="phone_number" name="phone_number" 
                       value="<?= htmlspecialchars($supplier['phone_number']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input type="text" class="form-control " id="address" name="address" 
                       value="<?= htmlspecialchars($supplier['address']) ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                
                <a href="/suppliers" class="btn btn-danger w-45">Cancel</a>
                <button type="submit" class="btn btn-primary w-45">Update Supplier</button>
            </div>
        </form>
    </div>
</div>
<script src="/views/assets/js/Language_options/supplier-edit-o.js"></script>
