// Define translations for Purchase Items page
const purchaseTranslations = {
  en: {
    title: "Restock",
    search_placeholder: "Search products...",
    add_product: "Add Product",
    price_label: "$",
    qty_label: "Qty:",
    add_to_stock: "Add to stock",
    dropdown_options: ["Edit", "Delete"],
    no_products: "No products found."
  },
  km: {
    title: "បំពេញស្តុក",
    search_placeholder: "ស្វែងរកផលិតផល...",
    add_product: "បន្ថែមផលិតផល",
    price_label: "$",
    qty_label: "បរិមាណ:",
    add_to_stock: "បន្ថែមទៅស្តុក",
    dropdown_options: ["កែសម្រួល", "លុប"],
    no_products: "រកមិនឃើញផលិតផលទេ។"
  }
};

// Function to update Purchase Items page language
function updatePurchaseLanguage(language) {
  // Update title
  const title = document.querySelector('.fixed-header h2');
  if (title) title.textContent = purchaseTranslations[language].title;

  // Update search placeholder
  const searchInput = document.getElementById('product-search');
  if (searchInput) searchInput.placeholder = purchaseTranslations[language].search_placeholder;

  // Update Add Product button
  const addProductBtn = document.querySelector('.btn-Added');
  if (addProductBtn) {
    addProductBtn.innerHTML = `<i class="fas fa-plus"></i> ${purchaseTranslations[language].add_product}`;
  }

  // Update product cards
  const productItems = document.querySelectorAll('.product-item');
  productItems.forEach(item => {
    // Update price label
    const price = item.querySelector('.price');
    if (price) {
      const priceValue = price.querySelector('span').textContent;
      price.innerHTML = `${purchaseTranslations[language].price_label}<span>${priceValue}</span>`;
    }

    // Update stock label
    const stock = item.querySelector('.stock');
    if (stock) {
      const stockValue = stock.textContent.split(': ')[1];
      stock.textContent = `${purchaseTranslations[language].qty_label} ${stockValue}`;
    }

    // Update Add to stock button
    const addButton = item.querySelector('.btn-add-to-cart');
    if (addButton) addButton.textContent = purchaseTranslations[language].add_to_stock;

    // Update dropdown options
    const dropdownItems = item.querySelectorAll('.custom-dropdown-menu .custom-dropdown-item');
    dropdownItems.forEach((dropdownItem, index) => {
      if (index < purchaseTranslations[language].dropdown_options.length) {
        // Get the icon element
        const iconElement = dropdownItem.querySelector('i');
        const iconHTML = iconElement ? iconElement.outerHTML : '';

        // Create a new span for the text if it doesn't exist
        let textSpan = dropdownItem.querySelector('span');
        if (!textSpan) {
          textSpan = document.createElement('span');
          dropdownItem.appendChild(textSpan);
        }

        // Clear the dropdown item content and rebuild it
        dropdownItem.innerHTML = '';
        dropdownItem.insertAdjacentHTML('afterbegin', iconHTML);
        textSpan = dropdownItem.appendChild(textSpan); // Re-append the span
        textSpan.textContent = ` ${purchaseTranslations[language].dropdown_options[index]}`; // Add space before text
      }
    });
  });

  // Update "No products found" message
  const noProducts = document.querySelector('#product-list .text-muted');
  if (noProducts) noProducts.textContent = purchaseTranslations[language].no_products;
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  originalSetLanguage(language); // Call the navbar/stock list setLanguage
  updatePurchaseLanguage(language); // Update this page
};

// Load saved language on page load
document.addEventListener('DOMContentLoaded', () => {
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  setLanguage(savedLanguage);
});