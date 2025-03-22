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
        .custom-dropdown {
            position: relative;
        }
        .custom-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
            background-color: #f0f0f0;
        }
        .card {
            margin: 10px;
            border: none; /* No border */
            background: rgb(255, 255, 255); /* Card background */
            max-width: 200px; /* Set max width for smaller cards */
            margin: auto; /* Center the card */
        }
        .price {
            font-weight: bold;
            color: black; /* Price color */
        }
        .stock {
            color: black; /* Stock color */
            font-weight: bold;/* Make stock text bold */
        }
        .btn-add-to-cart {
            padding: 5px 10px; /* Adjust padding for button */
            font-size: 0.9rem; /* Smaller font size */
            font-weight: bold;
            margin-top: 10px;
            background:rgb(183, 90, 23); /* Button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            border-radius: 5px; 
            cursor: default; /* Prevent hover effect */
        }
        .btn-outline-primary{
            background: #28A745;
            color: rgb(255, 255, 255); /* Button color */
            border: 1px solid rgb(255, 255, 255); /* Button border */
            border-radius: 5px;
        }
        .fixed-header {
            top: 0;
            background-color: rgb(255, 255, 255);
            z-index: 10;
            padding: 15px 0;
            margin-top: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }
        @media (max-width: 576px) { /* Mobile styles */
            .card {
                margin-left: 10px;
                margin-right: 10px; /* Ensure consistent margin */
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Fixed Header Section -->
        <div class="fixed-header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Restock</h2>
                <div class="header-controls">
                    <a href="/purchase_item_add/create" class="btn btn-outline-primary" style="font-family: 'Poppins', sans-serif;">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
            </div>
        </div>
        <!-- Product Cards -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-4" id="product-list">
            <?php if (empty($products)): ?>
                <div class="col-12">
                    <p class="text-muted text-center">No products found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $item): ?>
                    <div class="col">
                        <div class="card shadow-sm rounded-3 overflow-hidden">
                             
                            <!-- Vertical Ellipsis Dropdown Menu -->
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
                            <div style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                <img src="<?= htmlspecialchars($item['product_image'] ?? 'uploads/default.jpg') ?>" class="card-img-top" 
                                     style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Product Image">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body text-center" style="padding-top: 10px;">
                                <h5 class="fw-bold text-dark" style="font-size: 1rem; text-transform: capitalize;">
                                    <?= htmlspecialchars($item['product_name']) ?>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="price mb-0" style="font-size: 0.9rem;">
                                        $<span><?= htmlspecialchars($item['price']) ?></span>
                                    </h6>
                                    <span class="stock">
                                        Qty: <?= htmlspecialchars($item['stock_quantity']) ?>
                                    </span>
                                </div>
                                <form action="/restock_checkout/addStock" method="POST" class="d-inline">
                                    <input type="hidden" name="purchase_item_id" value="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                    <button type="submit" class="btn btn-add-to-cart" style="font-family: 'Poppins', sans-serif;" >Add to stock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- JavaScript for Delete Confirmation -->
    <script>
        document.querySelectorAll('.delete-product-item').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const id = this.getAttribute('data-id');
                    window.location.href = `/purchase_item/destroy/${id}`;
                }
            });
        });
    </script>
</body>
</html>