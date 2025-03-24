<div class="container mt-6">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stock Inventory List</h4>
                </div>
              
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="stockTable" class="display table table-striped table-hover">
                                <div class="d-flex gap-2 m-3 mb-3">
                                <!-- Search Input -->
                                <input type="text" id="tableSearch" class="form-control form-control-sm mb-3" placeholder="Search products..." style="max-width: 200px;">

                                <!-- Status Filter Dropdown -->
                                <select id="stockFilter" class="form-select form-select-sm mb-3" style="max-width: 150px;">
                                    <option value="">All Status</option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Low Stock">Low Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>
                            <thead>
                                <tr>
                                    <th class="bg-warning">ID</th>
                                    <th class="bg-warning">Image</th>
                                    <th class="bg-warning">PRODUCTS</th>
                                    <th class="bg-warning">DATE ADDED</th>
                                    <th class="bg-warning">STOCK</th>
                                    <th class="bg-warning">STATUS</th>
                                    <th class="bg-warning">OPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocklist as $index => $row) : ?>
                                    <tr data-status="<?= htmlspecialchars($row['quantity'] == 0 ? 'Out of Stock' : ($row['quantity'] <= 3 ? 'Low Stock' : 'In Stock')) ?>">
                                        <td><?= $index + 1; ?></td>
                                        <td>
                                            <img src="<?= $row['product_image']; ?>" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                        </td>
                                        <td><?= $row['product_name']; ?></td>
                                        <td><?= date('F j, Y', strtotime($row['date'])); ?></td>
                                        <td><?= $row['quantity']; ?></td>
                                        <td>
                                            <span class="px-4 py-1 fw-semibold rounded-5 d-inline-block 
                                            <?php 
                                                $quantity = $row['quantity']; 
                                                if ($quantity == 0) { 
                                                    echo ' text-danger bg-light';  
                                                } elseif ($quantity <= 3) { 
                                                    echo ' text-warning bg-light ';  
                                                } else { 
                                                    echo ' text-success bg-light ';  
                                                } 
                                            ?>">
                                            <?php
                                                if ($quantity == 0) {
                                                    echo "Out of Stock";
                                                } elseif ($quantity <= 3) {
                                                    echo "Low Stock";
                                                } else {
                                                    echo "In Stock";
                                                }
                                            ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="custom-dropdown">
                                                <button class="btn btn-sm p-0 product-ellipsis-btn font-semibold" type="button" aria-label="Options">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="custom-dropdown-menu">
                                                    <a class="custom-dropdown-item" href="/purchase_item_add/edit/<?= htmlspecialchars($row['stock_list_id']) ?>">
                                                        <i class="fas fa-edit me-2"></i> Edit
                                                    </a>
                                                    <button class="custom-dropdown-item delete-product-item" type="button" data-id="<?= htmlspecialchars($row['stock_list_id']) ?>">
                                                        <i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#stockTable').DataTable({
            "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]], // Custom page length options
            "pageLength": 5, // Default number of rows per page
            "searching": true, // Enable global search functionality
            "order": [[0, 'asc']], // Sort by ID
            "columnDefs": [
                {
                    "targets": 2, // Search only in the 'PRODUCTS' column
                    "searchable": true
                }
            ]
        });

        // Remove default DataTable search box
        $('#stockTable_filter').hide();

        // Search by product name in the PRODUCTS column (index 2)
        $('#tableSearch').on('keyup', function () {
            table.column(2).search(this.value).draw(); // Search only in the 'PRODUCTS' column
        });

        // Filter by stock status
        $('#stockFilter').on('change', function () {
            var selectedStatus = this.value.toLowerCase();
            table.rows().every(function () {
                var rowData = this.node();
                var status = $(rowData).data('status').toLowerCase();
                if (selectedStatus === '' || status === selectedStatus) {
                    $(rowData).show();
                } else {
                    $(rowData).hide();
                }
            });
        });
    });
</script>

<style>
    /* Hide the default DataTable search box */
    #stockTable_filter {
        display: none;
    }
</style>
