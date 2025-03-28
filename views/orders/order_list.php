<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Professional Table Styling */
        .container {
            max-width: 1400px;
            /* Slightly wider for better spacing */
            margin: 50px auto;
            padding: 0 20px;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
            /* Softer, deeper shadow */
            overflow: hidden;
            background: #ffffff;
        }

        .card-header {

            color: white;
            padding: 20px 30px;
            border-bottom: 3px solid rgba(255, 255, 255, 0.15);
        }

        .card-title {
            margin: 0;
            font-size: 1.35rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 35px;
            background-color: #fff;
        }

        .table-responsive {
            border-radius: 10px;
            overflow-x: auto;
            background: #fff;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0);
            /* Subtle inner shadow */
        }

        .table {
            margin-bottom: 0;
            border-collapse: collapse;
            font-size: 1rem;
            color: #333;
        }

        .table thead th {
            background: linear-gradient(90deg, #f97316, #d97706);
            /* Warm orange gradient */
            color: white;
            border: none;
            padding: 20px 25px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1.2px;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f5f9;
            /* Softer hover color */
        }

        .table td {
            padding: 18px 22px;
            vertical-align: middle;
            border-top: 1px solid #e5e7eb;
            color: #374151;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9fafb;
            /* Lighter odd-row color */
        }

        .badge {
            padding: 7px 14px;
            font-size: 0.85rem;
            border-radius: 10px;
            /* More rounded */
            background: linear-gradient(90deg, #16a34a, #22c55e);
            /* Green gradient */
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        }

        .rounded-circle {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 3px solid #e5e7eb;
            /* Thicker, softer border */
            border-radius: 50%;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .rounded-circle:hover {
            transform: scale(1.15);
            /* Slightly larger hover effect */
            border-color: #3b82f6;
            /* Blue border on hover */
        }

        h2.text-start {
            color: #1e3a8a;
            /* Matches header */
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: -0.5px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            .card-body {
                padding: 20px;
            }

            .table td,
            .table th {
                padding: 12px 15px;
                font-size: 0.9rem;
            }

            .rounded-circle {
                width: 40px;
                height: 40px;
            }

            h2.text-start {
                font-size: 1.75rem;
            }


            .card-header {
                padding: 15px 20px;
            }
        }

        /* Animation for table rows */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
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
            <div class="card-body">
                <h2 class="text-start">Order List</h2>
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
                                <?php
                                // Sort orders by ID in descending order (if they have an 'id' field)
                                usort($orders, function ($a, $b) {
                                    return $b['id'] - $a['id']; // Sorting by newest order first
                                });

                                $index = 1; // Start index from 1
                                foreach ($orders as $order):
                                ?>
                                    <tr>
                                        <td><?= $index++ ?></td>
                                        <td>
                                            <?php
                                            // Define the base path for images
                                            $imagePath = !empty($order['image']) && file_exists(__DIR__ . '/../../' . $order['image'])
                                                ? htmlspecialchars($order['image'])
                                                : 'views/assets/img/product_detail/coffee.png';
                                            ?>
                                            <img src="<?= $imagePath ?>" class="rounded-circle" alt="Product Image">
                                            <?= htmlspecialchars($order['item']) ?>
                                        </td>
                                        <td>$<?= htmlspecialchars($order['original_price']) ?></td>
                                        <td><?= htmlspecialchars($order['quantity']) ?></td>
                                        <td>$<?= htmlspecialchars($order['total_price']) ?></td>
                                        <td><span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></td>
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