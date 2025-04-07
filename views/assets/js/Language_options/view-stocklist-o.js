  // Define translations for View Details page
  const viewDetailsTranslations = {
    en: {
      title: "View Details",
      labels: ["Name:", "Date:", "Stocks:", "item"],
      status_labels: ["In Stock", "Low Stock", "Out of Stock"]
    },
    km: {
      title: "មើលលម្អិត",
      labels: ["ឈ្មោះ:", "កាលបរិច្ឆេទ:", "ស្តុក:", "ធាតុ"],
      status_labels: ["មានស្តុក", "ស្តុកតិច", "អស់ស្តុក"]
    }
  };

  // Function to update View Details page language
  function updateViewDetailsLanguage(language) {
    // Update title
    const title = document.querySelector('.card-header h4');
    if (title) title.textContent = viewDetailsTranslations[language].title;

    // Update labels
    const labelElements = document.querySelectorAll('.card-body .text-center p');
    labelElements.forEach((element, index) => {
      if (index < 3) { // Only the first 3 <p> tags have labels
        const currentText = element.textContent;
        const value = currentText.split(': ')[1]; // Extract the value after the colon
        element.textContent = `${viewDetailsTranslations[language].labels[index]} ${value}`;
      }
    });

    // Update "item" in Stocks line
    const stocksText = labelElements[2]; // Third <p> is Stocks
    if (stocksText) {
      const quantity = stocksText.textContent.match(/\d+/)[0]; // Extract number
      stocksText.textContent = `${viewDetailsTranslations[language].labels[2]} ${quantity} ${viewDetailsTranslations[language].labels[3]}`;
    }

    // Update status badge
    const statusBadge = document.querySelector('.card-body .badge');
    if (statusBadge) {
      const currentStatus = statusBadge.textContent.trim();
      const statusIndex = viewDetailsTranslations.en.status_labels.indexOf(currentStatus);
      if (statusIndex === -1) { // If current text is in Khmer, check against Khmer to find index
        const kmIndex = viewDetailsTranslations.km.status_labels.indexOf(currentStatus);
        if (kmIndex !== -1) statusBadge.textContent = viewDetailsTranslations[language].status_labels[kmIndex];
      } else {
        statusBadge.textContent = viewDetailsTranslations[language].status_labels[statusIndex];
      }
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateViewDetailsLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });