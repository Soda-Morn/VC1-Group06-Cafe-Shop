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
                            </tbody>
                        </table>
                    </div>
                    <!-- Fixed pagination controls -->
                    <div class="pagination-footer">
                        <button class="btn btn-primary pagination-btn" id="prev-button" onclick="changePage('prev')">
                            Previous
                        </button>
                        <button class="btn btn-primary pagination-btn" id="next-button" onclick="changePage('next')">
                            Next
                        </button>
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
document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown buttons
    const dropdownButtons = document.querySelectorAll('[data-toggle="dropdown"]');
    
    // Close all dropdowns except the one clicked
    function closeAllDropdowns(exceptThisOne) {
        document.querySelectorAll('.category-dropdown-menu').forEach(menu => {
            if (menu !== exceptThisOne) {
                menu.classList.remove('show');
            }
        });
    }
    
    // Add click event to each dropdown button
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdownMenu = this.nextElementSibling;
            const isOpen = dropdownMenu.classList.contains('show');
            
            // Close all dropdowns first
            closeAllDropdowns(dropdownMenu);
            
            // Toggle the clicked one
            dropdownMenu.classList.toggle('show', !isOpen);
        });
    });
    
    // Close dropdowns when clicking elsewhere
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            closeAllDropdowns(null);
        }
    });
});
</script>

<style>
    /* General Container Styling */
    .category-container {
        max-width: 97%;
        margin: auto;
        padding: 3px;
    }

    /* Card Styling */
    .category-card {
        margin-top: 15px;
        border-radius: 12px;
        border: none;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .category-card-header {
        background: rgb(204, 121, 61);
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 10px;
        border-radius: 12px 12px 0 0;
    }

    /* Table Styling - No Scroll */
    .table-container {
        height: auto;
        overflow: visible;
        position: relative; /* Ensure dropdown can position relative to this */
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: visible; /* Ensure dropdown isn't clipped */
        box-shadow: none;
        table-layout: fixed;
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
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: none;
        z-index: 1000; /* Increased z-index to ensure visibility */
        min-width: 120px;
        padding: 8px 0;
    }

    .category-dropdown-menu.show {
        display: block;
    }

    .category-dropdown-row {
        display: flex;
        flex-direction: column;
    }

    /* Enhanced but Minimal Action Links */
    .category-dropdown-item {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .category-dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .category-dropdown-item i {
        font-size: 18px;
        margin-right: 8px;
        vertical-align: middle;
    }

    .category-dropdown-item.text-danger {
        color: #dc3545;
    }

    .category-dropdown-item.text-danger:hover {
        color: #c82333;
        background-color: #f8f9fa;
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
        font-size: 14px;
    }

    /* Header Styling */
    h1 {
        margin-top: 70px;
        font-size: 30px;
        color: #333;
    }

    /* Button Styling */
    .btn-primary {
        color: white !important;
        background-color: rgb(204, 121, 61);
        border: none;
        padding: 8px 16px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #e67e00;
    }

    .btn-danger {
        background-color: #dc3545 !important;
        color: white !important;
        border: none;
        padding: 8px 16px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333 !important;
    }

    /* Pagination Footer - Right Aligned */
    .pagination-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px;
        width: 100%;
    }

    .pagination-btn {
        padding: 8px 16px;
        background-color: rgb(204, 121, 61);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination-btn:hover {
        background-color: #e67e00;
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

        .pagination-footer {
            justify-content: center;
        }
    }

    .category-form-group {
        margin: 10px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown buttons
    const dropdownButtons = document.querySelectorAll('[data-toggle="dropdown"]');

    function closeAllDropdowns(exceptThisOne) {
        document.querySelectorAll('.category-dropdown-menu').forEach(menu => {
            if (menu !== exceptThisOne) {
                menu.classList.remove('show');
            }
        });
    }

    dropdownButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdownMenu = this.nextElementSibling;
            const isOpen = dropdownMenu.classList.contains('show');

            closeAllDropdowns(dropdownMenu); // Close all before opening the new one

            if (!isOpen) {
                dropdownMenu.classList.add('show');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            closeAllDropdowns(null);
        }
    });
});

</script>
<script src="views/assets/js/Language_options/category-o.js"></script>

