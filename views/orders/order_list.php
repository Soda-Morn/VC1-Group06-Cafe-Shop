<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="../views/assets/css/order_menu/order_report.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="views/assets/js/order_menu/order_report.js"></script>
<script src="views/assets/js/Language_options/order-list-o.js"></script>

<div class="container">
    <div class="table mt-1">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <div class="header-container">
                    <h2 class="mt-0 text-start">Order List</h2>
                    <div class="filter-dropdown">
                        <select id="timeFilter" class="filter-button">
                            <option value="all" selected>All</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last-week">Last Week</option>
                            <option value="last-month">Last Month</option>
                            <option value="last-year">Last Year</option>
                        </select>
                        <div class="date-picker-container">
                            <button id="datePickerButton" class="date-picker-button">
                                Select Date
                                <span id="dropdownIcon" class="dropdown-icon">▼</span>
                            </button>
                            <div id="datePickerMenu" class="dropdown-menu">
                                <div id="selectDate" class="dropdown-item">Select Date</div>
                                <div id="selectDateRange" class="dropdown-item">Select Date Range</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>Item</th>
                                <th>Original Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Date of Order</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php if (!empty($orders)): ?>
                                <?php
                                usort($orders, function ($a, $b) {
                                    return $b['id'] - $a['id'];
                                });
                                $index = 1;
                                foreach ($orders as $order):
                                    $date = new DateTime($order['date_of_birth']);
                                ?>
                                    <tr data-date="<?= $date->format('Y-m-d') ?>">
                                        <td class="index"><?= $index++ ?></td>
                                        <td class="text-start">
                                            <?php
                                            $imagePath = !empty($order['image']) && file_exists(__DIR__ . '/../../' . $order['image'])
                                                ? htmlspecialchars($order['image'])
                                                : 'views/assets/img/product_detail/coffee.png';
                                            ?>
                                            <img src="<?= $imagePath ?>" class="circle" alt="Product Image">
                                            <span class="ms-2"><?= htmlspecialchars($order['item']) ?></span>
                                        </td>
                                        <td>$<?= htmlspecialchars($order['original_price']) ?></td>
                                        <td><?= htmlspecialchars($order['quantity']) ?></td>
                                        <td>$<?= htmlspecialchars($order['total_price']) ?></td>
                                        <td>
                                            <?php
                                            echo $order['date_of_birth'] !== 'N/A'
                                                ? $date->format('F d, Y')
                                                : 'N/A';
                                            ?>
                                        </td>
                                        <td><span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="no-orders-row">
                                    <td colspan="7" class="text-center">No orders found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="no-orders-message" id="noOrdersMessage">
                        No orders found for this time period.
                    </div>
                </div>
                <div class="pagination">
                    <button id="prevBtn">Previous</button>
                    <button id="nextBtn">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>