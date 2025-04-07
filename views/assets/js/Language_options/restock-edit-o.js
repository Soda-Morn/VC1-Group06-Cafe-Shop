  // Define translations for Edit Product page
  const editProductTranslations = {
    en: {
      title: "Edit Product",
      subtitle: "Update the details below",
      labels: ["Product Image", "Product Name", "Price ($)"],
      upload_text: "Select Product Image",
      change_image: "Change Image",
      buttons: ["Update", "Cancel"]
    },
    km: {
      title: "កែសម្រួលផលិតផល",
      subtitle: "ធ្វើបច្ចុប្បន្នភាពព័ត៌មានខាងក្រោម",
      labels: ["រូបភាពផលិតផល", "ឈ្មោះផលិតផល", "តម្លៃ ($)"], 
      upload_text: "ជ្រើសរូបភាពផលិតផល",
      change_image: "ផ្លាស់ប្តូររូបភាព",
      buttons: ["ធ្វើបច្ចុប្បន្នភាព", "បោះបង់"]
    }
  };

  // Function to update Edit Product page language
  function updateEditProductLanguage(language) {
    // Update title
    const title = document.querySelector('.form-title');
    if (title) title.textContent = editProductTranslations[language].title;

    // Update subtitle
    const subtitle = document.querySelector('.form-subtitle');
    if (subtitle) subtitle.textContent = editProductTranslations[language].subtitle;

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < editProductTranslations[language].labels.length) {
        label.textContent = editProductTranslations[language].labels[index];
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
        ${editProductTranslations[language].upload_text}
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
        ${editProductTranslations[language].change_image}
      `;
    }

    // Update buttons
    const buttons = document.querySelectorAll('.buttons-container .btn');
    buttons.forEach((button, index) => {
      if (index < editProductTranslations[language].buttons.length) {
        button.textContent = editProductTranslations[language].buttons[index];
      }
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateEditProductLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });