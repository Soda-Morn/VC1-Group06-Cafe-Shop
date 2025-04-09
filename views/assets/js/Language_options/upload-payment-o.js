  // Define translations for Payment page
  const paymentTranslations = {
    en: {
      title: "Complete Your Payment",
      total_label: "Total: $",
      select_method: "Select your preferred payment method",
      payment_options: {
        cash: {
          title: "Complete with Cash",
          desc: "Pay directly at the counter"
        },
        qr: {
          title: "QR Code Payment",
          desc: "Scan to pay digitally"
        }
      },
      qr_section: {
        title: "Scan to Pay",
        not_available: "QR Code not available",
        instructions: "Open your mobile banking app and scan the QR code to complete payment"
      },
      buttons: {
        confirm_payment: "Confirm Payment"
      }
    },
    km: {
      title: "បញ្ចប់ការទូទាត់របស់អ្នក",
      total_label: "សរុប: $",
      select_method: "ជ្រើសរើសវិធីទូទាត់ដែលអ្នកពេញចិត្ត",
      payment_options: {
        cash: {
          title: "បញ្ចប់ជាមួយសាច់ប្រាក់",
          desc: "ទូទាត់ដោយផ្ទាល់នៅកន្លែងបញ្ជរ"
        },
        qr: {
          title: "ការទូទាត់តាមកូដ QR",
          desc: "ស្កេនដើម្បីទូទាត់តាមប្រព័ន្ធឌីជីថល"
        }
      },
      qr_section: {
        title: "ស្កេនដើម្បីទូទាត់",
        not_available: "កូដ QR មិនអាចប្រើបានទេ",
        instructions: "បើកកម្មវិធីធនាគារចល័តរបស់អ្នក ហើយស្កេនកូដ QR ដើម្បីបញ្ចប់ការទូទាត់"
      },
      buttons: {
        confirm_payment: "បញ្ជាក់ការទូទាត់"
      }
    }
  };

  // Function to update Payment page language
  function updatePaymentLanguage(language) {
    // Update title
    const title = document.querySelector('.card-header h4');
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = paymentTranslations[language].title;
    } else {
      console.error('Title element not found with selector .card-header h4');
    }

    // Update total label
    const totalPrice = document.querySelector('.total-price');
    if (totalPrice) {
      const totalValue = totalPrice.querySelector('span').textContent;
      totalPrice.innerHTML = `${paymentTranslations[language].total_label}<span>${totalValue}</span>`;
    }

    // Update select method text with retry mechanism
    function updateSelectMethod() {
      const selectMethod = document.querySelector('.text-center.text-muted.mb-4');
      console.log('Select method element found:', selectMethod); // Debug
      if (selectMethod) {
        selectMethod.textContent = paymentTranslations[language].select_method;
      } else {
        console.warn('Select method element not found, retrying...');
        setTimeout(updateSelectMethod, 100); // Retry after 100ms
      }
    }
    updateSelectMethod();

    // Update payment options
    const cashOptionTitle = document.querySelector('.cash-option .title');
    const cashOptionDesc = document.querySelector('.cash-option .desc');
    const qrOptionTitle = document.querySelector('.qr-option .title');
    const qrOptionDesc = document.querySelector('.qr-option .desc');

    if (cashOptionTitle) {
      cashOptionTitle.textContent = paymentTranslations[language].payment_options.cash.title;
    }
    if (cashOptionDesc) {
      cashOptionDesc.textContent = paymentTranslations[language].payment_options.cash.desc;
    }
    if (qrOptionTitle) {
      qrOptionTitle.textContent = paymentTranslations[language].payment_options.qr.title;
    }
    if (qrOptionDesc) {
      qrOptionDesc.textContent = paymentTranslations[language].payment_options.qr.desc;
    }

    // Update QR code section
    const qrTitle = document.querySelector('.qr-code-container h5');
    if (qrTitle) {
      qrTitle.textContent = paymentTranslations[language].qr_section.title;
    }

    const qrNotAvailable = document.querySelector('.qr-code .text-danger');
    if (qrNotAvailable) {
      qrNotAvailable.textContent = paymentTranslations[language].qr_section.not_available;
    }

    const qrInstructions = document.querySelector('.payment-instructions');
    if (qrInstructions) {
      qrInstructions.textContent = paymentTranslations[language].qr_section.instructions;
    }

    // Update Confirm Payment button
    const confirmButton = document.querySelector('.btn-confirm');
    if (confirmButton) {
      confirmButton.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${paymentTranslations[language].buttons.confirm_payment}`;
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    localStorage.setItem('selectedLanguage', language); // Ensure language is saved
    originalSetLanguage(language);
    updatePaymentLanguage(language);
  };

  // Load saved language on page load, ensuring DOM and styles are fully loaded
  window.addEventListener('load', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    console.log('Initial language on page load:', savedLanguage); // Debug
    setLanguage(savedLanguage);
  });

  // For testing: Add a manual trigger to switch languages
  window.addEventListener('load', () => {
    const testButtons = `
      <div style="position: fixed; top: 10px; right: 10px;">
        <button onclick="setLanguage('en')">English</button>
        <button onclick="setLanguage('km')">Khmer</button>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', testButtons);
  });

  // Existing script (unchanged)
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