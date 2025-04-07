// Define translations for the Edit Category page
const editCategoryTranslations = {
  en: {
    title: "Edit Category",
    label: "Category Name",
    buttons: ["Update", "Cancel"]
  },
  km: {
    title: "កែសម្រួលប្រភេទ",
    label: "ឈ្មោះប្រភេទ",
    buttons: ["ធ្វើបច្ចុប្បន្នភាព", "បោះបង់"]
  }
};

// Function to update Edit Category page language
function updateEditCategoryLanguage(language) {
  if (!editCategoryTranslations[language]) {
    console.error(`Language "${language}" not supported`);
    return;
  }

  // Update title
  const title = document.querySelector('.card-header h5');
  if (title) {
    title.textContent = editCategoryTranslations[language].title;
  } else {
    console.warn('Edit Category title not found');
  }

  // Update label
  const label = document.querySelector('.form-group label[for="name"]');
  if (label) {
    label.textContent = editCategoryTranslations[language].label;
  } else {
    console.warn('Category Name label not found');
  }

  // Update buttons
  const updateButton = document.querySelector('.card-body .btn-primary');
  const cancelLink = document.querySelector('.card-body .btn-danger');
  if (updateButton) {
    updateButton.textContent = editCategoryTranslations[language].buttons[0];
  } else {
    console.warn('Update button not found');
  }
  if (cancelLink) {
    cancelLink.textContent = editCategoryTranslations[language].buttons[1];
  } else {
    console.warn('Cancel link not found');
  }
}

// Extend the existing setLanguage function to handle Edit Category page
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  const validLanguage = editCategoryTranslations[language] ? language : 'en';
  
  // Call the original setLanguage (for navbar and other pages)
  originalSetLanguage(validLanguage);
  
  // Update Edit Category page if present
  if (document.querySelector('.card-header h5')) {
    updateEditCategoryLanguage(validLanguage);
  }
  
  // Store the language
  localStorage.setItem('selectedLanguage', validLanguage);
};

// Language initialization
document.addEventListener('DOMContentLoaded', function() {
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  window.setLanguage(savedLanguage);
});

// Test buttons (for debugging)
window.addEventListener('load', () => {
  const testButtons = `
    <div style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
      <button onclick="window.setLanguage('en')" style="margin-right: 5px;">English</button>
      <button onclick="window.setLanguage('km')">Khmer</button>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', testButtons);
});