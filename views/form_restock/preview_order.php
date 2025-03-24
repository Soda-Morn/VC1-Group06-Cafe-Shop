<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow-x: hidden;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .preview-container {
            max-width: 1000px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            margin: 20px auto;
            position: relative;
        }

        /* Back button with arrow */
        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #555;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.2s ease;
            z-index: 10;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
        }

        .btn-back:hover {
            color: #f5a623;
            transform: translateX(-3px);
            background-color: rgba(245, 166, 35, 0.1);
        }

        .btn-back svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        /* Header styles */
        .preview-header {
            text-align: center;
            margin: 10px 0 30px;
            padding-top: 20px;
        }

        .preview-header h2 {
            color: #f5a623;
            font-weight: bold;
            font-size: 2.2rem;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .preview-header p {
            color: #6c757d;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #f5a623, #f7b84b);
            color: white;
        }

        .table th {
            padding: 15px 10px;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table td {
            padding: 15px 10px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: rgba(245, 166, 35, 0.05);
        }

        /* Cart item styles */
        .cart-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .cart-item img:hover {
            transform: scale(1.05);
        }

        .item-price, .item-quantity, .item-subtotal {
            font-weight: 500;
        }

        .item-subtotal {
            color: #f5a623;
            font-weight: 600;
        }

        /* Total and buttons area */
        .total-and-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 15px;
            margin-bottom: 30px;
        }

        .total-price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
            background-color: #f9f9f9;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .total-price span {
            color: #f5a623;
            margin-left: 5px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            width: 100%;
            margin-top: 20px;
        }

        .btn-save-pdf {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
        }

        .btn-save-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(40, 167, 69, 0.3);
            background: linear-gradient(135deg, #218838, #1aae88);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .preview-container {
                padding: 25px;
            }
            
            .btn-back {
                top: 15px;
                left: 15px;
            }
        }

        @media (max-width: 768px) {
            .preview-header h2 {
                font-size: 1.8rem;
            }
            
            .preview-header p {
                font-size: 1rem;
            }
            
            .table th,
            .table td {
                padding: 12px 8px;
                font-size: 0.9rem;
            }
            
            .cart-item img {
                width: 60px;
                height: 60px;
            }
            
            .total-price {
                font-size: 1.2rem;
            }
            
            .btn-save-pdf {
                padding: 10px 20px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .preview-container {
                padding: 20px 15px;
                margin: 10px auto;
                border-radius: 8px;
            }
            
            .btn-back {
                top: 10px;
                left: 10px;
            }
            
            .btn-back svg {
                width: 20px;
                height: 20px;
            }
            
            .preview-header {
                margin: 20px 0 20px;
                padding-top: 10px;
            }
            
            .preview-header h2 {
                font-size: 1.5rem;
            }
            
            .preview-header p {
                font-size: 0.9rem;
            }
            
            .table th {
                font-size: 0.75rem;
                padding: 10px 5px;
            }
            
            .table td {
                padding: 10px 5px;
                font-size: 0.8rem;
            }
            
            .cart-item img {
                width: 50px;
                height: 50px;
            }
            
            .total-price {
                font-size: 1.1rem;
                padding: 8px 15px;
            }
            
            .btn-save-pdf {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .table th:nth-child(1),
            .table td:nth-child(1) {
                width: 60px;
            }
            
            .cart-item img {
                width: 45px;
                height: 45px;
            }
            
            .total-price {
                width: 100%;
                text-align: center;
            }
            
            .button-group {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="preview-container">
            <!-- Back button with SVG arrow -->
            <a href="/restock_checkout" class="btn-back">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            
            <div class="preview-header">
                <h2>Preview</h2>
                <p>Review your order before finalizing.</p>
            </div>

            <div id="pdf-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>IMAGE</th>
                                <th>ITEM</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <?php
                            $total = 0;
                            if (!empty($cartItems)) {
                                foreach ($cartItems as $index => $item):
                                    if (!isset($item['purchase_item_id'])) {
                                        error_log("Missing purchase_item_id for item: " . print_r($item, true));
                                        continue;
                                    }
                                    $quantity = $item['quantity'] ?? 0;
                                    $subtotal = ($item['price'] ?? 0) * $quantity;
                                    $total += $subtotal;
                                    ?>
                                    <tr class="cart-item" data-item-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                        <td>
                                            <img src="<?= htmlspecialchars($item['product_image'] ?? '') ?>" alt="<?= htmlspecialchars($item['product_name'] ?? 'No image') ?>" class="img-fluid">
                                        </td>
                                        <td><?= htmlspecialchars($item['product_name'] ?? 'Unknown') ?></td>
                                        <td class="item-price">$<?= number_format($item['price'] ?? 0, 2) ?></td>
                                        <td class="item-quantity"><?= htmlspecialchars($quantity) ?></td>
                                        <td class="item-subtotal">$<?= number_format($subtotal, 2) ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            } else {
                                echo '<tr><td colspan="5">No items to preview</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="total-and-buttons">
                    <div class="total-price">
                        Total: <span id="grand-total">$<?= number_format($total, 2) ?></span>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" id="savePdfBtn" class="btn-save-pdf">Save to PDF</button>
            </div>
        </div>
    </div>

    <script>
        // Extract jsPDF from the UMD module
        const { jsPDF } = window.jspdf;

        document.getElementById('savePdfBtn').addEventListener('click', () => {
            // Get the element to convert to PDF
            const element = document.getElementById('pdf-content');

            // Use html2canvas to capture the element as an image
            html2canvas(element, {
                scale: 2, // Increase scale for better quality
                useCORS: true, // Enable CORS for images (if hosted on a different domain)
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = canvas.width;
                const imgHeight = canvas.height;

                // Initialize jsPDF
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'px',
                    format: 'a4'
                });

                // Calculate the width and height to fit the PDF page
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const widthRatio = pageWidth / imgWidth;
                const heightRatio = pageHeight / imgHeight;
                const ratio = Math.min(widthRatio, heightRatio);

                const scaledWidth = imgWidth * ratio;
                const scaledHeight = imgHeight * ratio;

                // Center the image on the PDF page
                const xOffset = (pageWidth - scaledWidth) / 2;
                const yOffset = (pageHeight - scaledHeight) / 2;

                // Add the image to the PDF
                pdf.addImage(imgData, 'PNG', xOffset, yOffset, scaledWidth, scaledHeight);

                // Add the "Preview" header and subtitle at the top of the PDF
                pdf.setFontSize(24);
                pdf.setTextColor(245, 166, 35); // #f5a623
                pdf.text('Preview', pageWidth / 2, 30, { align: 'center' });

                pdf.setFontSize(14);
                pdf.setTextColor(108, 117, 125); // #6c757d
                pdf.text('Review your order before finalizing.', pageWidth / 2, 50, { align: 'center' });

                // Download the PDF
                pdf.save('order-preview.pdf');
            }).catch(error => {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF. Please try again.');
            });
        });
    </script>
</body>

</html>