<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page - Purr Coffee</title>
    <link rel="stylesheet" href="views/assets/css/order_menu.css">
    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Coffee Menu Section -->
        <div class="section coffee-menu">
            <h2>COFFEE MENU</h2>
            <div class="card-container">
                <div class="card menu-item" data-name="Cappuccino" data-price="5.98">
                    <img src="https://i.pinimg.com/736x/da/71/58/da7158a292ecb104256322d50588205c.jpg" alt="Cappuccino">
                    <h3>Cappuccino</h3>
                    <p class="description">The milk composition of coffee, milk, and sugar.</p>
                    <span class="item-price">$5.98</span>
                    <button class="action-btn add-to-cart">Add to cart</button>
                </div>
                <div class="card menu-item" data-name="Coffee Latte" data-price="5.98">
                    <img src="https://i.pinimg.com/736x/9e/60/4d/9e604de056d0f74382c628bcadb7f5a7.jpg" alt="Coffee Latte">
                    <h3>Coffee Latte</h3>
                    <p class="description">One of the most popular types of milk coffee.</p>
                    <span class="item-price">$5.98</span>
                    <button class="action-btn add-to-cart">Add to cart</button>
                </div>
                <div class="card menu-item" data-name="Americano" data-price="5.98">
                    <img src="https://i.pinimg.com/736x/c8/d6/b6/c8d6b6288dba8e9ab546c9291717b2bb.jpg" alt="Americano">
                    <h3>Americano</h3>
                    <p class="description">A coffee drink with espresso and hot water.</p>
                    <span class="item-price">$5.98</span>
                    <button class="action-btn add-to-cart">Add to cart</button>
                </div>
                <div class="card menu-item" data-name="V60" data-price="5.98">
                    <img src="https://i.pinimg.com/736x/19/20/f6/1920f6d29b5225c9ebf0824a5086d175.jpg" alt="V60">
                    <h3>V60</h3>
                    <p class="description">A pour-over brewing method for clean coffee.</p>
                    <span class="item-price">$5.98</span>
                    <button class="action-btn add-to-cart">Add to cart</button>
                </div>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="section cart">
            <h2>CART ORDER <span>#3343</span></h2>
            <div class="card-container">
                <!-- Cart items will be dynamically added here, stacking top to bottom -->
            </div>
            <div class="cart-total">
                <div><span>Items</span><span class="total-items">$0.00</span></div>
                <div><span>Discounts</span><span class="total-discounts">-$3.00</span></div>
                <div><span>Total</span><span class="total-amount">$0.00</span></div>
            </div>
            <button class="place-order">Place an order</button>
        </div>
    </div>

    <script src="views/assets/js/order_menu.js"></script>
</body>
</html>