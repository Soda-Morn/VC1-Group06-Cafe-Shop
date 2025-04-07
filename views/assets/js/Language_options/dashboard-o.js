  // Define translations for Dashboard page
  const dashboardTranslations = {
    en: {
      card_categories: ["Revenue", "Expenses", "Total Items Sold", "Profit"],
      sale_report_title: "Sale Report",
      time_periods: ["Week", "Month", "Year"],
      action_buttons: ["Export", "Print"],
      top_selling_title: "Top Selling Products",
      top_selling_labels: ["Sold:", "Revenue:"],
      low_stock_title: "Product Low Stock",
      low_stock_headers: ["NO", "IMAGE", "PRODUCTS", "DATE ADDED", "STOCK", "STATUS"],
      low_stock_status: ["Out of Stock", "Low Stock"],
      no_low_stock_message: "No low stock products found.",
      no_sales_message: "No sales data available."
    },
    km: {
      card_categories: ["ប្រាក់ចំណូល", "ចំណាយ", "ទំនិញលក់សរុប", "ប្រាក់ចំណេញ"],
      sale_report_title: "របាយការណ៍លក់",
      time_periods: ["សប្តាហ៍", "ខែ", "ឆ្នាំ"],
      action_buttons: ["នាំចេញ", "បោះពុម្ព"],
      top_selling_title: "ផលិតផលលក់ដាច់បំផុត",
      top_selling_labels: ["លក់:", "ប្រាក់ចំណូល:"],
      low_stock_title: "ផលិតផលស្តុកទាប",
      low_stock_headers: ["លេខរៀង", "រូបភាព", "ផលិតផល", "កាលបរិច្ឆេទបន្ថែម", "ស្តុក", "ស្ថានភាព"],
      low_stock_status: ["អស់ស្តុក", "ស្តុកទាប"],
      no_low_stock_message: "រកមិនឃើញផលិតផលស្តុកទាបទេ។",
      no_sales_message: "មិនមានទិន្នន័យលក់ទេ។"
    }
  };

  // Function to update Dashboard page language
  function updateDashboardLanguage(language) {
    // Update card categories (Revenue, Expenses, Total Items Sold, Profit)
    const cardCategories = document.querySelectorAll('.card-category');
    cardCategories.forEach((category, index) => {
      if (index < dashboardTranslations[language].card_categories.length) {
        category.textContent = dashboardTranslations[language].card_categories[index];
      }
    });

    // Update Sale Report title - Fixed selector
    const saleReportTitle = document.querySelector('.col-md-8 .card-head-row .card-title');
    if (saleReportTitle) {
      saleReportTitle.textContent = dashboardTranslations[language].sale_report_title;
      console.log('Sale Report title updated to:', saleReportTitle.textContent); // Debug
    } else {
      console.error('Sale Report title not found with selector .col-md-8 .card-head-row .card-title');
    }

    // Update time period buttons (Week, Month, Year)
    const timePeriodButtons = document.querySelectorAll('.btn-group .btn');
    timePeriodButtons.forEach((button, index) => {
      if (index < dashboardTranslations[language].time_periods.length) {
        button.textContent = dashboardTranslations[language].time_periods[index];
      }
    });

    // Update Export and Print buttons
    const actionButtons = document.querySelectorAll('.card-tools .btn');
    actionButtons.forEach((button, index) => {
      if (index < dashboardTranslations[language].action_buttons.length) {
        const label = button.querySelector('.btn-label');
        if (label) {
          button.innerHTML = `<span class="btn-label">${label.innerHTML}</span> ${dashboardTranslations[language].action_buttons[index]}`;
        }
      }
    });

    // Update Top Selling Products title
    const topSellingTitle = document.querySelector('.col-md-4 .card-title');
    if (topSellingTitle) {
      topSellingTitle.textContent = dashboardTranslations[language].top_selling_title;
    }

    // Update Top Selling Products labels (Sold, Revenue)
    const topSellingLabels = document.querySelectorAll('.info-user .status');
    topSellingLabels.forEach((label, index) => {
      const value = label.textContent.split(': ')[1]; // Preserve the value (e.g., "5 units" or "$100.00")
      label.textContent = `${dashboardTranslations[language].top_selling_labels[index % 2]} ${value}`;
    });

    // Update No Sales Data message
    const noSalesMessage = document.querySelector('.alert.alert-warning');
    if (noSalesMessage) {
      noSalesMessage.textContent = dashboardTranslations[language].no_sales_message;
    }

    // Update Product Low Stock title
    const lowStockTitle = document.querySelector('.col-md-12 .card-title');
    if (lowStockTitle) {
      lowStockTitle.textContent = dashboardTranslations[language].low_stock_title;
    }

    // Update Product Low Stock table headers
    const lowStockHeaders = document.querySelectorAll('.table thead th');
    lowStockHeaders.forEach((header, index) => {
      if (index < dashboardTranslations[language].low_stock_headers.length) {
        header.textContent = dashboardTranslations[language].low_stock_headers[index];
      }
    });

    // Update Product Low Stock status (Out of Stock, Low Stock)
    const lowStockStatuses = document.querySelectorAll('.table tbody td:last-child');
    lowStockStatuses.forEach((status) => {
      if (status.textContent === "Out of Stock") {
        status.textContent = dashboardTranslations[language].low_stock_status[0];
      } else if (status.textContent === "Low Stock") {
        status.textContent = dashboardTranslations[language].low_stock_status[1];
      }
    });

    // Update No Low Stock message
    const noLowStockMessage = document.querySelector('.table tbody td.text-center');
    if (noLowStockMessage && noLowStockMessage.textContent === "No low stock products found.") {
      noLowStockMessage.textContent = dashboardTranslations[language].no_low_stock_message;
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call any existing setLanguage function
    updateDashboardLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });