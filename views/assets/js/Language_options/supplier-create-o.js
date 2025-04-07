  // Define translations for Add Supplier page
  const addSupplierTranslations = {
    en: {
      title: "Add Supplier",
      labels: ["Name:", "Phone Number:", "Address:"],
      placeholders: ["Enter name......", "Enter phone number........", "Enter address......."],
      buttons: ["Cancel", "Submit"]
    },
    km: {
      title: "បន្ថែមអ្នកផ្គត់ផ្គង់",
      labels: ["ឈ្មោះ:", "លេខទូរស័ព្ទ:", "អាសយដ្ឋាន:"],
      placeholders: ["បញ្ចូលឈ្មោះ......", "បញ្ចូលលេខទូរស័ព្ទ........", "បញ្ចូលអាសយដ្ឋាន......."],
      buttons: ["បោះបង់", "ដាក់ស្នើ"]
    }
  };

  // Function to update Add Supplier page language
  function updateAddSupplierLanguage(language) {
    // Update title
    const title = document.querySelector('.card h2');
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = addSupplierTranslations[language].title;
    } else {
      console.error('Title element not found with selector .card h2');
    }

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < addSupplierTranslations[language].labels.length) {
        label.textContent = addSupplierTranslations[language].labels[index];
      }
    });

    // Update placeholders
    const nameInput = document.getElementById('name');
    if (nameInput) nameInput.placeholder = addSupplierTranslations[language].placeholders[0];

    const phoneInput = document.getElementById('phone_number');
    if (phoneInput) phoneInput.placeholder = addSupplierTranslations[language].placeholders[1];

    const addressInput = document.getElementById('address');
    if (addressInput) addressInput.placeholder = addSupplierTranslations[language].placeholders[2];

    // Update buttons - Refined fix for Cancel button
    const cancelButton = document.querySelector('.d-flex .btn.btn-danger.w-45'); // More specific selector
    const submitButton = document.querySelector('.d-flex .btn.btn-primary.w-45');
    if (cancelButton) {
      // Use innerText to ensure compatibility with <a> tag
      cancelButton.innerText = addSupplierTranslations[language].buttons[0]; // Cancel
      console.log('Cancel button updated to:', cancelButton.innerText); // Debug
    } else {
      console.error('Cancel button not found with selector .d-flex .btn.btn-danger.w-45');
    }
    if (submitButton) {
      submitButton.textContent = addSupplierTranslations[language].buttons[1]; // Submit
    } else {
      console.error('Submit button not found with selector .d-flex .btn.btn-primary.w-45');
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateAddSupplierLanguage(language);
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
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
