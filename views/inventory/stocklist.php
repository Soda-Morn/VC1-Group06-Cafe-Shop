<div class="container mt-6">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-6 ">
                            <h4 class="card-title fs-2 m-3">Stock Inventory List</h4>
                        </div>
                        <div class="col-md-6 m-0 d-flex justify-content-md-end">
                            <input type="text" id="tableSearch" class="form-control me-2" placeholder="Search products..." style="max-width: 200px; height: 38px;">
                            <select id="stockFilter" class="form-select me-2" style="max-width: 150px;">
                                <option value="">All Status</option>
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <!-- Table -->
                        <table id="stockTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="bg-warning text-center">NO</th>
                                    <th class="bg-warning text-center">Image</th>
                                    <th class="bg-warning text-center">PRODUCTS</th>
                                    <th class="bg-warning text-center">DATE ADDED</th>
                                    <th class="bg-warning text-center">STOCK</th>
                                    <th class="bg-warning text-center">STATUS</th>
                                    <th class="bg-warning text-center">OPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocklist as $index => $row) : ?>
                                    <tr data-status="<?= htmlspecialchars($row['quantity'] == 0 ? 'Out of Stock' : ($row['quantity'] <= 3 ? 'Low Stock' : 'In Stock')) ?>">
                                        <td class="text-center"><?= $index + 1; ?></td>
                                        <td class="text-center">
                                            <img src="<?= $row['product_image']; ?>" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                        </td>
                                        <td class="text-center"><?= $row['product_name']; ?></td>
                                        <td class="text-center"><?= date('F j, Y', strtotime($row['date'])); ?></td>
                                        <td class="text-center"><?= $row['quantity']; ?></td>
                                        <td class="text-center">
                                            <span class="px-4 py-1 fw-semibold rounded-5 d-inline-block 
                                            <?php
                                            $quantity = $row['quantity'];
                                            if ($quantity == 0) {
                                                echo ' text-danger ';
                                            } elseif ($quantity <= 3) {
                                                echo ' text-danger  ';
                                            } else {
                                                echo ' text-success  ';
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
                                        <td class="text-center">
                                            <div class="custom-dropdown">
                                                <button class="btn btn-sm p-2 product-ellipsis-btn font-semibold" type="button" aria-label="Options">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="custom-dropdown-menu">
                                                    <a class="custom-dropdown-item" href="/stocklist/edit_stocklist/<?=  htmlspecialchars($row['stock_list_id']); ?>">
                                                        <i class="fas fa-edit me-2"></i> Edit
                                                    </a>
                                                    <a class="custom-dropdown-item delete-product-item" href="/stocklist/delete_stocklist/<?=htmlspecialchars($row['stock_list_id']); ?>"
                                                       onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fas fa-trash me-2 text-danger"></i> <span class="text-danger">Delete</span>
                                                    </a>
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
    $(document).ready(function() {
        var table = $('#stockTable').DataTable({
            "lengthMenu": [
                [10, 15, 20],
                [5, 10, 15, 20]
            ], // Custom page length options
            "searching": true, // Enable global search functionality
            "order": [
                [0, 'asc']
            ], // Sort by ID
            "columnDefs": [{
                "targets": 2, // Search only in the 'PRODUCTS' column
                "searchable": true
            }]
        });

        // Remove default DataTable search box
        $('#stockTable_filter').hide();

        // Search by product name in the PRODUCTS column (index 2)
        $('#tableSearch').on('keyup', function() {
            table.column(2).search(this.value).draw(); // Search only in the 'PRODUCTS' column
        });

        // Filter by stock status
        $('#stockFilter').on('change', function() {
            var selectedStatus = this.value.toLowerCase();
            table.rows().every(function() {
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

    #stockTable_length {
        display: none;
    }

    /* Remove sorting icons (::before and ::after) */
    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting::after,
    table.dataTable thead .sorting_asc::before,
    table.dataTable thead .sorting_asc::after,
    table.dataTable thead .sorting_desc::before,
    table.dataTable thead .sorting_desc::after {
        display: none !important;
    }
</style>