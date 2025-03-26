<div class="category-container mt-4">
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
                            <label for="name">Category Name</label>
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
    margin-top: 60px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: none;
    background: #fff;
}

.category-card-header {
    background:orange;
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    border-radius: 12px 12px 0 0;
}

/* Table Styling */
.category-table {
    width: 100%;
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
}

.category-table th {
    background: #f1f3f5;
    text-align: center;
    font-weight: 600;
    padding: 12px;
    border-bottom: 2px solid #ddd;
}

.category-table td {
    vertical-align: middle;
    text-align: center;
    padding: 10px;
}

/* Action Buttons */
.category-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.dropdown button {
    border: none;
    background: transparent;
    cursor: pointer;
}

.category-dropdown-menu {
    min-width: 150px;
    background: white;
    border-radius: 6px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    border: none;
    display: none; /* Hide dropdown menu by default */
}

.category-dropdown-menu.show {
    display: block; /* Show dropdown when toggled */
}

.category-dropdown-item {
    padding: 8px 15px;
}

.category-dropdown-item i {
    margin-right: 8px; /* Adjust space between icon and text */
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
/* Create Button Styling */
.category-btn-primary {
    background: #ff8a00;  /* Orange background */
    color: white;         /* White text color */
    border: none;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transitions */
}

.category-btn-primary:hover {
    background: #e76a00;  /* Darker orange on hover */
    transform: translateY(-2px); /* Lift the button slightly */
}

.category-btn-primary:active {
    background: #e56a00;  /* Slightly darker orange when active */
    transform: translateY(0); /* Button presses down when clicked */
}

.category-btn-secondary {
    background: #f1f3f5;  /* Light gray background */
    color: #333;           /* Dark text */
    border: 1px solid #ccc;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 6px;
    text-align: center;
    display: inline-block;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.category-btn-secondary:hover {
    background: #e0e2e5;  /* Darker gray on hover */
    transform: translateY(-2px); /* Lift the button slightly */
}

.category-btn-secondary:active {
    background: #d1d4d7;  /* Even darker gray when active */
    transform: translateY(0); /* Button presses down when clicked */
}

</style>
