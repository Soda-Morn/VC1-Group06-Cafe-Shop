<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suppliers List</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Header Styles */
    .container h1 {
      margin-top: 5px;
      margin-left: 10px;
      font-size: 1.8rem;
      /* Smaller font size */
    }

    /* Header and Search Container */
    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      /* Reduced margin */
      margin-top: 25px;
      margin-right: 10px;
      /* Reduced margin */
    }

    /* Button Styles */
    .btn {
      font-size: 0.9rem;
      /* Smaller font size */
      padding: 7px 15px;
      /* Smaller padding */
      border-radius: 5px;
      color: #fff;
      text-decoration: none;
      background-color: rgb(183, 90, 23);
    }

    .btn:hover {
      background-color: rgb(160, 80, 20);
    }

    /* Search Bar Styles */
    .search-input-container {
      position: relative;
    }

    .search-input {
      border-radius: 5px;
      border: 1px solid rgb(203, 198, 198);
      padding: 6px 10px 6px 30px;
      /* Smaller padding */
      width: 180px;
      /* Smaller width */
      font-size: 1rem;
      /* Smaller font size */
      height: 35px;
      /* Smaller height */
      background-color: white;
    }

    .search-input:focus {
      outline: none;
    }

    .search-input-container {
      margin-right: 10px;
      /* Reduced margin */
    }

    /* Search Icon */
    .search-icon {
      position: absolute;
      left: 8px;
      /* Adjusted position */
      top: 50%;
      transform: translateY(-50%);
    }

    /* Table Styles */
     .table-responsive {
           
            overflow-x: auto;
            background: #fff;
            /* box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0); */
            /* Subtle inner shadow */
        }

        .table {
            margin-bottom: 0;
            border-collapse: collapse;
            font-size: 1rem;
            color: #333;
        }
    .table thead {
      background-color: orange;
      border-radius: 10px;
      color: white;
      text-align: center;
    }

    .table tbody tr {
      background-color: #f4f4f4;
      text-align: center;
    }

    .table thead th {
      background-color:  #f97316;
      color: white;
      font-size: 0.9rem;
      /* Smaller font size */
    }

    /* Dropdown Styles */
    .dropdown-toggle::after {
      display: none;
    }

    .three-dots {
      border: none;
      background-color: transparent;
      font-size: 1.2rem;
      /* Smaller font size */
      cursor: pointer;
      color: #333;
    }

    .three-dots:focus {
      color: rgb(183, 90, 23);
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header with Search and Create Button -->
    <div class="header-container">
      <h1>Suppliers List</h1>
      <div class="search-container" style="display: flex; align-items: center;">
        <div class="search-input-container">
          <input type="text" id="supplier-search" class="search-input" placeholder="Search suppliers..." aria-label="Search suppliers" />
          <i class="fas fa-search search-icon"></i>
        </div>
        <!-- Create Supplier Button -->
        <a href="/suppliers/create" class="add-btn">+ Add Supplier</a>
      </div>
    </div>

    <!-- Supplier Table -->
    <table class="table table-striped table-sm m-3">
      <thead>
        <tr>
          <th>NO</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $counter = 1; ?>
        <?php foreach ($suppliers as $supplier): ?>
          <tr class="supplier-item">
            <td><?= $counter++ ?></td>
            <td><?= htmlspecialchars($supplier['name']) ?></td>
            <td><?= htmlspecialchars($supplier['phone_number']) ?></td>
            <td><?= htmlspecialchars($supplier['address']) ?></td>
            <td>
              <!-- Three Dots Dropdown -->
              <div class="dropdown">
                <button class="three-dots" aria-expanded="false" data-bs-toggle="dropdown">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/suppliers/edit/<?= htmlspecialchars($supplier['id']) ?>"><i class="fas fa-edit" style="color: blue;"></i>Edit</a></li>
                  <li><a class="dropdown-item" href="/suppliers/delete/<?= htmlspecialchars($supplier['id']) ?>" onclick="return confirm('Are you sure you want to delete this supplier?');"><i class="fas fa-trash" style="color: red;"></i>Delete</a></li>
                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <!-- JavaScript for Search Functionality -->
  <script>
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
  </script>
  <script>
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
</script>
</body>

</html>