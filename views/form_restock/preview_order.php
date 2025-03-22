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
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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

        .table th, .table td {
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

        #pdf-content {
            margin-right: 20px; /* Add a right margin to create a gap */
        }

        .total-and-button {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
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

        .btn-back, .btn-save-pdf {
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease;
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .btn-save-pdf {
            background-color: #28a745;
            color: #fff;
        }

        .btn-save-pdf:hover {
            background-color: #218838;
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
                <table class="table table-hover text-center" id="previewTable">
                    <thead>
                        <tr>
                            <th>IMAGE</th>
                            <th>ITEM</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="previewItems">
                        <!-- Items will be populated by JavaScript -->
                    </tbody>
                </table>

                <div class="total-price" style="text-align: right; margin-bottom: 20px;">
                    TOTAL: $<span id="previewTotal">0.00</span>
                </div>
            </div>

            <div class="total-and-button">
                <div class="button-group">
                    <button type="button" id="backBtn" class="btn btn-back">Back</button>
                    <button type="button" id="savePdfBtn" class="btn btn-save-pdf">Save to PDF</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Load cart items from localStorage
            const cartItems = JSON.parse(localStorage.getItem("previewCart")) || [];
            const previewItems = document.getElementById("previewItems");
            const previewTotal = document.getElementById("previewTotal");

            let total = 0;

            // Populate the table with cart items
            cartItems.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                const row = document.createElement("tr");
                row.classList.add("cart-item");
                row.innerHTML = `
                    <td><img src="${item.product_image}" alt="${item.product_name}" class="img-fluid"></td>
                    <td>${item.product_name}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>$${subtotal.toFixed(2)}</td>
                `;
                previewItems.appendChild(row);
            });

            // Update the total
            previewTotal.textContent = total.toFixed(2);

            // Handle the Back button
            document.getElementById("backBtn").addEventListener("click", function () {
                window.location.href = "/restock_checkout";
            });

            // Handle the Save to PDF button
            document.getElementById("savePdfBtn").addEventListener("click", function () {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Capture only the pdf-content div (table and total price)
                html2canvas(document.querySelector("#pdf-content"), {
                    scale: 2,
                    useCORS: true
                }).then(canvas => {
                    const imgData = canvas.toDataURL("image/png");
                    const imgProps = doc.getImageProperties(imgData);
                    const pdfWidth = doc.internal.pageSize.getWidth() - 20; // Reduce width to add right margin
                    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                    // Add the image to the PDF with a left margin to center it
                    doc.addImage(imgData, "PNG", 10, 0, pdfWidth, pdfHeight);

                    // Download the PDF
                    doc.save("order_preview.pdf");
                });
            });
        });
    </script>
</body>
</html>