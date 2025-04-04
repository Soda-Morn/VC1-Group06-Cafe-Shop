const orderListTranslations = {
    en: {
      title: "Order List",
      table_headers: ["NO", "Item", "Original Price", "Quantity", "Total Price", "Date of Birth", "Status"],
      no_orders: "No orders found.",
      statuses: {
        "Completed": "Completed",
        "Pending": "Pending",
        "Shipped": "Shipped"
      }
    },
    km: {
      title: "បញ្ជីការបញ្ជាទិញ",
      table_headers: ["លេខរៀង", "ទំនិញ", "តម្លៃដើម", "បរិមាណ", "តម្លៃសរុប", "កាលបរិច្ឆេទកំណើត", "ស្ថានភាព"],
      no_orders: "រកមិនឃើញការបញ្ជាទិញទេ។",
      statuses: {
        "Completed": "បានបញ្ចប់",
        "Pending": "កំពុងរង់ចាំ",
        "Shipped": "បានដឹកជញ្ជូន"
      }
    }
  };

  // Function to update Order List page language
  function updateOrderListLanguage(language) {
    // Update title with corrected selector
    const title = document.querySelector('h2.text-left'); // Changed from text-start to text-left
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = orderListTranslations[language].title;
    } else {
      console.error('Title element not found with selector h2.text-left');
    }

    // Update table headers
    const headers = document.querySelectorAll('.table thead th');
    console.log('Number of headers found:', headers.length); // Debug
    headers.forEach((header, index) => {
      if (index < orderListTranslations[language].table_headers.length) {
        header.textContent = orderListTranslations[language].table_headers[index];
      }
    });

    // Update "No orders found" message
    const noOrders = document.querySelector('.table tbody td');
    if (noOrders && noOrders.textContent === orderListTranslations.en.no_orders) {
      noOrders.textContent = orderListTranslations[language].no_orders;
    }

    // Update status badges dynamically
    const badges = document.querySelectorAll('.badge');
    console.log('Number of badges found:', badges.length); // Debug
    badges.forEach(badge => {
      const originalStatus = badge.getAttribute('data-original-status') || badge.textContent.trim();
      if (orderListTranslations.en.statuses[originalStatus]) {
        badge.textContent = orderListTranslations[language].statuses[originalStatus];
        badge.setAttribute('data-original-status', originalStatus); // Preserve original
      }
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateOrderListLanguage(language);
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