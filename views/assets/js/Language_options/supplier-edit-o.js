


const editSupplierTranslations = {
  en: {
    title: "Edit Supplier",
    labels: ["Supplier Name", "Phone Number", "Address"],
    buttons: ["Cancel", "Update Supplier"]
  },
  km: {
    title: "កែសម្រួលអ្នកផ្គត់ផ្គង់",
    labels: ["ឈ្មោះអ្នកផ្គត់ផ្គង់", "លេខទូរស័ព្ទ", "អាសយដ្ឋាន"],
    buttons: ["បោះបង់", "ធ្វើបច្ចុប្បន្នភាពអ្នកផ្គត់ផ្គង់"]
  }
};

// Function to update Edit Supplier page language
function updateEditSupplierLanguage(language) {
  // Validate language
  if (!editSupplierTranslations[language]) {
    console.error(`Language "${language}" not supported`);
    return;
  }

  // Update title
  const title = document.querySelector('.card h1.text-center');
  if (title) {
    title.textContent = editSupplierTranslations[language].title;
  } else {
    console.warn('Title element not found with selector ".card h1.text-center"');
  }

  // Update form labels
  const labels = document.querySelectorAll('.card .form-label');
  if (labels.length !== editSupplierTranslations[language].labels.length) {
    console.warn('Number of labels in DOM does not match translation array');
  }
  labels.forEach((label, index) => {
    if (index < editSupplierTranslations[language].labels.length) {
      label.textContent = editSupplierTranslations[language].labels[index];
    }
  });

  // Update buttons with more specific selectors
  const cancelButton = document.querySelector('.card .btn-danger');
  const updateButton = document.querySelector('.card .btn-primary');

  if (cancelButton) {
    cancelButton.textContent = editSupplierTranslations[language].buttons[0];
  } else {
    console.warn('Cancel button not found with selector ".card .btn-danger"');
  }

  if (updateButton) {
    updateButton.textContent = editSupplierTranslations[language].buttons[1];
  } else {
    console.warn('Update button not found with selector ".card .btn-primary"');
  }
}

// Enhanced setLanguage function with fallback
function setLanguage(language) {
  const validLanguage = editSupplierTranslations[language] ? language : 'en';
  console.log('Setting language to:', validLanguage);
  
  // Save to localStorage
  localStorage.setItem('selectedLanguage', validLanguage);
  
  // Update the page
  updateEditSupplierLanguage(validLanguage);
}

// Load saved language on page load
document.addEventListener('DOMContentLoaded', () => {
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  console.log('Applying saved language on page load:', savedLanguage);
  setLanguage(savedLanguage);
});

// Add test buttons for language switching
window.addEventListener('load', () => {
  const testButtons = `
    <div style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
      <button onclick="setLanguage('en')" style="margin-right: 5px;">English</button>
      <button onclick="setLanguage('km')">Khmer</button>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', testButtons);
});

