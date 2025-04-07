// Define translations for Suppliers List page
const suppliersListTranslations = {
  en: {
    title: "Suppliers List",
    table_headers: ["NO", "Name", "Phone Number", "Address", "Actions"],
    search_placeholder: "Search suppliers...",
    buttons: { add_supplier: "+ Add Supplier" },
    dropdown_items: ["Edit", "Delete"] // English dropdown translations
  },
  km: {
    title: "បញ្ជីអ្នកផ្គត់ផ្គង់",
    table_headers: ["លេខរៀង", "ឈ្មោះ", "លេខទូរស័ព្ទ", "អាសយដ្ឋាន", "សកម្មភាព"],
    search_placeholder: "ស្វែងរកអ្នកផ្គត់ផ្គង់...",
    buttons: { add_supplier: "+ បន្ថែមអ្នកផ្គត់ផ្គង់" },
    dropdown_items: ["កែសម្រួល", "លុប"] // Khmer dropdown translations
  }
};

// Function to update Suppliers List page language
function updateSuppliersListLanguage(language) {
  // Default to 'en' if language is invalid
  const lang = suppliersListTranslations[language] ? language : 'en';

  // Update title
  const title = document.querySelector('.header-container h1');
  if (title) title.textContent = suppliersListTranslations[lang].title;

  // Update table headers
  const headers = document.querySelectorAll('.table thead th');
  headers.forEach((header, index) => {
    if (index < suppliersListTranslations[lang].table_headers.length) {
      header.textContent = suppliersListTranslations[lang].table_headers[index];
    }
  });

  // Update search placeholder
  const searchInput = document.getElementById('supplier-search');
  if (searchInput) searchInput.placeholder = suppliersListTranslations[lang].search_placeholder;

  // Update Add Supplier button
  const addSupplierBtn = document.querySelector('#add'); // Match HTML ID
  if (addSupplierBtn) addSupplierBtn.textContent = suppliersListTranslations[lang].buttons.add_supplier;

  // Update dropdown items (Edit/Delete)
  const dropdownItems = document.querySelectorAll('.dropdown-menu .form'); // Match HTML class 'form'
  dropdownItems.forEach((item, index) => {
    const icon = item.querySelector('i'); // Get the icon
    const text = suppliersListTranslations[lang].dropdown_items[index % 2]; // 0 for Edit, 1 for Delete
    // Remove existing text nodes and append new text after icon
    item.childNodes.forEach(node => {
      if (node.nodeType === Node.TEXT_NODE) node.remove(); // Clear old text
    });
    if (icon) item.appendChild(document.createTextNode(' ' + text)); // Add new text with space
  });
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  console.log('setLanguage called with language:', language); // Debug
  originalSetLanguage(language);
  updateSuppliersListLanguage(language);
  localStorage.setItem('selectedLanguage', language); // Save language preference
};

// DOMContentLoaded listener for language initialization only
document.addEventListener('DOMContentLoaded', function() {
  // Load saved language or default to 'en'
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  console.log('Initial language on page load:', savedLanguage); // Debug
  setLanguage(savedLanguage);

  // Sync with navbar language switcher (adjust selector as needed)
  const languageSelect = document.querySelector('.language-switcher');
  if (languageSelect) {
    languageSelect.addEventListener('change', (event) => {
      const selectedLanguage = event.target.value === 'khmer' ? 'km' : 'en';
      setLanguage(selectedLanguage);
    });
  }
});

// For testing: Add manual trigger buttons
window.addEventListener('load', () => {
  const testButtons = `
    <div style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
      <button style="margin-right: 5px;" onclick="setLanguage('en')">English</button>
      <button onclick="setLanguage('km')">Khmer</button>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', testButtons);
});