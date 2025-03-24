<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            margin: 0 auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .preview-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .preview-header h2 {
            color: #f5a623;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .preview-header p {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        .table {
            width: 100%;
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

        .total-row {
            font-size: 1.8rem; /* Increased font size for the Total row */
            font-weight: bold;
            color: #000;
            text-align: right;
        }

        .total-row .total-price {
            color: #f5a623;
            margin-left: 5px;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .btn-back,
        .btn-save-pdf {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-save-pdf {
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="preview-container w-100">
            <div id="pdf-content">
                <div class="preview-header">
                    <h2>Preview</h2>
                    <p>Review your order before finalizing.</p>
                </div>

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
                            foreach ($cartItems as $index => $item) {
                                if (!isset($item['purchase_item_id'])) {
                                    error_log("Missing purchase_item_id for item: " . print_r($item, true));
                                    continue;
                                }
                                $quantity = $item['quantity'] ?? 0;
                                $subtotal = ($item['price'] ?? 0) * $quantity;
                                $total += $subtotal;
                                $imagePath = !empty($item['product_image']) ? '/uploads/' . basename($item['product_image']) : '';
                                ?>
                                <tr class="cart-item" data-item-id="<?= htmlspecialchars($item['purchase_item_id']) ?>">
                                    <td>
                                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item['product_name'] ?? 'No image') ?>" class="img-fluid">
                                    </td>
                                    <td><?= htmlspecialchars($item['product_name'] ?? 'Unknown') ?></td>
                                    <td class="item-price">$<?= number_format($item['price'] ?? 0, 2) ?></td>
                                    <td class="item-quantity"><?= htmlspecialchars($quantity) ?></td>
                                    <td class="item-subtotal">$<?= number_format($subtotal, 2) ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="5">No items to preview</td></tr>';
                        }
                        ?>
                        <tr class="total-row">
                            <td colspan="4"></td>
                            <td>
                                Total:<span class="total-price">$<?= number_format($total, 2) ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="button-group">
                <a href="/restock_checkout"><button type="button" class="btn btn-back">Back</button></a>
                <button type="button" id="savePdfBtn" class="btn btn-save-pdf">Save to PDF</button>
            </div>
        </div>
    </div>

    <script>
        const { jsPDF } = window.jspdf;

        document.getElementById('savePdfBtn').addEventListener('click', () => {
            const element = document.getElementById('pdf-content');

            html2canvas(element, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = canvas.width;
                const imgHeight = canvas.height;

                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'px',
                    format: 'a4'
                });

                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const ratio = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
                const scaledWidth = imgWidth * ratio;
                const scaledHeight = imgHeight * ratio;
                const xOffset = (pageWidth - scaledWidth) / 2;
                const yOffset = 20;

                pdf.addImage(imgData, 'PNG', xOffset, yOffset, scaledWidth, scaledHeight);
                pdf.save('order-preview.pdf');
            }).catch(error => {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF. Please try again.');
            });
        });
    </script>
</body>
</html>