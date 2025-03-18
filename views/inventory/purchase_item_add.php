<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sip & Shop</title>
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Load DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Load your custom JS -->
    <script src="/views/assets/js/kaladmin.min.js"></script>
</head>
<body>
    <div class="container py-4" style="background-color: #f0f4f8;">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">Sip & Shop</h2>
            <div class="header-controls">
                <a href="/purchase_item_add/create" class="btn btn-outline-primary me-2 shadow-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
                <button class="btn btn-success shadow-sm">
                    <i class="fas fa-shopping-cart"></i> Order Now
                </button>
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4" id="product-list">
            <?php foreach ($products as $item): ?>
                <div class="col">
                    <div class="card shadow-sm rounded-3 overflow-hidden"
                        style="background: linear-gradient(135deg, #fffaf5, #fff); border: none;">
                        
                        <!-- Vertical Ellipsis Dropdown Menu -->
                        <div class="edit-delete-icons text-end p-2">
                            <div class="custom-dropdown">
                                <button class="btn btn-sm p-0 ellipsis-btn" type="button">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="custom-dropdown-menu">
                                    <a class="custom-dropdown-item" href="/purchase_item_add/edit/<?= $item['purchase_item_id'] ?>">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>

                                    <!-- Delete Form (added POST method for security) -->
                                    <form action="/purchase_item_add/destroy/<?= $item['purchase_item_id'] ?>" method="POST" class="custom-dropdown-item">
                                        <button type="submit" class="btn btn-sm text-danger p-0">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Product Image -->
                        <img src="<?= $item['product_image'] ?>" class="card-img-top"
                            style="height: 150px; object-fit: cover; transition: transform 0.3s ease;" alt="<?= $item['product_name'] ?>">

                        <!-- Card Body -->
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-dark" style="font-size: 1.2rem; text-transform: capitalize;">
                                <?= htmlspecialchars($item['product_name']) ?>
                            </h5>
                            <h6 class="text-success mb-2" style="font-size: 1rem; font-weight: 700;">
                                $<span class="price"><?= number_format($item['price'], 2) ?></span>
                            </h6>
                            <form action="/restock_checkout/addStock" method="POST" class="d-inline">
                                <input type="hidden" name="purchase_item_id" value="<?= $item['purchase_item_id'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>