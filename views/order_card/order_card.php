<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-container {
            width: 78%;
            margin: 15px auto;
            background: white;
            padding: 5px;
            border-radius: 8px;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 8px;
        }

        .cart-header h2 {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .cart-header h2 i {
            margin-right: 6px;
        }

        .cart-header p {
            font-size: 1rem;
            color: #666;
            margin-top: 0;
        }

        .cart-item img {
            width: 50px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .cart-item {
            padding: 1px 0;
            border-bottom: 1px solid #eee;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: bold;
            color: #333;
            border-top: none;
            text-align: center;
            padding: 1px;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
            color: #666;
            padding: 1px;
            font-size: 0.9rem;
        }

        .quantity-controls button {
            border: none;
            width: 24px;
            height: 24px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            background: #007bff;
            color: white;
            border-radius: 4px;
            transition: background 0.3s;
            padding: 0;
            line-height: 1;
        }

        .quantity-controls button:hover {
            background: #0056b3;
        }

        .quantity-input {
            width: 26px;
            text-align: center;
            font-size: 0.9rem;
            border: none;
            outline: none;
            background: transparent;
            margin: 0 2px;
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
        }
        
        .cart-footer {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 15px;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            margin-right: 20px;
        }

        .button-group {
            display: flex;
            gap: 12px;
        }

        .btn-checkout {
            background: #007bff;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-checkout:hover {
            background: #0056b3;
        }

        .btn-checkout i {
            margin-right: 4px;
            font-size: 0.8rem;
        }

        .btn-back {
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 4px;
            color: black;
        }

        .btn-back i {
            margin-right: 4px;
            font-size: 20px;
        }

        .btn-pdf {
            background: #f0ad4e;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-pdf:hover {
            background: #ec971f;
        }

        .btn-pdf i {
            margin-right: 4px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container mt-7">
        <div class="cart-container">
            <a href="/order_menu" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="cart-header">
                <h2><i class="fas fa-shopping-cart"></i> Your Cart</h2>
                <p><strong>Review your selection:</strong></p>
            </div>

            <form id="checkout-form" action="/orderCard/checkout" method="POST">
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
                                            alt="<?= isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A' ?>" class="img-fluid"></td>
                                    <td><?= isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A' ?></td>
                                    <td class="item-price">$<?= isset($item['price']) ? number_format($item['price'], 2) : '0.00' ?></td>
                                    <td class="quantity-controls">
                                        <button type="button" class="btn-decrease">−</button>
                                        <input type="number" name="cart[<?= $index ?>][quantity]" class="quantity-input"
                                            value="<?= isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '1' ?>" min="1">
                                        <input type="hidden" name="cart[<?= $index ?>][product_id]" value="<?= htmlspecialchars($item['product_ID']) ?>">
                                        <button type="button" class="btn-increase">+</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-remove" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">Remove</button>
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

    <script>
        $(document).ready(function() {
            function updateTotal() {
                let total = 0;
                $('.cart-item').each(function() {
                    let price = parseFloat($(this).find('.item-price').text().replace('$', ''));
                    let quantity = parseInt($(this).find('.quantity-input').val());
                    total += price * quantity;
                });
                $('#total-price').text(total.toFixed(2));
            }

            $('.btn-increase').click(function() {
                let input = $(this).siblings('.quantity-input');
                let newValue = parseInt(input.val()) + 1;
                input.val(newValue);
                updateTotal();
            });

            $('.btn-decrease').click(function() {
                let input = $(this).siblings('.quantity-input');
                let newValue = Math.max(1, parseInt(input.val()) - 1);
                input.val(newValue);
                updateTotal();
            });

            $('.quantity-input').on('change', function() {
                let value = parseInt($(this).val());
                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }
                updateTotal();
            });

            $('.btn-remove').click(function() {
                const productId = $(this).data('product-id');
                const row = $(this).closest('tr');

                $.ajax({
                    url: '/orderCard/removeFromCart',
                    type: 'POST',
                    data: {
                        product_id: productId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            row.remove();
                            updateTotal();
                            if ($('#cartItems .cart-item').length === 0) {
                                $('#cartItems').html('<tr><td colspan="5" class="text-center">No items in cart.</td></tr>');
                            }
                        } else {
                            alert('Failed to remove item: ' + (data.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error removing item:', error);
                        alert('An error occurred while removing the item');
                    }
                });
            });

            function getBase64Image(img) {
                return new Promise((resolve, reject) => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const image = new Image();
                    image.crossOrigin = 'Anonymous';
                    image.onload = function() {
                        canvas.width = image.width;
                        canvas.height = image.height;
                        ctx.drawImage(image, 0, 0);
                        resolve(canvas.toDataURL('image/png'));
                    };
                    image.onerror = reject;
                    image.src = img;
                });
            }

            $('#generate-pdf').click(async function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Header with single color
                doc.setFillColor(255, 147, 0);
                doc.rect(0, 0, 210, 30, 'F');

                // Load and add logo
                const logoSrc = "../../views/assets/images/logo.png";
                let logoData;
                try {
                    logoData = await getBase64Image(logoSrc);
                    // Add logo (20mm width, maintaining aspect ratio, balanced with text)
                    doc.addImage(logoData, 'PNG', 10, 5, 20, 0); // Width 20mm, height auto-adjusted
                } catch (error) {
                    console.error('Error loading logo:', error);
                }

                // Title next to logo
                doc.setFontSize(24);
                doc.setTextColor(255, 255, 255);
                doc.setFont('helvetica', 'bold');
                doc.text('Velea Cafe', 35, 15); // Adjusted position to right of logo
                doc.setFontSize(14);
                doc.text('Cart Receipt', 35, 22); // Adjusted position

                // Date without background
                const today = new Date();
                const dateStr = today.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                doc.setFontSize(10);
                doc.setTextColor(255, 255, 255);
                doc.setFont('helvetica', 'normal');
                doc.text(`Date: ${dateStr}`, 150, 15);

                // Table Header
                let y = 40;
                doc.setFillColor(240, 240, 240);
                doc.rect(10, y - 5, 190, 10, 'F');
                doc.setFontSize(12);
                doc.setTextColor(255, 147, 0);
                doc.setFont('helvetica', 'bold');
                doc.text('Image', 12, y);
                doc.text('Item Name', 42, y);
                doc.text('Price', 102, y);
                doc.text('Qty', 132, y);
                doc.text('Total', 162, y);
                y += 5;
                doc.setDrawColor(255, 147, 0);
                doc.setLineWidth(0.5);
                doc.line(10, y, 200, y);
                y += 10;

                // Table Content
                let grandTotal = 0;
                const items = [];
                for (const item of $('.cart-item')) {
                    const imgSrc = $(item).find('td:nth-child(1) img').attr('src');
                    const name = $(item).find('td:nth-child(2)').text().trim();
                    const price = parseFloat($(item).find('.item-price').text().replace('$', ''));
                    const quantity = parseInt($(item).find('.quantity-input').val());
                    const total = price * quantity;
                    grandTotal += total;

                    let imgData = null;
                    try {
                        imgData = await getBase64Image(imgSrc);
                    } catch (error) {
                        console.error('Error loading image:', error);
                        imgData = null;
                    }

                    items.push({ imgData, name, price, quantity, total });
                }

                doc.setFontSize(11);
                doc.setTextColor(50, 50, 50);
                doc.setFont('helvetica', 'normal');
                let rowIndex = 0;
                for (const item of items) {
                    if (rowIndex % 2 === 0) {
                        doc.setFillColor(250, 250, 250);
                        doc.rect(10, y - 8, 190, 18, 'F');
                    }

                    if (item.imgData) {
                        try {
                            doc.addImage(item.imgData, 'PNG', 12, y - 5, 15, 15);
                        } catch (error) {
                            console.error('Error adding image to PDF:', error);
                            doc.text('Image N/A', 12, y);
                        }
                    } else {
                        doc.text('Image N/A', 12, y);
                    }

                    doc.text(item.name, 42, y);
                    doc.text(`$${item.price.toFixed(2)}`, 102, y);
                    doc.text(`${item.quantity}`, 132, y);
                    doc.text(`$${item.total.toFixed(2)}`, 162, y);
                    y += 18;
                    rowIndex++;
                }

                // Total
                doc.setDrawColor(255, 147, 0);
                doc.setLineWidth(0.5);
                doc.line(10, y, 200, y);
                y += 5;
                doc.setFillColor(255, 147, 0);
                doc.rect(150, y - 5, 50, 10, 'F');
                doc.setFontSize(14);
                doc.setTextColor(255, 255, 255);
                doc.setFont('helvetica', 'bold');
                doc.text(`Total: $${grandTotal.toFixed(2)}`, 152, y);

                // Footer
                y += 5;
                doc.setFontSize(10);
                doc.setTextColor(120, 120, 120);
                doc.setFont('helvetica', 'italic');
                doc.text('Thank you for choosing Velea Cafe!', 10, y);

                // Save the PDF
                doc.save('cart-receipt.pdf');
            });
        });
    </script>

    <!-- Add this script after your existing <script> tag -->
    <script src="../views/assets/js/Language_options/order-card-o.js"></script>

</body>

</html>