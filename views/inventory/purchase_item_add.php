<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/purchase_Item_add.css">
</head>
<body>

<div class="container mt-4">
    <!-- Header Section -->
    <div class="header">
        <h2>Purchase Item Add</h2>
        <div class="header-controls">
            <button class="add-new-btn"><i class="fas fa-plus"></i> Add New</button>
            <select class="sort-dropdown">
                <option value="">Sort by</option>
                <option value="price-low">Low to High</option>
                <option value="price-high">High to Low</option>
            </select>
            <button class="add-new-btn order-btn"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>

    <!-- Product Cards -->
    <div class="row" id="product-list">
        <!-- Product Card 1 -->
        <div class="col-md-4 mb-4" data-price="250.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Capucino Coffee</h6>
                    <h4>$250.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- Product Card 2 -->
        <div class="col-md-4 mb-4" data-price="199.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Espresso Coffee</h6>
                    <h4>$199.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- Product Card 3 -->
        <div class="col-md-4 mb-4" data-price="180.50">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Latte Coffee</h6>
                    <h4>$180.50</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 1 -->
        <div class="col-md-4 mb-4" data-price="250.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Capucino Coffee</h6>
                    <h4>$250.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- Product Card 2 -->
        <div class="col-md-4 mb-4" data-price="199.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Espresso Coffee</h6>
                    <h4>$199.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- Product Card 3 -->
        <div class="col-md-4 mb-4" data-price="180.50">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Latte Coffee</h6>
                    <h4>$180.50</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add New Button Alert
    document.querySelector('.add-new-btn').addEventListener('click', () => {
        alert('Add New feature coming soon!');
    });

    // Edit Button Alert
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
            alert('Edit feature coming soon!');
        });
    });

    // Delete Button Functionality
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            if (confirm('Are you sure you want to delete this item?')) {
                event.target.closest('.col-md-4').remove();
            }
        });
    });

    // Sorting Functionality
    document.querySelector('.sort-dropdown').addEventListener('change', function () {
        let productList = document.getElementById('product-list');
        let products = Array.from(productList.children);
        let sortType = this.value;

        products.sort((a, b) => {
            let priceA = parseFloat(a.getAttribute('data-price'));
            let priceB = parseFloat(b.getAttribute('data-price'));
            return sortType === "price-low" ? priceA - priceB : priceB - priceA;
        });

        productList.innerHTML = "";
        products.forEach(product => productList.appendChild(product));
    });
</script>

</body>
</html>
