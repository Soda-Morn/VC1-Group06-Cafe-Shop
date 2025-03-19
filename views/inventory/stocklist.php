<div class="container">
    <div class="row">
        <div class="col-md-19">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">Stock Inventory List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table id="basic-datatables" class="display table table-striped table-hover ">
                            <thead >
                                <tr >
                                    <th class = "bg-warning">ID</th>
                                    <th class = "bg-warning">Image</th>
                                    <th class = "bg-warning">PRODUCTS</th>
                                    <th class = "bg-warning">DATE ADDED</th>
                                    <th class = "bg-warning">STOCK</th>
                                    <th class = "bg-warning ">STATUS</th>
                                    <th class = "bg-warning ">option</th>
                                </tr>
                            </thead>

                        
                            <tbody>
                               
                        <?php foreach ($stocklist as $row) : ?>
                             <?php
                             $statusClass = ($row['Stock'] > 0) ? "bg-success" : "bg-danger";
                             $statusText = ($row['Stock'] > 0) ? "In Stock" : "Out of Stock";
                             ?>
                             <tr>
                                 <td><?=$row['ID']; ?></td>
                                 <td>
                                     <img src="<?=$row['Image']; ?>" alt="<?= $row['Products']; ?>" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                 </td>
                                 <td><?= $row['Products']; ?></td>
                                 <td><?= date('F j, Y', strtotime($row['DATE ADDED'])); ?></td>

                                 <td><?= $row['ProductName']; ?></td>
                                 <td>
                                     <span class="<?=$statusClass; ?><?= $row['Stock']; ?> mr-9 p-2 rounded-4"><?= $statusText; ?></span>
                                 </td>
                                 <!-- <td><?= $row['Stock']; ?></td> -->
                                 <td><a href=""><i class="fas fa-edit me-2"></i></a></td>

                                 
                             </tr>
                             
                             <?php endforeach; ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>