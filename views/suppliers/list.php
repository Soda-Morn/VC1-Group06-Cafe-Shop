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
        <a href="/suppliers/create" class="btn">+ Add Supplier</a>
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
</body>

</html>
  <!-- JavaScript for Search Functionality and Dropdown Fix -->
  <script src="views/assets/js/Language_options/suppliers-list-o.js"></script>

