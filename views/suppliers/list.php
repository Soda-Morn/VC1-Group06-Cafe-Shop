<link rel="stylesheet" href="../views/assets/css/supplier_list.css">
<div class="container">
  <!-- Header with Search and Create Button -->
  <div class="header-container">
    <h1>Suppliers List</h1>
    <div class="search-container" style="display: flex; align-items: center;">
      <div class="search-input-container">
        <input type="text" id="supplier-search" class="supplier-search-input" placeholder="Search suppliers..."
          aria-label="Search suppliers" />
        <i class="fas fa-search search-icon"></i>
      </div>
      <!-- Create Supplier Button -->
      <a href="/suppliers/create" id="add" class="btn">+ Add Supplier</a>
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
                <li><a class="form" href="/suppliers/edit/<?= htmlspecialchars($supplier['id']) ?>"><i class="fas fa-edit"
                      style="color: blue;"></i> Edit</a></li>
                <li><a class="form" href="/suppliers/delete/<?= htmlspecialchars($supplier['id']) ?>"
                    onclick="return confirm('Are you sure you want to delete this supplier?');"><i class="fas fa-trash"
                      style="color: red;"></i> Delete</a></li>
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
<script src="views/assets/js/Language_options/suppliers-list-o.js"></script>
<script src="views/assets/js/supplier.js"></script>