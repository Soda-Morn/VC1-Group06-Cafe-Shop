<link rel="stylesheet" href="../views/assets/css/payment/payment_checkout.css">

<div class="payment-container">
    <div class="card">
        <div class="card-header">
            <h4>Complete Your Payment</h4>
        </div>
        <div class="card-body">
            <div class="total-price">
                Total: <span>$<?= isset($totalPrice) ? number_format($totalPrice, 2) : '40.00' ?></span>
            </div>

            <p class="text-center text-muted mb-4">Select your preferred payment method</p>

            <div class="payment-methods">
                <!-- Pay by Cash Option (now with checkmark icon) -->
                <form action="/orderCard/checkout" method="POST">
                    <input type="hidden" name="payment_method" value="cash">
                    <div class="payment-option cash-option" onclick="this.closest('form').submit()">
                        <i class="fas"></i> <!-- Icon replaced via CSS -->
                        <div class="content">
                            <div class="title">Complete with Cash</div>
                            <div class="desc">Pay directly at the counter</div>
                        </div>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </form>

                <!-- Pay by QR Option -->
                <div class="payment-option qr-option" id="showQrBtn">
                    <i class="fas fa-qrcode"></i>
                    <div class="content">
                        <div class="title">QR Code Payment</div>
                        <div class="desc">Scan to pay digitally</div>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="qr-code-container" id="qrCodeContainer">
                <h5>Scan to Pay</h5>
                <div class="qr-code">
                    <?php if (!empty($qrImagePath)): ?>
                        <img src="/<?= htmlspecialchars($qrImagePath) ?>" alt="QR Code">
                    <?php else: ?>
                        <div class="text-danger p-3">QR Code not available</div>
                    <?php endif; ?>
                </div>
                <p class="payment-instructions">Open your mobile banking app and scan the QR code to complete payment
                </p>

                <form action="/orderCard/checkout" method="POST">
                    <input type="hidden" name="payment_method" value="qr">
                    <button type="submit" class="btn btn-confirm text-white">
                        <i class="fas fa-check-circle mr-2"></i> Confirm Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="views/assets/js/payment/payment_checkout.js"></script>
<script src="views/assets/js/Language_options/payment-o.js"></script>