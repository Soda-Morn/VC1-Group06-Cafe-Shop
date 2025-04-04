<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Category</h5>
                </div>
                <div class="card-body">
                    <form action="/Categories/update/<?= htmlspecialchars($category['Category_id']) ?>" method="POST">
                        <input type="hidden" name="Category_id" value="<?= htmlspecialchars($category['Category_id']) ?>">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                        <a href="/Categories" class="btn btn-danger mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card{
        margin-top: 160px;
    }
</style>
