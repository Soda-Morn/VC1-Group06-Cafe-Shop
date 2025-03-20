<style>
    .add-new-btn {
        background: #28a745;
        color: white;
        font-size: 1rem; /* Slightly smaller font size */
        font-weight: bold;
        text-align: center;
        padding: 8px 12px; /* Smaller padding */
        border-radius: 5px;
        text-decoration: none;
        width: auto; /* Automatic width */
        margin-left: 10px; /* Space between title and button */
    }

    .add-new-container {
        display: flex;
        justify-content: space-between; /* Space between title and button */
        align-items: center; /* Centers vertically */
        margin-bottom: 20px;
        margin-top: 5%; /* Space below the header */
    }

    /* Card styles */
    .card {
        margin-bottom: 20px; /* Space between cards */
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .add-new-container {
            flex-direction: row; /* Keep items in a row */
            align-items: center; /* Align items in the center */
            justify-content: space-between;
            margin-top: 15%; /* Space between title and button */
        }

        .add-new-btn {
            margin-top: 0; /* Remove spacing above button */
            width: auto; /* Auto width for smaller screens */
            font-size: 0.9rem; /* Slightly smaller font size for smaller screens */
        }

        /* Ensure cards are responsive */
        .row > div {
            flex: 1 0 100%; /* Take full width on small screens */
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Coffee Menu Section -->
        <div class="col-md-12 p-4 bg-light">
            <div class="add-new-container">
                <h2 class="text-uppercase fw-bold mb-0">Coffee Menu</h2>
                <a href="/order_menu/create" class="text-white add-new-btn">Add new</a>
            </div>
            <div class="row">
                <?php foreach ($products as $item): ?>
                    <div class="col-md-3 col-sm-6 mb-4"> <!-- Adjust for smaller screens -->
                        <div class="card h-100 text-center position-relative">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['name'] ?>" style="height: 150px; object-fit: cover;">
                            <!-- Delete Icon -->
                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" style="z-index: 1;">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="card-body p-2">
                                <h4 class="card-title mb-1"> <?= $item['name'] ?> </h4>
                                <p class="card-text mb-1" style="font-size: 0.9rem;"> <?= $item['description'] ?> </p>
                                <span class="fw-bold">$<?= $item['price'] ?></span>
                                <form action="/orderCard/addToCart" method="POST" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_ID'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>