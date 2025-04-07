  // Define translations for Add Product page
  const addProductTranslations = {
    en: {
      title: "Add a New Product",
      subtitle: "Fill in the details below to create a product",
      labels: ["Product Image", "Product Name", "Price ($)", "Category"],
      upload_text: "Select Product Image",
      change_image: "Change Image",
      buttons: ["Add To Stock", "Cancel"],
      placeholders: ["Enter product name", "Enter price", "Select a category"],
      alerts: [
        "Please select a product image",
        "Please enter a product name",
        "Please enter a valid price",
        "Please select a category"
      ]
    },
    km: {
      title: "បន្ថែមផលិតផលថ្មី",
      subtitle: "បំពេញព័ត៌មានខាងក្រោមដើម្បីបង្កើតផលិតផល",
      labels: ["រូបភាពផលិតផល", "ឈ្មោះផលិតផល", "តម្លៃ ($)", "ប្រភេទ"],
      upload_text: "ជ្រើសរូបភាពផលិតផល",
      change_image: "ផ្លាស់ប្តូររូបភាព",
      buttons: ["បន្ថែមទៅស្តុក", "បោះបង់"],
      placeholders: ["បញ្ចូលឈ្មោះផលិតផល", "បញ្ចូលតម្លៃ", "ជ្រើសប្រភេទ"],
      alerts: [
        "សូមជ្រើសរូបភាពផលិតផល",
        "សូមបញ្ចូលឈ្មោះផលិតផល",
        "សូមបញ្ចូលតម្លៃត្រឹមត្រូវ",
        "សូមជ្រើសប្រភេទ"
      ]
    }
  };

  // Function to update Add Product page language
  function updateAddProductLanguage(language) {
    // Update title
    const title = document.querySelector('.form-title');
    if (title) title.textContent = addProductTranslations[language].title;

    // Update subtitle
    const subtitle = document.querySelector('.form-subtitle');
    if (subtitle) subtitle.textContent = addProductTranslations[language].subtitle;

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < addProductTranslations[language].labels.length) {
        label.textContent = addProductTranslations[language].labels[index];
      }
    });

    // Update upload text
    const uploadText = document.querySelector('.upload-text');
    if (uploadText) {
      uploadText.innerHTML = `
        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="17 8 12 3 7 8"></polyline>
          <line x1="12" y1="3" x2="12" y2="15"></line>
        </svg>
        ${addProductTranslations[language].upload_text}
      `;
    }

    // Update change image button
    const changeImageBtn = document.getElementById('change-image-btn');
    if (changeImageBtn) {
      changeImageBtn.innerHTML = `
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M23 4v6h-6"></path>
          <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
        </svg>
        ${addProductTranslations[language].change_image}
      `;
    }

    // Update placeholders
    const nameInput = document.getElementById('name');
    if (nameInput) nameInput.placeholder = addProductTranslations[language].placeholders[0];

    const priceInput = document.getElementById('price');
    if (priceInput) priceInput.placeholder = addProductTranslations[language].placeholders[1];

    const categorySelect = document.getElementById('category');
    if (categorySelect) {
      const defaultOption = categorySelect.querySelector('option[value=""]');
      if (defaultOption) defaultOption.textContent = addProductTranslations[language].placeholders[2];
    }

    // Update buttons
    const buttons = document.querySelectorAll('.buttons-container .btn');
    buttons.forEach((button, index) => {
      if (index < addProductTranslations[language].buttons.length) {
        button.textContent = addProductTranslations[language].buttons[index];
      }
    });

    // Update validation alerts (store in a global variable for the submit handler)
    window.addProductAlerts = addProductTranslations[language].alerts;
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateAddProductLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });

  // Update the existing form submission script to use translated alerts
  document.getElementById('product-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const fileInput = document.getElementById('file-input');
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const categorySelect = document.getElementById('category');
    const submitButton = document.getElementById('submit-btn');

    let isValid = true;

    if (fileInput.files.length === 0) {
      alert(window.addProductAlerts[0]); // Use translated alert
      isValid = false;
    }

    if (nameInput.value.trim() === '') {
      alert(window.addProductAlerts[1]);
      isValid = false;
    }

    if (priceInput.value <= 0) {
      alert(window.addProductAlerts[2]);
      isValid = false;
    }

    if (categorySelect.value === '') {
      alert(window.addProductAlerts[3]);
      isValid = false;
    }

    if (isValid) {
      submitButton.classList.add('loading');
      submitButton.textContent = 'Adding...'; // Note: This could also be translated if desired
      document.getElementById('product-form').submit();
    }
  });