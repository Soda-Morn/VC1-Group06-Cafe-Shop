    <style>
        .container {
            background: rgb(245, 247, 250);
            margin: auto;
            width: 90%;
        }
        
        :root {
            --primary-color: #28A745;
            --secondary-color: #6c757d;
            --text-dark: #343a40;
            --button-color: rgb(183, 90, 23);
            --border-radius: 5px;
        }

        .custom-dropdown {
            position: relative;
        }
        #product-list {
            padding-left: 15px; /* Matches the margin-left of the .fixed-header (Restock) */
            padding-right: 15px; /* Ensures the right side aligns with the container's content */
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

        .custom-dropdown-menu.show {
            display: block;
        }

        .custom-dropdown-item {
            display: block;
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
        }

        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            background-color: white;
            cursor: default;
            width: 100%;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
        }

        .price {
            font-weight: 700;
            color: black;
            font-size: 1rem;
            margin-bottom: 0;
        }

        .stock {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .btn-add-to-cart {
            padding: 6px 8px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-top: 1px;
            background: var(--button-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 65%;
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

        .fixed-header {
            top: 0;
            z-index: 10;
            padding: 15px 0;
            margin: 10px 15px 6px;
        }

        .search-container {
            position: relative;
            margin-right: 10px;
        }

        .search-input {
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
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

        .product-image-container {
            height: 120px;
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

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            text-transform: capitalize;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .card-body {
            padding: 0.75rem 1rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .pagination {
            justify-content: center;
            margin-top: 3px;
            margin-left: 85%;
        }

        .pagination .btn {
            margin: 0 10px;
            background: var(--button-color);
            color: white;
            border: none;
            
        }

        .pagination .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Additional styles for dropdown functionality */
        .product-ellipsis-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            color: #6c757d;
        }

        .product-ellipsis-btn:hover {
            color: #495057;
        }

        .product-ellipsis-btn:focus {
            outline: none;
        }

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
    <div class="container py-4">
        <div class="fixed-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Restock</h2>
                <div class="header-controls d-flex align-items-center">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="product-search" class="search-input" placeholder="Search products..." aria-label="Search products">
                        <button type="button" id="search-clear" class="search-clear" aria-label="Clear search">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <button id="search-toggle" class="btn search-button d-md-none" type="button" aria-label="Toggle search">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="/purchase_item_add/create" class="btn-Added" id="add-product-btn" style="font-family: 'Poppins', sans-serif;">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
            </div>
        </div>

        <?php
        $itemsPerPage = 10;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $totalItems = count($products);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        $paginatedProducts = array_slice($products, $startIndex, $itemsPerPage);
        ?>

        <div class="row row-cols-md-3 row-cols-lg-5 g-0 mb-4 justify-content-start" id="product-list">
            <?php if (empty($paginatedProducts)): ?>
                <div class="col-12">
                    <p class="text-muted text-center">No products found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($paginatedProducts as $item): ?>
                    <div class="col product-item">
                        <div class="card">
                            <div class="edit-delete-icons text-end p-2">
                                <div class="custom-dropdown">
                                    <button class="btn btn-sm p-0 product-ellipsis-btn" type="button" aria-label="Options" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="custom-dropdown-menu">
                                        <a class="custom-dropdown-item edit-product-item" href="/purchase_item_add/edit/<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            <i class="fas fa-edit me-2"></i> Edit
                                        </a>
                                        <button class="custom-dropdown-item delete-product-item" type="button" data-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                            <i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-image-container">
                                <img src="<?= htmlspecialchars($item['product_image'] ?? 'uploads/default.jpg') ?>" class="card-img-top" alt="Product Image">
                            </div>

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

        <?php if ($totalPages > 1): ?>
            <div class="pagination d-flex">
                <a href="?page=<?= $currentPage - 1 ?>" class="btn <?= $currentPage <= 1 ? 'disabled' : '' ?>">Previous</a>
                <a href="?page=<?= $currentPage + 1 ?>" class="btn <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">Next</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Prevent script from running multiple times
        if (!window.dropdownInitialized) {
            window.dropdownInitialized = true;

            document.addEventListener('DOMContentLoaded', function() {
                // Dropdown functionality: Toggle dropdown and ensure only one is open at a time
                const dropdownButtons = document.querySelectorAll('[data-toggle="dropdown"]');
                console.log(`Found ${dropdownButtons.length} dropdown buttons`);

                function closeAllDropdowns() {
                    const allDropdowns = document.querySelectorAll('.custom-dropdown-menu');
                    console.log(`Total dropdown menus found: ${allDropdowns.length}`);

                    const openDropdownsBefore = document.querySelectorAll('.custom-dropdown-menu.show').length;
                    console.log(`Number of open dropdowns before closing: ${openDropdownsBefore}`);

                    allDropdowns.forEach((menu, index) => {
                        const parentCard = menu.closest('.product-item');
                        const productName = parentCard ? parentCard.querySelector('.product-name').textContent : `Unknown-${index}`;
                        if (menu.classList.contains('show')) {
                            console.log(`Closing dropdown for product: ${productName}`);
                            menu.classList.remove('show');
                            menu.style.display = 'none'; // Force hide
                        }
                    });

                    const openDropdownsAfter = document.querySelectorAll('.custom-dropdown-menu.show').length;
                    console.log(`Number of open dropdowns after closing: ${openDropdownsAfter}`);
                }

                // Remove any existing click event listeners to prevent duplicates
                dropdownButtons.forEach(button => {
                    // Clone the button to remove existing event listeners
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                });

                // Re-select buttons after cloning
                const refreshedDropdownButtons = document.querySelectorAll('[data-toggle="dropdown"]');
                refreshedDropdownButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const dropdownMenu = this.nextElementSibling;
                        const parentCard = this.closest('.product-item');
                        const productName = parentCard ? parentCard.querySelector('.product-name').textContent : 'Unknown';
                        const isOpen = dropdownMenu.classList.contains('show');

                        console.log(`Icon clicked on product: ${productName}. Dropdown isOpen: ${isOpen}`);

                        // Close all dropdowns
                        closeAllDropdowns();

                        // Toggle the current dropdown
                        if (!isOpen) {
                            setTimeout(() => {
                                dropdownMenu.classList.add('show');
                                dropdownMenu.style.display = 'block'; // Force show
                                console.log(`Dropdown opened for product: ${productName}`);
                            }, 10); // Small delay to ensure DOM updates
                        } else {
                            console.log(`Dropdown remains closed for product: ${productName}`);
                        }
                    });
                });

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.custom-dropdown')) {
                        closeAllDropdowns();
                    }
                });

                // Close dropdown when clicking Edit or Delete
                document.querySelectorAll('.edit-product-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const dropdownMenu = this.closest('.custom-dropdown-menu');
                        if (dropdownMenu) {
                            dropdownMenu.classList.remove('show');
                            dropdownMenu.style.display = 'none';
                        }
                    });
                });

                document.querySelectorAll('.delete-product-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        const dropdownMenu = this.closest('.custom-dropdown-menu');
                        if (dropdownMenu) {
                            dropdownMenu.classList.remove('show');
                            dropdownMenu.style.display = 'none';
                        }
                    });
                });

                // Delete functionality with error handling
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
                        const originalContent = button.innerHTML;
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
                                    button.innerHTML = originalContent;
                                    button.disabled = false;
                                });
                        }, 300); // 300ms delay for better UX
                    });
                });

                // Search functionality
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
        } else {
            console.log('Dropdown script already initialized, skipping...');
        }
    </script>
    <script src="/views/assets/js/Language_options/purchase-item-add-o.js"></script>