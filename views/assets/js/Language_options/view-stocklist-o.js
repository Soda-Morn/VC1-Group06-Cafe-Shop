// Define translations for View Details page
const viewStockTranslations = {
  en: {
    title: "View Details",
    labels: {
      name: "Name:",
      date: "Date:",
      stocks: "Stocks:"
    },
    stock_status: {
      in_stock: "In Stock",
      low_stock: "Low Stock",
      out_of_stock: "Out of Stock"
    },
    items: "item"
  },
  km: {
    title: "មើលព័ត៌មានលម្អិត",
    labels: {
      name: "ឈ្មោះ:",
      date: "កាលបរិច្ឆេទ:",
      stocks: "ស្តុក:"
    },
    stock_status: {
      in_stock: "មានស្តុក",
      low_stock: "ស្តុកទាប",
      out_of_stock: "អស់ស្តុក"
    },
    items: "ធាតុ"
  }
};

// Function to update View Details page language
function updateViewStockLanguage(language) {
  // Update title
  function updateTitle() {
    const title = document.querySelector('.card-header h4');
    if (title) {
      title.textContent = viewStockTranslations[language].title;
    } else {
      console.warn('Title element not found, retrying...');
      setTimeout(updateTitle, 100);
    }
  }
  updateTitle();

  // Update labels with retry mechanism
  function updateLabels() {
    const nameLabel = document.querySelector('.text-center p:nth-child(1)');
    const dateLabel = document.querySelector('.text-center p:nth-child(2)');
    const stocksLabel = document.querySelector('.text-center p:nth-child(3)');

    if (nameLabel) {
      const nameValue = nameLabel.textContent.split(': ')[1];
      nameLabel.innerHTML = `<span class="fw-bold fs-6 mb-2 text-dark">${viewStockTranslations[language].labels.name}</span> ${nameValue}`;
    } else {
      console.warn('Name label not found, retrying...');
      setTimeout(updateLabels, 100);
      return;
    }

    if (dateLabel) {
      const dateValue = dateLabel.textContent.split(': ')[1];
      dateLabel.innerHTML = `<span class="text-muted mb-2">${viewStockTranslations[language].labels.date}</span> ${dateValue}`;
    } else {
      console.warn('Date label not found, retrying...');
      setTimeout(updateLabels, 100);
      return;
    }

    if (stocksLabel) {
      const stocksValue = stocksLabel.textContent.match(/\d+/)[0];
      stocksLabel.innerHTML = `<span class="fw-semibold mb-3 text-dark">${viewStockTranslations[language].labels.stocks}</span> ${stocksValue} ${viewStockTranslations[language].items}`;
    } else {
      console.warn('Stocks label not found, retrying...');
      setTimeout(updateLabels, 100);
      return;
    }
  }
  updateLabels();

  // Update stock status
  function updateStockStatus() {
    const stockStatus = document.querySelector('.badge');
    if (stockStatus) {
      const currentStatus = stockStatus.textContent.trim();
      let newStatus;
      if (currentStatus === viewStockTranslations.en.stock_status.in_stock) {
        newStatus = viewStockTranslations[language].stock_status.in_stock;
      } else if (currentStatus === viewStockTranslations.en.stock_status.low_stock) {
        newStatus = viewStockTranslations[language].stock_status.low_stock;
      } else if (currentStatus === viewStockTranslations.en.stock_status.out_of_stock) {
        newStatus = viewStockTranslations[language].stock_status.out_of_stock;
      }
      if (newStatus) {
        stockStatus.textContent = newStatus;
      }
    } else {
      console.warn('Stock status badge not found, retrying...');
      setTimeout(updateStockStatus, 100);
    }
  }
  updateStockStatus();
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  console.log('setLanguage called with language:', language); // Debug
  localStorage.setItem('selectedLanguage', language); // Save language
  originalSetLanguage(language);
  updateViewStockLanguage(language);
};

// Load saved language on page load
window.addEventListener('load', () => {
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