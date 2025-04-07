  // Define translations for Checkout page
  const checkoutTranslations = {
    en: {
      title: "Checkout",
      subtitle: "Review your items before proceeding.",
      table_headers: ["IMAGE", "ITEM", "PRICE", "QUANTITY", "ACTION"],
      total_label: "Total: $",
      buttons: {
        add_more: "Add More",
        preview: "Preview",
        submit: "Submit",
        remove: "Remove",
      },
      no_items: "No items in cart",
      select_product: "Select a product"
    },
    km: {
      title: "បញ្ជាទិញ",
      subtitle: "ពិនិត្យមើលទំនិញរបស់អ្នកមុននឹងបន្ត។",
      table_headers: ["រូបភាព", "ទំនិញ", "តម្លៃ", "បរិមាណ", "សកម្មភាព"],
      total_label: "សរុប: $",
      buttons: {
        add_more: "បន្ថែមទៀត",
        preview: "មើលជាមុន",
        submit: "ដាក់ស្នើ",
        remove: "លុប",
      },
      no_items: "គ្មានទំនិញនៅក្នុងកន្ត្រកទេ",
      select_product: "ជ្រើសរើសផលិតផល"
    }
  };

  // Function to update Checkout page language
  function updateCheckoutLanguage(language) {
    // Update title
    const title = document.querySelector('.checkout-header h2');
    if (title) {
      title.textContent = checkoutTranslations[language].title;
    } else {
      console.error('Title element not found with selector .checkout-header h2');
    }

    // Update subtitle
    const subtitle = document.querySelector('.checkout-header p');
    if (subtitle) {
      subtitle.textContent = checkoutTranslations[language].subtitle;
    }

    // Update table headers
    const headers = document.querySelectorAll('.table thead th');
    headers.forEach((header, index) => {
      if (index < checkoutTranslations[language].table_headers.length) {
        header.textContent = checkoutTranslations[language].table_headers[index];
      }
    });

    // Update total label
    const totalLabel = document.querySelector('.total-price');
    if (totalLabel) {
      const totalValue = totalLabel.querySelector('#total-price').textContent;
      totalLabel.innerHTML = `${checkoutTranslations[language].total_label}<span id="total-price">${totalValue}</span>`;
    }

    // Update buttons
    const addMoreBtn = document.getElementById('addMoreBtn');
    if (addMoreBtn) {
      addMoreBtn.textContent = checkoutTranslations[language].buttons.add_more;
    }

    const previewBtn = document.getElementById('previewBtn');
    if (previewBtn) {
      previewBtn.textContent = checkoutTranslations[language].buttons.preview;
    }

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
      submitBtn.textContent = checkoutTranslations[language].buttons.submit;
    }

    const removeButtons = document.querySelectorAll('.remove-btn');
    removeButtons.forEach(button => {
      button.textContent = checkoutTranslations[language].buttons.remove;
    });

    // Update Back button - Fixed approach
    const backBtn = document.querySelector('.btn-back');
    if (backBtn) {
      // Check if the text span already exists to avoid duplicating the SVG
      let textSpan = backBtn.querySelector('.back-text');
      if (!textSpan) {
        // Add a span for the text if it doesn't exist
        textSpan = document.createElement('span');
        textSpan.classList.add('back-text');
        backBtn.appendChild(textSpan);
      }
      // Update only the text inside the span
      textSpan.textContent = checkoutTranslations[language].buttons.back;
      console.log('Back button updated to:', textSpan.textContent); // Debug
    } else {
      console.error('Back button not found with selector .btn-back');
    }

    // Update "No items in cart" message
    const noItemsMessage = document.querySelector('.table tbody td[colspan="5"]');
    if (noItemsMessage && noItemsMessage.textContent === "No items in cart") {
      noItemsMessage.textContent = checkoutTranslations[language].no_items;
    }

    // Update "Select a product" placeholder in dropdowns
    const productSelects = document.querySelectorAll('.product-select option[disabled][selected]');
    productSelects.forEach(option => {
      option.textContent = checkoutTranslations[language].select_product;
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language);
    updateCheckoutLanguage(language);
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
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