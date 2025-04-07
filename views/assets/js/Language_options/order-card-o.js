
  // Define translations for Order Now page
  const orderTranslations = {
    en: {
      title: "Your Cart",
      subtitle: "Review your selection:",
      table_headers: ["Image", "Name", "Price", "Quantity", "Action"],
      no_items: "No items in cart.",
      total_label: "Total Price: $",
      buttons: {
        back: "",
        remove: "Remove",
        pdf: "PDF",
        checkout: "Checkout"
      },
      pdf: {
        title: "Velea Cafe",
        subtitle: "Cart Receipt",
        date_label: "Date: ",
        headers: ["Image", "Item Name", "Price", "Qty", "Total"],
        image_na: "Image N/A",
        total_label: "Total: $",
        footer: "Thank you for choosing Velea Cafe!"
      }
    },
    km: {
      title: "កន្ត្រករបស់អ្នក",
      subtitle: "ពិនិត្យមើលជម្រើសរបស់អ្នក:",
      table_headers: ["រូបភាព", "ឈ្មោះ", "តម្លៃ", "បរិមាណ", "សកម្មភាព"],
      no_items: "គ្មានទំនិញនៅក្នុងកន្ត្រកទេ។",
      total_label: "តម្លៃសរុប: $",
      buttons: {
        back: "",
        remove: "លុប",
        pdf: "PDF",
        checkout: "បញ្ជាទិញ"
      },
      pdf: {
        title: "ហាងកាហ្វេ វេលា",
        subtitle: "បង្កាន់ដៃកន្ត្រក",
        date_label: "កាលបរិច្ឆេទ: ",
        headers: ["រូបភាព", "ឈ្មោះទំនិញ", "តម្លៃ", "បរិមាណ", "សរុប"],
        image_na: "រូបភាពមិនមាន",
        total_label: "សរុប: $",
        footer: "អរគុណសម្រាប់ការជ្រើសរើសហាងកាហ្វេ វេលា!"
      }
    }
  };

  // Function to update Order Now page language
  function updateOrderLanguage(language) {
    // Update cart title
    const title = document.querySelector('.cart-header h2');
    if (title) title.innerHTML = `<i class="fas fa-shopping-cart"></i> ${orderTranslations[language].title}`;

    // Update subtitle
    const subtitle = document.querySelector('.cart-header p strong');
    if (subtitle) subtitle.textContent = orderTranslations[language].subtitle;

    // Update table headers
    const headers = document.querySelectorAll('.table thead th');
    headers.forEach((header, index) => {
      if (index < orderTranslations[language].table_headers.length) {
        header.textContent = orderTranslations[language].table_headers[index];
      }
    });

    // Update "No items in cart" message
    const noItems = document.querySelector('#cartItems td');
    if (noItems && noItems.textContent === orderTranslations.en.no_items) {
      noItems.textContent = orderTranslations[language].no_items;
    }

    // Update total price label
    const totalLabel = document.querySelector('.total-price');
    if (totalLabel) {
      const totalValue = document.getElementById('total-price').textContent;
      totalLabel.innerHTML = `${orderTranslations[language].total_label}<span id="total-price">${totalValue}</span>`;
    }

    // Update buttons
    const removeButtons = document.querySelectorAll('.btn-remove');
    removeButtons.forEach(button => button.textContent = orderTranslations[language].buttons.remove);

    const pdfButton = document.querySelector('.btn-pdf');
    if (pdfButton) pdfButton.innerHTML = `<i class="fas fa-file-pdf"></i> ${orderTranslations[language].buttons.pdf}`;

    const checkoutButton = document.querySelector('.btn-checkout');
    if (checkoutButton) checkoutButton.innerHTML = `<i class="fas fa-check"></i> ${orderTranslations[language].buttons.checkout}`;

    // Store PDF translations for use in the PDF generation function
    window.orderPDFTranslations = orderTranslations[language].pdf;
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateOrderLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });

  // Update the existing PDF generation script to use translated text
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
      doc.addImage(logoData, 'PNG', 10, 5, 20, 0);
    } catch (error) {
      console.error('Error loading logo:', error);
    }

    // Title next to logo
    doc.setFontSize(24);
    doc.setTextColor(255, 255, 255);
    doc.setFont('helvetica', 'bold');
    doc.text(window.orderPDFTranslations.title, 35, 15);
    doc.setFontSize(14);
    doc.text(window.orderPDFTranslations.subtitle, 35, 22);

    // Date without background
    const today = new Date();
    const dateStr = today.toLocaleDateString(language === 'km' ? 'km-KH' : 'en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    doc.setFontSize(10);
    doc.setTextColor(255, 255, 255);
    doc.setFont('helvetica', 'normal');
    doc.text(`${window.orderPDFTranslations.date_label}${dateStr}`, 150, 15);

    // Table Header
    let y = 40;
    doc.setFillColor(240, 240, 240);
    doc.rect(10, y - 5, 190, 10, 'F');
    doc.setFontSize(12);
    doc.setTextColor(255, 147, 0);
    doc.setFont('helvetica', 'bold');
    window.orderPDFTranslations.headers.forEach((header, index) => {
      const xPositions = [12, 42, 102, 132, 162];
      doc.text(header, xPositions[index], y);
    });
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
          doc.text(window.orderPDFTranslations.image_na, 12, y);
        }
      } else {
        doc.text(window.orderPDFTranslations.image_na, 12, y);
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
    doc.text(`${window.orderPDFTranslations.total_label}${grandTotal.toFixed(2)}`, 152, y);

    // Footer
    y += 5;
    doc.setFontSize(10);
    doc.setTextColor(120, 120, 120);
    doc.setFont('helvetica', 'italic');
    doc.text(window.orderPDFTranslations.footer, 10, y);

    // Save the PDF
    doc.save('cart-receipt.pdf');
  });
