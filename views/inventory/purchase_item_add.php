<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Items</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Define color variables for consistent theming */
        :root {
            --primary-color: #28A745;
            /* Green for buttons */
            --secondary-color: #6c757d;
            /* Gray for secondary elements */
            --text-dark: #343a40;
            /* Dark text color */
            --button-color: rgb(183, 90, 23);
            /* Orange for add-to-cart button */
            --border-color: #ced4da;
            /* Border color for inputs */
            --border-radius: 5px;
            /* Consistent border radius */
        }

        /* Dropdown menu for edit/delete actions */
        .custom-dropdown {
            position: relative;
        }

        .custom-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            min-width: 120px;
        }

        .custom-dropdown:hover .custom-dropdown-menu {
            display: block;
        }

        .custom-dropdown-item {
            display: block;
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
        }

        .custom-dropdown-item:hover {
            background-color: rgb(255, 252, 252);
        }

        /* Updated Product card styling to match coffee menu */
        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            background-color: white;
            height: 94%;
            margin: 0 1px 15px;
            max-width: none;
            cursor: default;
            margin-left: 10px;
            margin-right: 10px; 	
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
        }

        /* Price and stock text styling */
        .price {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .stock {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Add to stock button styling */
        .btn-add-to-cart {
            padding: 5px 10px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-top: 10px;
            background: var(--button-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 60%;
        }
        
        .btn-add-to-cart:hover {
            background-color: #a04d13;
        }
        
        .btn-add-to-cart:focus {
            outline: none;
        }
        
        .btn-Added {
            background: rgb(183, 90, 23);
            color: rgb(255, 255, 255);
            border: 1px solid rgb(255, 255, 255);
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 1rem;
        }
        
        .btn-Added:hover{
            color: #ffffff;
        }

        /* Header section styling */
        .fixed-header {
            top: 0;
            background-color: white;
            z-index: 10;
            padding: 15px 0;
            margin: 5px 10px 4px;
        }

        /* Search input styling */
        .search-container {
            position: relative;
            margin-right: 10px;
        }

        .search-input {
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            padding: 6px 12px 6px 35px;
            width: 200px;
        }
        
        .search-input:focus {
            border-color: #007bff;
            outline: none;
        }
        
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }
        
        .search-button {
            color: white;
            border: 1px solid rgb(255, 255, 255);
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-clear {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            display: none;
        }

        /* Product image container */
        .product-image-container {
            height: 155px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            padding: 5px;
        }

        .card-img-top {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        /* Product name styling */
        .product-name {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            text-transform: capitalize;
            margin-bottom: 0.25rem;
        }

        /* Card body styling */
        .card-body {
            padding: 0.75rem 1rem;
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-controls {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-end;
                gap: 5px;
            }

            .search-container {
                order: 1;
                width: 100%;
                margin-top: 10px;
                margin-right: 0;
            }

            .search-input {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .card {
                margin-left: 5px;
                margin-right: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <!-- Fixed Header Section -->
        <div class="fixed-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Restock</h2>
                <div class="header-controls d-flex align-items-center">
                    <!-- Search Form -->
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="product-search" class="search-input" placeholder="Search products..." aria-label="Search products">
                        <button type="button" id="search-clear" class="search-clear" aria-label="Clear search">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- Search Button (visible on mobile) -->
                    <button id="search-toggle" class="btn search-button d-md-none" type="button" aria-label="Toggle search">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="/purchase_item_add/create" class="btn-Added" style="font-family: 'Poppins', sans-serif;">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-2 mb-4" id="product-list">
            <?php if (empty($products)): ?>
                <div class="col-12">
                    <p class="text-muted text-center">No products found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $item): ?>
                    <div class="col product-item">
                        <div class="card">
                            <!-- Dropdown Menu for Edit/Delete -->
                            <div class="edit-delete-icons text-end p-2">
                                <div class="custom-dropdown">
                                    <button class="btn btn-sm p-0 product-ellipsis-btn" type="button" aria-label="Options">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="custom-dropdown-menu">
                                        <a class="custom-dropdown-item" href="/purchase_item_add/edit/<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            <i class="fas fa-edit me-2"></i> Edit
                                        </a>
                                        <button class="custom-dropdown-item delete-product-item" type="button" data-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            <i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="product-image-container">
                                <img src="<?= htmlspecialchars($item['product_image'] ?? 'uploads/default.jpg') ?>" class="card-img-top" alt="Product Image">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="product-name">
                                    <?= htmlspecialchars($item['product_name']) ?>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="price">
                                        $<span><?= htmlspecialchars($item['price']) ?></span>
                                    </h6>
                                    <span class="stock">
                                        Qty: <?= htmlspecialchars($item['stock_quantity']) ?>
                                    </span>
                                </div>
                                <!-- Form to Add Item to Cart -->
                                <form action="/purchase_item_add/addToCart" method="POST" class="d-inline">
                                    <input type="hidden" name="purchase_item_id" value="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                    <button type="submit" class="btn-add-to-cart" style="font-family: 'Poppins', sans-serif;">Add to stock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Replace the existing script section with this -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Delete Functionality with error handling
        document.querySelectorAll('.delete-product-item').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent any default behavior

                // Disable button to prevent multiple clicks
                button.disabled = true;

                const id = this.getAttribute('data-id');
                if (!id) {
                    console.error('No product ID found');
                    button.disabled = false;
                    return;
                }

                // Add a small delay and loading state
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Deleting...';

                setTimeout(() => {
                    fetch(`/purchase_item_add/destroy/${id}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Delete request failed');
                            }
                            // Remove the product card from DOM
                            const card = button.closest('.product-item');
                            if (card) {
                                card.remove();
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting product:', error);
                            // Restore button state on error
                            button.innerHTML = '<i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>';
                            button.disabled = false;
                        });
                }, 300); // 300ms delay for better UX
            });
        });

        // Search Functionality (unchanged)
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search');
            const searchClear = document.getElementById('search-clear');
            const productItems = document.querySelectorAll('.product-item');

            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                searchClear.style.display = searchTerm.length > 0 ? 'block' : 'none';

                productItems.forEach(item => {
                    const productName = item.querySelector('.product-name').textContent.toLowerCase();
                    item.style.display = productName.includes(searchTerm) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterProducts);
            searchClear.addEventListener('click', function() {
                searchInput.value = '';
                filterProducts();
                searchInput.focus();
            });
        });
    </script>
</body>
</html>