<div class="container mt-4">
    <div class="row">
        <!-- Category List Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Category List</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAME</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $i++ ?></td> <!-- Start the counter from 1 -->
                                <td><?= htmlspecialchars($category['name']) ?></td>
                                <td>
                                    <a href="/Categories/edit/<?= htmlspecialchars($category['Category_id']) ?>"><i class="material-icons">edit</i></a>
                                    <a href="/Categories/delete/<?= htmlspecialchars($category['Category_id']) ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="material-icons text-danger">delete</i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Category Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Create Category</h5>
                </div>
                <div class="card-body">
                    <form action="/Categories/store" method="POST">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                        <a href="/Categories" class="btn btn-secondary mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
