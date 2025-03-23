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
        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            overflow: auto;
        }

        .preview-container {
            max-width: 1000px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .preview-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .preview-header h2 {
            color: #f5a623;
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .preview-header p {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        .table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: #f5a623;
            color: #fff;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
            border: none;
        }

        .table tbody tr {
            background-color: #fff;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .total-and-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000;
        }

        .total-price span {
            color: #f5a623;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-save-pdf {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="preview-container w-100">
            <div class="preview-header">
                <h2>Preview</h2>
                <p>Review your order before finalizing.</p>
            </div>

            <div id="pdf-content">
                <table class="table table-hover text-center">
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

                <div class="total-and-buttons">
                    <div class="total-price">
                        Total: $<span id="grand-total"><?= number_format($total, 2) ?></span>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="/restock_checkout"><button type="button" class="btn btn-back">Back</button></a>
                <button type="button" id="savePdfBtn" class="btn btn-save-pdf">Save to PDF</button>
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