  // Define translations for Stock Inventory page
  const stockTranslations = {
    en: {
      title: "Stock Inventory List",
      search_placeholder: "Search products...",
      filter_options: ["All Status", "In Stock", "Low Stock", "Out of Stock"],
      table_headers: ["NO", "Image", "PRODUCTS", "DATE ADDED", "STOCK", "STATUS", "OPTION"],
      status_labels: ["In Stock", "Low Stock", "Out of Stock"],
      dropdown_options: ["View Details", "Edit", "Delete"]
    },
    km: {
      title: "បញ្ជីស្តុកទំនិញ",
      search_placeholder: "ស្វែងរកផលិតផល...",
      filter_options: ["ស្ថានភាពទាំងអស់", "មានស្តុក", "ស្តុកតិច", "អស់ស្តុក"],
      table_headers: ["លេខ", "រូបភាព", "ផលិតផល", "កាលបរិច្ឆេទបន្ថែម", "ស្តុក", "ស្ថានភាព", "ជម្រើស"],
      status_labels: ["មានស្តុក", "ស្តុកតិច", "អស់ស្តុក"],
      dropdown_options: ["មើលលម្អិត", "កែសម្រួល", "លុប"]
    }
  };

  // Function to update stock page language
  function updateStockLanguage(language) {
    // Update card title
    const title = document.querySelector('.card-title');
    if (title) title.textContent = stockTranslations[language].title;

    // Update search placeholder
    const searchInput = document.getElementById('tableSearch');
    if (searchInput) searchInput.placeholder = stockTranslations[language].search_placeholder;

    // Update filter dropdown options
    const filterSelect = document.getElementById('stockFilter');
    if (filterSelect) {
      filterSelect.querySelectorAll('option').forEach((option, index) => {
        option.textContent = stockTranslations[language].filter_options[index];
      });
    }

    // Update table headers
    const headers = document.querySelectorAll('#stockTable thead th');
    headers.forEach((header, index) => {
      header.textContent = stockTranslations[language].table_headers[index];
    });

    // Update status labels in table rows based on data-status
    const rows = document.querySelectorAll('#stockTable tbody tr');
    rows.forEach(row => {
      const statusSpan = row.querySelector('td:nth-child(6) span');
      const status = row.getAttribute('data-status'); // Get status from data attribute
      if (statusSpan && status) {
        if (status === "In Stock") {
          statusSpan.textContent = stockTranslations[language].status_labels[0];
        } else if (status === "Low Stock") {
          statusSpan.textContent = stockTranslations[language].status_labels[1];
        } else if (status === "Out of Stock") {
          statusSpan.textContent = stockTranslations[language].status_labels[2];
        }
      }
    });

    // Update dropdown menu options
    const dropdownItems = document.querySelectorAll('.custom-dropdown-menu .custom-dropdown-item');
    dropdownItems.forEach((item, index) => {
      const textSpan = item.querySelector('span') || item; // Handle Delete which has a span
      if (index < stockTranslations[language].dropdown_options.length) {
        textSpan.textContent = stockTranslations[language].dropdown_options[index];
      }
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar's setLanguage
    updateStockLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });