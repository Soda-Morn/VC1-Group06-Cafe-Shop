
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('supplier-search');
      const supplierItems = document.querySelectorAll('.supplier-item');

      function filterSuppliers() {
        const searchTerm = searchInput.value.toLowerCase().trim();

        supplierItems.forEach(item => {
          const supplierName = item.querySelector('td:nth-child(2)').textContent.toLowerCase();
          item.style.display = supplierName.includes(searchTerm) ? '' : 'none';
        });
      }

      searchInput.addEventListener('input', filterSuppliers);
    });
// Define translations for Suppliers List page
const suppliersListTranslations = {
en: {
  title: "Suppliers List",
  table_headers: ["NO", "Name", "Phone Number", "Address", "Actions"],
  search_placeholder: "Search suppliers...",
  buttons: {
    add_supplier: "+ Add Supplier"
  },
  dropdown_items: ["Edit", "Delete"]
},
km: {
  title: "បញ្ជីអ្នកផ្គត់ផ្គង់",
  table_headers: ["លេខរៀង", "ឈ្មោះ", "លេខទូរស័ព្ទ", "អាសយដ្ឋាន", "សកម្មភាព"],
  search_placeholder: "ស្វែងរកអ្នកផ្គត់ផ្គង់...",
  buttons: {
    add_supplier: "+ បន្ថែមអ្នកផ្គត់ផ្គង់"
  },
  dropdown_items: ["កែសម្រួល", "លុប"]
}
};

// Function to update Suppliers List page language
function updateSuppliersListLanguage(language) {
// Update title
const title = document.querySelector('.header-container h1');
console.log('Title element found:', title); // Debug
if (title) {
  title.textContent = suppliersListTranslations[language].title;
} else {
  console.error('Title element not found with selector .header-container h1');
}

// Update table headers
const headers = document.querySelectorAll('.table thead th');
headers.forEach((header, index) => {
  if (index < suppliersListTranslations[language].table_headers.length) {
    header.textContent = suppliersListTranslations[language].table_headers[index];
  }
});

// Update search placeholder
const searchInput = document.getElementById('supplier-search');
if (searchInput) {
  searchInput.placeholder = suppliersListTranslations[language].search_placeholder;
}

// Update Add Supplier button
const addSupplierBtn = document.querySelector('.search-container .btn');
if (addSupplierBtn) {
  addSupplierBtn.textContent = suppliersListTranslations[language].buttons.add_supplier;
}

// Update dropdown items (Edit and Delete)
const dropdownItems = document.querySelectorAll('.dropdown-item');
dropdownItems.forEach((item, index) => {
  const icon = item.querySelector('i'); // Preserve the icon
  const text = suppliersListTranslations[language].dropdown_items[index % 2]; // Edit (0), Delete (1), Edit (2), Delete (3), etc.
  item.innerHTML = ''; // Clear existing content
  item.appendChild(icon); // Re-append the icon
  item.appendChild(document.createTextNode(' ' + text)); // Add the translated text with a space
});
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
console.log('setLanguage called with language:', language); // Debug
originalSetLanguage(language);
updateSuppliersListLanguage(language);
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

// Existing search functionality
document.addEventListener('DOMContentLoaded', function() {
const searchInput = document.getElementById('supplier-search');
const supplierItems = document.querySelectorAll('.supplier-item');

function filterSuppliers() {
  const searchTerm = searchInput.value.toLowerCase().trim();

  supplierItems.forEach(item => {
    const supplierName = item.querySelector('td:nth-child(2)').textContent.toLowerCase();
    item.style.display = supplierName.includes(searchTerm) ? '' : 'none';
  });
}

searchInput.addEventListener('input', filterSuppliers);
});