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
                                <td class="icon-actions">
                                    <!-- Three dot dropdown menu for actions -->
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0" type="button" id="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>">
                                            <a class="dropdown-item" href="/Categories/edit/<?= htmlspecialchars($category['Category_id']) ?>">
                                                <i class="material-icons">edit</i> Edit
                                            </a>
                                            <a class="dropdown-item text-danger" href="/Categories/delete/<?= htmlspecialchars($category['Category_id']) ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                                <i class="material-icons">delete</i> Delete
                                            </a>
                                        </div>
                                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all the dropdown buttons
        const dropdownButtons = document.querySelectorAll('.dropdown button');

        // Add a click event listener for each dropdown button
        dropdownButtons.forEach(function(button) {
            button.addEventListener('click', function (event) {
                const dropdownMenu = event.target.closest('.dropdown').querySelector('.dropdown-menu');
                
                // Toggle the visibility of the dropdown menu
                dropdownMenu.classList.toggle('show');
            });
        });

        // Close the dropdown if the user clicks outside of it
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.dropdown')) {
                // Hide any open dropdowns
                const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                openDropdowns.forEach(function(menu) {
                    menu.classList.remove('show');
                });
            }
        });
    });
</script>
