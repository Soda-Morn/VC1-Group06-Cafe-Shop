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

<div class="container">
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
            <button class="add-new-btn order-btn"><a href=""></a><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>

    <!-- Product Cards -->
    <div class="row" id="product-list">
        <!-- Row 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="250.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Cappuccino Coffee</h6>
                    <h4>$250.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="150.50">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Latte Coffee</h6>
                    <h4>$150.50</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="200.75">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Espresso</h6>
                    <h4>$200.75</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="175.30">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Mocha</h6>
                    <h4>$175.30</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="220.90">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Americano</h6>
                    <h4>$220.90</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="195.00">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Flat White</h6>
                    <h4>$195.00</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="230.20">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Macchiato</h6>
                    <h4>$230.20</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="210.10">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">Iced Coffee</h6>
                    <h4>$210.10</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
