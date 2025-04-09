<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valea Cafe - Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6C4AB6;
            --secondary: #8D72E1;
            --success: #4CAF50;
            --info: #2196F3;
            --light: #F8F9FA;
            --dark: #212529;
            --brown: #a04d13;
        }
        
        .payment-container {
            width: 100%;
            max-width: 600px; /* Reduced from 700px */
            animation: fadeIn 0.5s ease;
            margin-left: 330px; 
            margin-top: 30px;/* Reduced from 250px */
        }
        
        .card {
            border: none;
            border-radius: 20px; /* Reduced from 25px */
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12); /* Slightly smaller shadow */
            overflow: hidden;
            transition: all 0.3s ease;
            transform: scale(1.01); /* Reduced from 1.02 */
            margin-top: 94px; /* Reduced from 100px */
        }
        
        .card:hover {
            transform: scale(1.02) translateY(-4px); /* Adjusted from 1.03 and -5px */
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--brown), var(--brown));
            color: white;
            text-align: center;
            padding: 20px; /* Reduced from 25px */
            border-bottom: none;
        }
        
        .card-header h4 {
            font-weight: 700;
            font-size: 1.4rem; /* Reduced from 1.5rem */
            margin: 0;
            background: #a04d13;
        }
        
        .card-body {
            padding: 2px; /* Reduced from 3px */
        }
        
        .total-price {
            font-size: 1.8rem; /* Reduced from 2rem */
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px; /* Reduced from 15px */
            text-align: center;
        }
        
        .total-price span {
            color: var(--primary);
            font-weight: 800;
        }
        
        .payment-methods {
            margin: 25px 0; /* Reduced from 30px */
        }
        
        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px; /* Reduced from 18px */
            margin-bottom: 15px; /* Reduced from 20px */
            border-radius: 12px; /* Reduced from 15px */
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            background-color: white;
        }
        
        .payment-option:hover {
            border-color: var(--secondary);
            box-shadow: 0 6px 18px rgba(108, 74, 182, 0.15); /* Slightly smaller shadow */
            transform: translateY(-2px); /* Reduced from -3px */
        }
        
        .payment-option i {
            font-size: 1.6rem; /* Reduced from 1.8rem */
            margin-right: 15px; /* Reduced from 20px */
            width: 45px; /* Reduced from 50px */
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            transition: transform 0.3s ease;
        }
        
        .payment-option:hover i {
            transform: scale(1.08); /* Slightly reduced from 1.1 */
        }
        
        .payment-option .content {
            flex: 1;
        }
        
        .payment-option .title {
            font-weight: 600;
            margin-bottom: 4px; /* Reduced from 5px */
            font-size: 1rem; /* Reduced from 1.1rem */
        }
        
        .payment-option .desc {
            font-size: 0.85rem; /* Reduced from 0.9rem */
            color: #6c757d;
        }
        
        .cash-option i {
            background-color: var(--success);
        }
        
        .qr-option i {
            background-color: var(--info);
        }
        
        /* Changed cash icon to checkmark */
        .cash-option i::before {
            content: "\f00c"; /* FontAwesome checkmark */
        }
        
        .qr-code-container {
            text-align: center;
            padding: 20px; /* Reduced from 25px */
            background-color: #f8f9fa;
            border-radius: 12px; /* Reduced from 15px */
            margin-top: 20px; /* Reduced from 25px */
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .qr-code {
            width: 180px; /* Reduced from 200px */
            height: 180px;
            margin: 0 auto 15px; /* Reduced from 20px */
            padding: 12px; /* Reduced from 15px */
            background-color: white;
            border-radius: 12px; /* Reduced from 15px */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); /* Slightly smaller shadow */
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .btn-confirm {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 12px; /* Reduced from 15px */
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-top: 20px; /* Reduced from 25px */
            width: 100%;
            border-radius: 12px; /* Reduced from 15px */
            transition: all 0.3s ease;
            font-size: 1rem; /* Reduced from 1.1rem */
        }
        
        .btn-confirm:hover {
            transform: translateY(-2px); /* Reduced from -3px */
            box-shadow: 0 6px 20px rgba(108, 74, 182, 0.3); /* Slightly smaller shadow */
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); } /* Reduced from 15px */
            to { opacity: 1; transform: translateY(0); }
        }
        
        .payment-instructions {
            font-size: 0.85rem; /* Reduced from 0.9rem */
            color: #6c757d;
            text-align: center;
            margin-top: 15px; /* Reduced from 20px */
            line-height: 1.5; /* Slightly reduced from 1.6 */
        }
    </style>
</head>
<body>
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
                    <p class="payment-instructions">Open your mobile banking app and scan the QR code to complete payment</p>
                    
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
    <script>
        document.getElementById('showQrBtn').addEventListener('click', function() {
            const qrContainer = document.getElementById('qrCodeContainer');
            qrContainer.style.display = 'block';
            this.style.display = 'none';
            
            // Scroll to QR code for better UX
            qrContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
        
        // Add animation when page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.payment-container').style.opacity = '1';
        });
    </script>
    <script src="views/assets/js/Language_options/payment-o.js"></script>
</body>
</html>