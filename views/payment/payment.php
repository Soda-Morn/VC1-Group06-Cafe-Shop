<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valea Cafe - Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .payment-container {
            margin-top: 100px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .btn-pay, .btn-qr, .btn-confirm-qr {
            padding: 10px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-pay {
            background-color: #28a745;
            border: none;
        }
        .btn-pay:hover {
            background-color: #218838;
        }
        .btn-qr {
            background-color: #007bff;
            border: none;
        }
        .btn-qr:hover {
            background-color: #0056b3;
        }
        .btn-confirm-qr {
            background-color: #dc3545;
            border: none;
        }
        .btn-confirm-qr:hover {
            background-color: #c82333;
        }
        .qr-code {
            display: none;
            margin-top: 20px;
        }
        .qr-code img {
            max-width: 150px;
            border: 2px solid #ddd;
            border-radius: 10px;
        }
        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="payment-container card shadow-sm border-0">
        <div class="card-body text-center p-4">
            <div class="total-price mb-4">
                Total Price: $<?= isset($totalPrice) ? number_format($totalPrice, 2) : '40.00' ?>
            </div>
            <p class="text-muted mb-4">Please select a payment method to proceed.</p>

            <div class="d-flex flex-column mb-4">
                <!-- Pay by Cash Option -->
                <form action="/orderCard/checkout" method="POST" class="mb-3">
                    <input type="hidden" name="payment_method" value="cash">
                    <button type="submit" class="btn-pay btn btn-success btn-block rounded">
                        <i class="fas fa-money-bill-wave mr-2"></i> Pay by Cash
                    </button>
                </form>

                <!-- Pay by QR Code Option -->
                <button type="button" class="btn-qr btn btn-primary btn-block rounded" id="pay-by-qr">
                    <i class="fas fa-qrcode mr-2"></i> Pay by QR Code
                </button>
            </div>

            <!-- QR Code Section (Hidden by Default) -->
            <div class="qr-code bg-light p-3 rounded" id="qr-code-section">
                <?php if (!empty($qrImagePath)): ?>
                    <img src="/<?= htmlspecialchars($qrImagePath) ?>" alt="QR Code" class="img-fluid rounded mb-3">
                <?php else: ?>
                    <p class="text-danger">QR Code not available.</p>
                <?php endif; ?>
                <p class="text-muted mb-3">Scan the QR code to pay $<?= isset($totalPrice) ? number_format($totalPrice, 2) : '40.00' ?></p>
                <form action="/orderCard/checkout" method="POST">
                    <input type="hidden" name="payment_method" value="qr">
                    <button type="submit" class="btn-confirm-qr btn btn-danger btn-block rounded">
                        <i class="fas fa-check mr-2"></i> Confirm QR Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('pay-by-qr').addEventListener('click', function() {
            document.getElementById('qr-code-section').style.display = 'block';
            this.style.display = 'none'; // Hide the "Pay by QR Code" button after clicking
        });
    </script>
</body>
</html>