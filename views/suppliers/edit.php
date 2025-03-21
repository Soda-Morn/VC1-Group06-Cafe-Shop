<div class="container " style="max-width: 50%;"> <!-- Reduce form width -->
    <h1>Edit Supplier</h1>
    <form action="/suppliers/update/<?= htmlspecialchars($supplier['id']) ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control form-control-lg " id="name" name="name" value="<?= htmlspecialchars($supplier['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control form-control-lg" id="phone_number" name="phone_number" value="<?= htmlspecialchars($supplier['phone_number']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control form-control-lg" id="address" name="address" value="<?= htmlspecialchars($supplier['address']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Update Supplier</button>
        <a href="/suppliers" class="btn btn-danger btn-sm">Cancel</a>
    </form>
</div>
