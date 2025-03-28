<div class="category-container mt-4">
    <h1>Category_list</h1>
    <div class="row">
        <!-- Category List Card -->
        <div class="col-md-6">
            <div class="category-card">
                <div class="category-card-header">
                    <h5>Category List</h5>
                </div>
                <div class="category-card-body">
                    <table class="category-table">
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
                                <td class="category-actions">
                                    <!-- Three dot dropdown menu for actions -->
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0" type="button" id="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i> <!-- Three dots icon -->
                                        </button>
                                        <div class="category-dropdown-menu" aria-labelledby="dropdownMenuButton<?= htmlspecialchars($category['Category_id']) ?>">
                                            <a class="category-dropdown-item" href="/Categories/edit/<?= htmlspecialchars($category['Category_id']) ?>">
                                                <i class="material-icons">edit</i> Edit <!-- Edit icon inside dropdown -->
                                            </a>
                                            <a class="category-dropdown-item text-danger" href="/Categories/delete/<?= htmlspecialchars($category['Category_id']) ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                                <i class="material-icons">delete</i> Delete <!-- Delete icon inside dropdown -->
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
            <div class="category-card">
                <div class="category-card-header">
                    <h5>Create Category</h5>
                </div>
                <div class="category-card-body">
                    <form action="/Categories/store" method="POST">
                        <div class="category-form-group">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="category-btn-primary mt-3">Create</button>
                        <a href="/Categories" class="category-btn-secondary mt-3">Cancel</a>
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
            const dropdownMenu = event.target.closest('.dropdown').querySelector('.category-dropdown-menu');
            
            // Toggle the visibility of the dropdown menu
            dropdownMenu.classList.toggle('show');
        });
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown')) {
            // Hide any open dropdowns
            const openDropdowns = document.querySelectorAll('.category-dropdown-menu.show');
            openDropdowns.forEach(function(menu) {
                menu.classList.remove('show');
            });
        }
    });
});
</script>

<style>
    /* General Container Styling */
.category-container {
    max-width: 97%;
    margin: auto;
    padding: 20px;
}

/* Card Styling */
.category-card {
    margin-top: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: none;
    background: #fff;
    padding: 20px;
}

.category-card-header {
    background: rgb(204, 121, 61);
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    border-radius: 12px 12px 0 0;
}

/* Table Styling */
.category-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
}

.category-table th, .category-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.category-table th {
    background: #f7f7f7;
    font-weight: 600;
}

.category-table tr:hover {
    background: rgba(255, 165, 0, 0.2);
}

/* Action Buttons */
.category-actions {
    position: relative;
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* Dropdown Styling */
.dropdown {
    position: relative;
}

.dropdown button {
    border: none;
    background: transparent;
    cursor: pointer;
}

.category-dropdown-menu {
    position: absolute;
    top: 30px;
    right: 0;
    background: white;
    border-radius: 6px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    display: none;
    z-index: 10;
}

.category-dropdown-menu.show {
    display: block;
}

.category-dropdown-item {
    display: block;
    padding: 10px;
    color: black;
    text-decoration: none;
    transition: background 0.3s;
}

.category-dropdown-item:hover {
    background: rgba(255, 165, 0, 0.2);
}

/* Form Styling */
.category-form-group label {
    font-weight: 600;
    color: #333;
}

input[type="text"] {
    border-radius: 6px;
    border: 1px solid #ccc;
    padding: 10px;
    width: 100%;
}
h1{
    margin-top: 30px;
}

/* Button Styling */
.category-btn-primary {
    background: rgb(183, 90, 23);
    color: white;
    border: none;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.category-btn-primary:hover {
    background: rgb(150, 70, 15);
    transform: scale(1.05);
}

.category-btn-secondary {
    background: #ccc;
    color: black;
    border: none;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.category-btn-secondary:hover {
    background: #bbb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .col-md-6 {
        width: 100%;
        margin-bottom: 20px;
    }
}
.category-form-group{
    margin: 10px;
    font-size: 30px;
}

</style>