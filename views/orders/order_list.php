<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Responsive Table</h4>
            </div>
            <div class="card-body">
                <h5 class="text-start">Order List</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>Item</th>
                                <th>Original Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                                        <td>
                                            <?php
                                            // Define the base path for images
                                            $imagePath = !empty($order['image']) && file_exists(__DIR__ . '/../../' . $order['image'])
                                                ? htmlspecialchars($order['image'])
                                                : 'views/assets/img/product_detail/coffee.png';
                                            ?>
                                            <img src="<?php echo $imagePath; ?>" class="rounded-circle" alt="Product Image" style="width:50px">
                                            <?php echo htmlspecialchars($order['item']); ?>
                                        </td>
                                        <td>$<?php echo htmlspecialchars($order['original_price']); ?></td>
                                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                        <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                                        <td><span class="badge bg-success"><?php echo htmlspecialchars($order['status']); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No orders found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>