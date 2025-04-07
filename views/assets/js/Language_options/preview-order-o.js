// Define translations for Preview Order page
const previewOrderTranslations = {
  en: {
    title: "Preview",
    subtitle: "Review your order before finalizing.",
    table_headers: ["IMAGE", "ITEM", "PRICE", "QUANTITY", "SUBTOTAL"],
    total_label: "Total: $",
    buttons: {
      save_pdf: "Save to PDF"
    },
    pdf_only: {
      order_notes: "Order Notes",
      date_label: "Date: "
    },
    no_items: "No items to preview"
  },
  km: {
    title: "មើលជាមុន",
    subtitle: "ពិនិត្យមើលការបញ្ជាទិញរបស់អ្នកមុននឹងបញ្ចប់។",
    table_headers: ["រូបភាព", "ទំនិញ", "តម្លៃ", "បរិមាណ", "សរុបរង"],
    total_label: "សរុប: $",
    buttons: {
      save_pdf: "រក្សាទុកជា PDF"
    },
    pdf_only: {
      order_notes: "កំណត់ចំណាំការបញ្ជាទិញ",
      date_label: "កាលបរិច្ឆេទ: "
    },
    no_items: "គ្មានទំនិញសម្រាប់មើលជាមុនទេ"
  }
};

// Function to update Preview Order page language
function updatePreviewOrderLanguage(language) {
  // Update title
  const title = document.querySelector('.preview-header h2');
  if (title) {
    title.textContent = previewOrderTranslations[language].title;
  } else {
    console.error('Title element not found with selector .preview-header h2');
  }

  // Update subtitle
  const subtitle = document.querySelector('.preview-header p');
  if (subtitle) {
    subtitle.textContent = previewOrderTranslations[language].subtitle;
  }

  // Update table headers
  const headers = document.querySelectorAll('.table thead th');
  headers.forEach((header, index) => {
    if (index < previewOrderTranslations[language].table_headers.length) {
      header.textContent = previewOrderTranslations[language].table_headers[index];
    }
  });

  // Update total label
  const totalLabel = document.querySelector('.total-row .total-price');
  if (totalLabel) {
    const totalValue = totalLabel.textContent.replace(/[^0-9.]/g, ''); // Extract the numeric value
    totalLabel.parentElement.innerHTML = `${previewOrderTranslations[language].total_label}<span class="total-price">$${totalValue}</span>`;
  }

  // Update Save to PDF button
  const savePdfBtn = document.getElementById('savePdfBtn');
  if (savePdfBtn) {
    savePdfBtn.textContent = previewOrderTranslations[language].buttons.save_pdf;
  }

  // Update PDF-only content (Order Notes and Date)
  const orderNotes = document.querySelector('.pdf-only h3');
  if (orderNotes) {
    orderNotes.textContent = previewOrderTranslations[language].pdf_only.order_notes;
  }

  const dateLabel = document.querySelector('.pdf-only p');
  if (dateLabel) {
    const dateValue = dateLabel.textContent.split(': ')[1]; // Extract the date value
    dateLabel.textContent = `${previewOrderTranslations[language].pdf_only.date_label}${dateValue}`;
  }

  // Update no items message (if applicable)
  const noItemsMessage = document.querySelector('.no-items-message');
  if (noItemsMessage) {
    noItemsMessage.textContent = previewOrderTranslations[language].no_items;
  }

  // Store the current language for PDF generation
  window.currentPreviewLanguage = language;
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  originalSetLanguage(language);
  updatePreviewOrderLanguage(language);
};

// Load saved language on page load
document.addEventListener('DOMContentLoaded', () => {
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  setLanguage(savedLanguage);
});