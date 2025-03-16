<div class="container">
    <form action="/supplier/update?id=<?= $supplier['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Name:</label>
            <input type="text" value="<?= $supplier['name'] ?>" name="name" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label class="form-label">Current Profile Picture:</label><br>
            <?php if (!empty($supplier['profile'])): ?>
                <img src="<?= $supplier['profile'] ?>" width="100" height="100" class="rounded-circle">
            <?php else: ?>
                <img src="default-avatar.png" width="100" height="100" class="rounded-circle">
            <?php endif; ?>
        </div>

        <div class="form-group mt-3">
            <label class="form-label">New Profile Picture:</label>
            <input type="file" name="profile" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
