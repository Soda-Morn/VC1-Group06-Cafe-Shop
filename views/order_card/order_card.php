<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add jsPDF library for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-container {
            width: 78%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-header h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .cart-header h2 i {
            margin-right: 8px;
        }

        .cart-header p {
            font-size: 1rem;
            color: #666;
            margin-top: 5px;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: bold;
            color: #333;
            border-top: none;
            text-align: center;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
            color: #666;
        }

        .quantity-controls button {
            border: none;
            width: 30px;
            height: 30px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .quantity-controls button:hover {
            background: #0056b3;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            font-size: 1rem;
            border: none;
            outline: none;
            background: transparent;
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.3s;
            font-size: 0.9rem;
        }

        .btn-remove:hover {
            background: #c82333;
        }

        .cart-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .btn-add-more {
            background: #f0ad4e;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-add-more:hover {
            background: #ec971f;
        }

        .btn-checkout {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-checkout:hover {
            background: #0056b3;
        }

        .btn-checkout i {
            margin-right: 5px;
        }

        .btn-back {
            background-color: transparent;
            color: #555;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .btn-back:hover {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-back svg {
            margin-right: 5px;
            width: 24px;
            height: 24px;
        }

        /* Style for the PDF button */
        .btn-pdf {
            background: #f0ad4e;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-pdf:hover {
            background: #ec971f;
        }

        .btn-pdf i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-9">
        <div class="cart-container">
            <!-- Back button inside the card, clears cart before redirecting -->
            <a href="/order_menu" class="btn-back">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
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
                                        <button type="button" class="btn-remove" data-product-id="<?= htmlspecialchars($item['product_ID']) ?>">🗑 Remove</button>
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
                    <button type="button" class="btn-pdf" id="generate-pdf"><i class="fas fa-file-pdf"></i>PDF</button>
                    <button type="submit" class="btn-checkout"><i class="fas fa-check"></i>Checkout</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to update the total price
            function updateTotal() {
                let total = 0;
                $('.cart-item').each(function() {
                    let price = parseFloat($(this).find('.item-price').text().replace('$', ''));
                    let quantity = parseInt($(this).find('.quantity-input').val());
                    total += price * quantity;
                });
                $('#total-price').text(total.toFixed(2));
            }

            // Handle quantity increase
            $('.btn-increase').click(function() {
                let input = $(this).siblings('.quantity-input');
                let newValue = parseInt(input.val()) + 1;
                input.val(newValue);
                updateTotal();
            });

            // Handle quantity decrease
            $('.btn-decrease').click(function() {
                let input = $(this).siblings('.quantity-input');
                let newValue = Math.max(1, parseInt(input.val()) - 1);
                input.val(newValue);
                updateTotal();
            });

            // Handle manual quantity input
            $('.quantity-input').on('change', function() {
                let value = parseInt($(this).val());
                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }
                updateTotal();
            });

            // Handle remove button click with AJAX
            $('.btn-remove').click(function() {
                const productId = $(this).data('product-id');
                const row = $(this).closest('tr');

                // Send AJAX request to remove the item
                $.ajax({
                    url: '/orderCard/removeFromCart',
                    type: 'POST',
                    data: {
                        product_id: productId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            row.remove(); // Remove the row from the UI
                            updateTotal(); // Update the total price
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

            // Function to convert image URL to base64
            function getBase64Image(img) {
                return new Promise((resolve, reject) => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const image = new Image();
                    image.crossOrigin = 'Anonymous'; // Handle cross-origin images
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

            // Handle PDF generation and saving
            $('#generate-pdf').click(async function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Header
                doc.setFillColor(255, 165, 0); // Orange background
                doc.rect(0, 0, 210, 30, 'F'); // Header background
                doc.setFontSize(20);
                doc.setTextColor(255, 255, 255); // White text
                doc.setFont('helvetica', 'bold');
                doc.text('Velea Cafe', 10, 15);
                doc.setFontSize(14);
                doc.text('Cart Receipt', 10, 25);

                // Date
                const today = new Date();
                const dateStr = today.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0); // Black text
                doc.setFont('helvetica', 'normal');
                doc.text(`Date: ${dateStr}`, 150, 25);

                // Table Header
                let y = 40;
                doc.setFontSize(12);
                doc.setTextColor(255, 165, 0); // Orange text
                doc.setFont('helvetica', 'bold');
                doc.text('Image', 10, y);
                doc.text('Item Name', 40, y);
                doc.text('Price', 100, y);
                doc.text('Qty', 130, y);
                doc.text('Total', 160, y);
                y += 5;
                doc.setDrawColor(255, 165, 0); // Orange line
                doc.line(10, y, 200, y); // Draw a line under the header
                y += 10; // Increased spacing to push content below the border

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

                    // Convert image to base64
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
                doc.setTextColor(0, 0, 0); // Black text
                doc.setFont('helvetica', 'normal');
                for (const item of items) {
                    // Add image
                    if (item.imgData) {
                        try {
                            doc.addImage(item.imgData, 'PNG', 10, y - 5, 20, 20); // Image size 20x20
                        } catch (error) {
                            console.error('Error adding image to PDF:', error);
                            doc.text('Image N/A', 10, y);
                        }
                    } else {
                        doc.text('Image N/A', 10, y);
                    }

                    // Add item details
                    doc.text(item.name, 40, y);
                    doc.text(`$${item.price.toFixed(2)}`, 100, y);
                    doc.text(`${item.quantity}`, 130, y);
                    doc.text(`$${item.total.toFixed(2)}`, 160, y);
                    y += 25; // Space for the next item
                }

                // Total
                y += 5;
                doc.setDrawColor(255, 165, 0); // Orange line
                doc.line(10, y, 200, y); // Draw a line before the total
                y += 5;
                doc.setFontSize(14);
                doc.setTextColor(255, 165, 0); // Orange text
                doc.setFont('helvetica', 'bold');
                doc.text(`Total: $${grandTotal.toFixed(2)}`, 160, y);

                // Footer (without top border)
                y += 20;
                doc.setFontSize(10);
                doc.setTextColor(100, 100, 100); // Gray text
                doc.setFont('helvetica', 'italic');
                doc.text('Thank you for choosing Velea Cafe!', 10, y);
                doc.text('Visit us again at localhost:8080', 10, y + 5);
                y += 10;
                doc.setDrawColor(255, 165, 0); // Orange line
                doc.line(10, y, 200, y); // Draw a line after the footer

                // Save the PDF
                doc.save('cart-receipt.pdf');
            });
        });
    </script>
</body>

</html>