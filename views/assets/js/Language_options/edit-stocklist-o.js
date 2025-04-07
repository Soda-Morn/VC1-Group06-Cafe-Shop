  // Define translations for Edit Product (Stocklist) page
  const editStockTranslations = {
    en: {
      title: "Edit Product",
      subtitle: "Update the details below",
      labels: ["Product Image", "Product Name"],
      change_image: "Change Image",
      buttons: ["Update", "Cancel"]
    },
    km: {
      title: "កែសម្រួលផលិតផល",
      subtitle: "ធ្វើបច្ចុប្បន្នភាពព័ត៌មានខាងក្រោម",
      labels: ["រូបភាពផលិតផល", "ឈ្មោះផលិតផល"],
      change_image: "ផ្លាស់ប្តូររូបភាព",
      buttons: ["ធ្វើបច្ចុប្បន្នភាព", "បោះបង់"]
    }
  };

  // Function to update Edit Product (Stocklist) page language
  function updateEditStockLanguage(language) {
    // Update title
    const title = document.querySelector('.form-title');
    if (title) title.textContent = editStockTranslations[language].title;

    // Update subtitle
    const subtitle = document.querySelector('.form-subtitle');
    if (subtitle) subtitle.textContent = editStockTranslations[language].subtitle;

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < editStockTranslations[language].labels.length) {
        label.textContent = editStockTranslations[language].labels[index];
      }
    });

    // Update change image button
    const changeImageBtn = document.getElementById('change-image-btn');
    if (changeImageBtn) changeImageBtn.textContent = editStockTranslations[language].change_image;

    // Update buttons
    const buttons = document.querySelectorAll('.buttons-container button, .buttons-container a');
    buttons.forEach((button, index) => {
      if (index < editStockTranslations[language].buttons.length) {
        button.textContent = editStockTranslations[language].buttons[index];
      }
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateEditStockLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });