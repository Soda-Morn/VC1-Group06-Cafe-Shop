
// Define translations for the category page
const categoryTranslations = {
  en: {
    mainTitle: "Category List",
    listTitle: "Category List",
    tableHeaders: ["NO", "NAME", "Actions"],
    dropdownActions: ["Edit", "Delete"],
    createTitle: "Create Category",
    buttons: ["Create", "Cancel"],
    pagination: ["Previous", "Next"]
  },
  km: {
    mainTitle: "បញ្ជីប្រភេទ",
    listTitle: "បញ្ជីប្រភេទ",
    tableHeaders: ["លេខ", "ឈ្មោះ", "សកម្មភាព"],
    dropdownActions: ["កែសម្រួល", "លុប"],
    createTitle: "បង្កើតប្រភេទ",
    buttons: ["បង្កើត", "បោះបង់"],
    pagination: ["មុន", "បន្ទាប់"]
  }
};

// Function to update category page language
function updateCategoryLanguage(language) {
  if (!categoryTranslations[language]) {
    console.error(`Language "${language}" not supported`);
    return;
  }

  const mainTitle = document.querySelector('.category-container h1');
  if (mainTitle) mainTitle.textContent = categoryTranslations[language].mainTitle;

  const listTitle = document.querySelector('.category-card .category-card-header h5:first-child');
  if (listTitle) listTitle.textContent = categoryTranslations[language].listTitle;

  const headers = document.querySelectorAll('.category-table th');
  if (headers.length === categoryTranslations[language].tableHeaders.length) {
    headers.forEach((th, index) => {
      th.textContent = categoryTranslations[language].tableHeaders[index];
    });
  }

  // Fix dropdown items to show only the translated language
  const dropdownItems = document.querySelectorAll('.category-dropdown-item');
  dropdownItems.forEach((item) => {
    const isDelete = item.classList.contains('text-danger');
    const actionIndex = isDelete ? 1 : 0;
    item.innerHTML = `<i class="material-icons category-icon">${isDelete ? 'delete' : 'edit'}</i> ${categoryTranslations[language].dropdownActions[actionIndex]}`;
  });

  // Fix selector for Create Category title
  const createTitle = document.querySelector('.col-md-6:last-child .category-card-header h5');
  if (createTitle) {
    createTitle.textContent = categoryTranslations[language].createTitle;
  } else {
    console.warn('Create Category title not found');
  }

  const createButton = document.querySelector('.category-card form .btn-primary');
  const cancelLink = document.querySelector('.category-card form .btn-danger');
  if (createButton) createButton.textContent = categoryTranslations[language].buttons[0];
  if (cancelLink) cancelLink.textContent = categoryTranslations[language].buttons[1];

  const prevButton = document.querySelector('#prev-button');
  const nextButton = document.querySelector('#next-button');
  if (prevButton) prevButton.textContent = categoryTranslations[language].pagination[0];
  if (nextButton) nextButton.textContent = categoryTranslations[language].pagination[1];
}

// Preserve existing setLanguage function (if any) and extend it
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
  const validLanguage = categoryTranslations[language] ? language : 'en';
  
  // Call the original setLanguage (likely for navbar)
  originalSetLanguage(validLanguage);
  
  // Update category page if present
  if (document.querySelector('.category-container')) {
    updateCategoryLanguage(validLanguage);
  }
  
  // Store the language
  localStorage.setItem('selectedLanguage', validLanguage);
};

// Dropdown functionality (unchanged from your working old code)
document.addEventListener('DOMContentLoaded', function() {
  const dropdownButtons = document.querySelectorAll('[data-toggle="dropdown"]');

  function closeAllDropdowns(exceptThisOne) {
    document.querySelectorAll('.category-dropdown-menu').forEach(menu => {
      if (menu !== exceptThisOne) {
        menu.classList.remove('show');
      }
    });
  }

  dropdownButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      const dropdownMenu = this.nextElementSibling;
      const isOpen = dropdownMenu.classList.contains('show');
      closeAllDropdowns(dropdownMenu);
      if (!isOpen) {
        dropdownMenu.classList.add('show');
      }
    });
  });

  document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown')) {
      closeAllDropdowns(null);
    }
  });
});

// Language initialization
document.addEventListener('DOMContentLoaded', function() {
  const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
  window.setLanguage(savedLanguage);
});

// Pagination function (placeholder)
function changePage(direction) {
  console.log(`Change page: ${direction}`);
  // Add your pagination logic here if needed
}
