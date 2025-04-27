$(document).ready(function () {
    // Function to update the total price and total quantity
    function updateTotalAndQuantity() {
        let total = 0;
        let totalQuantity = 0;

        $('.cart-item').each(function () {
            let price = parseFloat($(this).find('.item-price').text().replace('$', ''));
            let quantity = parseInt($(this).find('.quantity-input').val());
            total += price * quantity;
            totalQuantity += quantity; // Sum up the quantities
        });

        $('#total-price').text(total.toFixed(2));
        // Update the checkout icon quantity badge in the navbar
        $('.count_cart').text(totalQuantity);
        // If total quantity is 0, hide the badge
        if (totalQuantity === 0) {
            $('.count_cart').hide();
        } else {
            $('.count_cart').show();
        }
    }

    // Initial update to set the correct quantity on page load
    updateTotalAndQuantity();

    $('.btn-increase').click(function () {
        let input = $(this).siblings('.quantity-input');
        let newValue = parseInt(input.val()) + 1;
        input.val(newValue);
        updateTotalAndQuantity();

        // Update the server-side session via AJAX
        const productId = $(this).closest('.cart-item').data('product-id');
        updateCartQuantity(productId, newValue);
    });

    $('.btn-decrease').click(function () {
        let input = $(this).siblings('.quantity-input');
        let newValue = Math.max(1, parseInt(input.val()) - 1);
        input.val(newValue);
        updateTotalAndQuantity();

        // Update the server-side session via AJAX
        const productId = $(this).closest('.cart-item').data('product-id');
        updateCartQuantity(productId, newValue);
    });

    $('.quantity-input').on('change', function () {
        let value = parseInt($(this).val());
        if (isNaN(value) || value < 1) {
            $(this).val(1);
            value = 1;
        }
        updateTotalAndQuantity();

        // Update the server-side session via AJAX
        const productId = $(this).closest('.cart-item').data('product-id');
        updateCartQuantity(productId, value);
    });

    // Function to update the server-side session cart quantity
    function updateCartQuantity(productId, quantity) {
        console.log('Sending AJAX request to update quantity:', {
            product_id: productId,
            quantity: quantity,
            url: '/orderCard/updateCartQuantity'
        });

        $.ajax({
            url: '/orderCard/updateCartQuantity',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            dataType: 'json',
            success: function (data) {
                console.log('AJAX success response:', data);
                if (!data.success) {
                    console.error('Failed to update quantity:', data.message);
                    alert('Failed to update quantity: ' + (data.message || 'Unknown error'));
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText,
                    statusCode: xhr.status
                });
                alert('An error occurred while updating the quantity: ' + (xhr.responseText || error));
            }
        });
    }

    $('.btn-remove').click(function () {
        const productId = $(this).data('product-id');
        const row = $(this).closest('tr');

        $.ajax({
            url: '/orderCard/removeFromCart',
            type: 'POST',
            data: {
                product_id: productId
            },
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    row.remove();
                    updateTotalAndQuantity();
                    if ($('#cartItems .cart-item').length === 0) {
                        $('#cartItems').html('<tr><td colspan="5" class="text-center">No items in cart.</td></tr>');
                    }
                } else {
                    alert('Failed to remove item: ' + (data.message || 'Unknown error'));
                }
            },
            error: function (xhr, status, error) {
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
            image.onload = function () {
                canvas.width = image.width;
                canvas.height = image.height;
                ctx.drawImage(image, 0, 0);
                resolve(canvas.toDataURL('image/png'));
            };
            image.onerror = reject;
            image.src = img;
        });
    }

    $('#generate-pdf').click(async function () {
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
            doc.addImage(logoData, 'PNG', 10, 5, 20, 0);
        } catch (error) {
            console.error('Error loading logo:', error);
        }

        // Title next to logo
        doc.setFontSize(24);
        doc.setTextColor(255, 255, 255);
        doc.setFont('helvetica', 'bold');
        doc.text('Velea Cafe', 35, 15);
        doc.setFontSize(14);
        doc.text('Cart Receipt', 35, 22);

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