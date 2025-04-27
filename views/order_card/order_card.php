<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../views/assets/css/order_card/order_card_menu.css">
<!-- Add this script after your existing <script> tag -->
<script src="../views/assets/js/Language_options/order-card-o.js"></script>
<script src="../views/assets/js/order_card_menu/order_card_menu.js"></script>


<div class="container mt-7">
    <div class="cart-container">
        <a href="/order_menu" class="btn-back">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="cart-header">
            <h2><i class="fas fa-shopping-cart"></i> Your Cart</h2>
            <p><strong>Review your selection:</strong></p>
        </div>

        <form id="checkout-form" action="/orderCard/payment" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <?php $total = 0; ?>
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $index => $item): ?>
                            <tr class="text-center cart-item" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">
                                <td><img src="<?= isset($item['image']) ? htmlspecialchars($item['image']) : 'default_image.png' ?>"
                                        alt="<?= isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A' ?>"
                                        class="img-fluid"></td>
                                <td><?= isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A' ?></td>
                                <td class="item-price">$<?= isset($item['price']) ? number_format($item['price'], 2) : '0.00' ?>
                                </td>
                                <td class="quantity-controls">
                                    <button type="button" class="btn-decrease">−</button>
                                    <input type="number" name="cart[<?= $index ?>][quantity]" class="quantity-input"
                                        value="<?= isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '1' ?>"
                                        min="1">
                                    <input type="hidden" name="cart[<?= $index ?>][product_id]"
                                        value="<?= htmlspecialchars($item['product_ID']) ?>">
                                    <button type="button" class="btn-increase">+</button>
                                </td>
                                <td>
                                    <button type="button" class="btn-remove"
                                        data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">Remove</button>
                                </td>
                            </tr>
                            <?php $total += (isset($item['price']) ? $item['price'] : 0) * (isset($item['quantity']) ? $item['quantity'] : 1); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No items in cart.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="cart-footer">
                <div class="total-price">
                    Total Price: $<span id="total-price"><?= number_format($total, 2) ?></span>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-pdf" id="generate-pdf"><i class="fas fa-file-pdf"></i>PDF</button>
                    <button type="submit" class="btn-checkout"><i class="fas fa-check"></i>Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>