<div class="container">
    <form action="/supplier/store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label class="form-label">Profile Picture:</label>
            <input type="file" name="profile" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>
