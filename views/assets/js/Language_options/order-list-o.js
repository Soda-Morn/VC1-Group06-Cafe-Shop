// Extended language translations for Order List page
const orderListTranslations = {
  en: {
    title: "Order List",
    table_headers: ["NO", "Item", "Original Price", "Quantity", "Total Price", "Date of Order", "Status"],
    filter_options: ["All", "Today", "Yesterday", "Last Week", "Last Month", "Last Year"],
    date_picker: "Select Date",
    date_range: "Select Date Range",
    no_orders: "No orders found.",
    no_orders_filter: "No orders found for this time period.",
    pagination: ["Previous", "Next"],
    statuses: {
      "Completed": "Completed",
      "Pending": "Pending",
      "Shipped": "Shipped"
    }
  },
  km: {
    title: "បញ្ជីការបញ្ជាទិញ",
    table_headers: ["លេខរៀង", "ទំនិញ", "តម្លៃដើម", "បរិមាណ", "តម្លៃសរុប", "កាលបរិច្ឆេទបញ្ជាទិញ", "ស្ថានភាព"],
    filter_options: ["ទាំងអស់", "ថ្ងៃនេះ", "ម្សិលមិញ", "សប្តាហ៍មុន", "ខែមុន", "ឆ្នាំមុន"],
    date_picker: "ជ្រើសរើសកាលបរិច្ឆេទ",
    date_range: "ជ្រើសរើសជួរកាលបរិច្ឆេទ",
    no_orders: "រកមិនឃើញការបញ្ជាទិញទេ។",
    no_orders_filter: "រកមិនឃើញការបញ្ជាទិញសម្រាប់រយៈពេលនេះទេ។",
    pagination: ["មុន", "បន្ទាប់"],
    statuses: {
      "Completed": "បានបញ្ចប់",
      "Pending": "កំពុងរង់ចាំ",
      "Shipped": "បានដឹកជញ្ជូន"
    }
  }
};

// Function to update Order List page language
function updateOrderListLanguage(language) {
  // Update title (corrected selector to match your HTML)
  const title = document.querySelector('h2.text-start'); // Matches your HTML
  if (title) {
    title.textContent = orderListTranslations[language].title;
  } else {
    console.error('Title element not found with selector h2.text-start');
  }

  // Update table headers
  const headers = document.querySelectorAll('.table thead th');
  headers.forEach((header, index) => {
    if (index < orderListTranslations[language].table_headers.length) {
      header.textContent = orderListTranslations[language].table_headers[index];
    }
  });

  // Update filter dropdown options
  const filterOptions = document.querySelectorAll('#timeFilter option');
  filterOptions.forEach((option, index) => {
    if (index < orderListTranslations[language].filter_options.length) {
      option.textContent = orderListTranslations[language].filter_options[index];
    }
  });

  // Update date picker button
  const datePickerButton = document.querySelector('#datePickerButton');
  if (datePickerButton) {
    const currentText = datePickerButton.childNodes[0].textContent.trim();
    if (currentText === "Select Date" || currentText === "ជ្រើសរើសកាលបរិច្ឆេទ") {
      datePickerButton.childNodes[0].textContent = orderListTranslations[language].date_picker;
    } else if (currentText === "Select Date Range" || currentText === "ជ្រើសរើសជួរកាលបរិច្ឆេទ") {
      datePickerButton.childNodes[0].textContent = orderListTranslations[language].date_range;
    }
  }

  // Update date picker menu items
  const selectDate = document.querySelector('#selectDate');
  const selectDateRange = document.querySelector('#selectDateRange');
  if (selectDate) selectDate.textContent = orderListTranslations[language].date_picker;
  if (selectDateRange) selectDateRange.textContent = orderListTranslations[language].date_range;

  // Update "No orders found" message
  const noOrders = document.querySelector('.no-orders-row td');
  if (noOrders) {
    noOrders.textContent = orderListTranslations[language].no_orders;
  }

  // Update no orders filter message
  const noOrdersMessage = document.querySelector('#noOrdersMessage');
  if (noOrdersMessage) {
    noOrdersMessage.textContent = orderListTranslations[language].no_orders_filter;
  }

  // Update pagination buttons
  const prevBtn = document.querySelector('#prevBtn');
  const nextBtn = document.querySelector('#nextBtn');
  if (prevBtn) prevBtn.textContent = orderListTranslations[language].pagination[0];
  if (nextBtn) nextBtn.textContent = orderListTranslations[language].pagination[1];

  // Update status badges
  const badges = document.querySelectorAll('.badge');
  badges.forEach(badge => {
    const originalStatus = badge.getAttribute('data-original-status') || badge.textContent.trim();
    if (orderListTranslations.en.statuses[originalStatus]) {
      badge.textContent = orderListTranslations[language].statuses[originalStatus];
      badge.setAttribute('data-original-status', originalStatus);
    }
  });
}

// Function to create language selector
function setupLanguageSelector() {
  const selectorHTML = `
    <div style="position: fixed; top: 10px; right: 160px; z-index: 1000;">
      <select id="languageSelect" class="filter-button">
        <option value="en">English</option>
        <option value="km">Khmer</option>
      </select>
    </div>
  `;
  document.body.insertAdjacentHTML('afterbegin', selectorHTML);

  const languageSelect = document.getElementById('languageSelect');
  
  // Set initial language
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  languageSelect.value = savedLanguage;

  // Update language on change
  languageSelect.addEventListener('change', (event) => {
    const selectedLanguage = event.target.value;
    localStorage.setItem('selectedLanguage', selectedLanguage);
    updateOrderListLanguage(selectedLanguage);
  });

  // Apply initial language after DOM is ready
  document.addEventListener('DOMContentLoaded', () => {
    updateOrderListLanguage(savedLanguage);
  });
}

// Integrate with existing setLanguage function (optional)
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  originalSetLanguage(language);
  updateOrderListLanguage(language);
};

// Run setup immediately
setupLanguageSelector();

// For testing: Add manual buttons (optional)
window.addEventListener('load', () => {
  const testButtons = `
    <div style="position: fixed; top: 10px; right: 10px;">
      <button onclick="setLanguage('en')">English</button>
      <button onclick="setLanguage('km')">Khmer</button>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', testButtons);
});