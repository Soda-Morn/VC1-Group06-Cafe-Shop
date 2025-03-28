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
                            <tbody>
                                <?php $i = 1; foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= $i++ ?></td> <!-- Start the counter from 1 -->
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

    // Close the dropdown when an action is selected
    const actionLinks = document.querySelectorAll('.category-dropdown-item');
    actionLinks.forEach(function(link) {
        link.addEventListener('click', function (event) {
            const dropdownMenu = event.target.closest('.category-dropdown-menu');
            dropdownMenu.classList.remove('show');  // Close the dropdown after an action is selected
        });
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
    box-shadow: none; /* Removed box-shadow */
}

.category-table th, 
.category-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.category-table th {
    background: #f7f7f7;
    font-weight: 600;
}

.category-table tr {
    transition: background 0.3s ease;
}

.category-table tr:hover {
    background: rgba(255, 165, 0, 0.2);
}

/* Actions Column */
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

/* Dropdown Menu */
.category-dropdown-menu {
    position: absolute;
    top: 0.1px;
    right: 0;
    background: white;
    height: 60px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    display: none;
    z-index: 10;
    min-width: 90px;
    
}

/* Show dropdown when active */
.category-dropdown-menu.show {
    display: block;
}

/* Dropdown Row for icons */
.category-dropdown-row {
    display: flex;
    justify-content: space-around;
    align-items: center;
    gap: 10px;
    
}

/* Dropdown Item Styling */
.category-dropdown-item {
    display: block;
    padding: 10px;
    color: black;
    text-decoration: none;
    font-size: 12px;
}

.category-dropdown-item i {
    font-size: 16px;
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

h1 {
    margin-top: 30px;
}

/* Button Styling */
.btn-primary {
    color: white !important;
    border: none;
    padding: 7px 10px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
}

.btn-danger {
    background-color: red !important;
    color: white !important;
    border: none;
    padding: 6px 10px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
}

/* Scrollable Table Container */
.table-container {
    max-height: 300px;
    overflow-y: auto;
}

/* Icon Size for Edit and Delete */
.category-icon {
    font-size: 10px;
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

.category-form-group {
    margin: 10px;
    font-size: 30px;
}
</style>
