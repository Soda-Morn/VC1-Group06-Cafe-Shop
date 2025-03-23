<div class="container">
    <div class="row">
        <div class="col-md-19">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Stock Inventory List</h4>
                    <div class="input-group w-25">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="bg-warning">ID</th>
                                    <th class="bg-warning">Image</th>
                                    <th class="bg-warning">PRODUCTS</th>
                                    <th class="bg-warning">DATE ADDED</th>
                                    <th class="bg-warning sort-stock" style="cursor: pointer;">
                                        STOCK <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="bg-warning">STATUS</th>
                                    <th class="bg-warning">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocklist as $row) : ?>
                                    <tr>
                                        <td><?=$row['stock_list_id']; ?></td>
                                        <td>
                                            <img src="<?=$row['product_image']; ?>" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                        </td>
                                        <td><?= $row['product_name']; ?></td>
                                        <td><?= date('F j, Y', strtotime($row['date'])); ?></td>
                                        <td class="stock-qty"><?= $row['quantity']; ?></td>
                                        <td>
                                            <span class="mr-9 p-2"><?= $row['status']; ?></span>
                                        </td>
                                        <td><a href=".edite_stocklist"><i class="fas fa-edit me-2"></i></a></td>
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


