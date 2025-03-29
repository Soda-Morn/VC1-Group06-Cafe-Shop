<div class="category-container mt-4">
    <h1>Category List</h1>
    <div class="row">
        <!-- Category List Card -->
        <div class="col-md-6">
            <div class="category-card">
                <div class="category-card-header">
                    <h5>Category List</h5>
                </div>
                <div class="category-card-body">
                    <div class="table-container">
                        <table class="category-table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="category-table-body">
                                <?php $i = 1; foreach ($categories as $category): ?>
                                <tr class="category-row">
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($category['name']) ?></td>
                                    <td class="category-actions">
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0" type="button" id="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="category-dropdown-menu" aria-labelledby="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>">
                                                <div class="category-dropdown-row">
                                                    <a class="category-dropdown-item" href="/Categories/edit/<?= htmlspecialchars($category['Category_id']) ?>">
                                                        <i class="material-icons category-icon">edit</i> Edit
                                                    </a>
                                                    <a class="category-dropdown-item text-danger" href="/Categories/delete/<?= htmlspecialchars($category['Category_id']) ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                                        <i class="material-icons category-icon">delete</i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <!-- Pagination inside Actions Column -->
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="category-actions">
                                        <button class="btn btn-primary" id="prev-button" onclick="changePage('prev')">
                                            Previous
                                        </button>
                                        <button class="btn btn-primary" id="next-button" onclick="changePage('next')">
                                            Next
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Category Card -->
        <div class="col-md-6">
            <div class="category-card">
                <div class="category-card-header">
                    <h5>Create Category</h5>
                </div>
                <div class="category-card-body">
                    <form action="/Categories/store" method="POST">
                        <div class="category-form-group">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                        <a href="/Categories" class="btn btn-danger mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
