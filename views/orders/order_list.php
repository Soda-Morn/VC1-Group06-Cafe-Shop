
    <style>
        .container {
            max-width: 1400px;
            margin: 50px auto;
            padding: 0 20px;
            text-align: center;
        }


        .card-body {
            padding: 10px;
            background-color: #fff;
        }

      

        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 1rem;
            color: #333;
        }

        .table thead th {
            background-color: #f97316;
            color: white;
            border: none;
            padding: 8px 12px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1.2px;
            position: sticky;
        }

        .table thead tr:first-child th:first-child {
            border-top-left-radius: 10px;
        }

        .table thead tr:first-child th:last-child {
            border-top-right-radius: 10px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }



      

        .badge {
            padding: 7px 14px;
            font-size: 0.85rem;
            border-radius: 10px;
            background: linear-gradient(90deg, #16a34a, #22c55e);
            color: white;
            font-weight: 600;
        }

        .rounded-circle {
            width: 50px;
            height: 50px;
            object-fit: cover;
         
            border-radius: 50%;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .rounded-circle:hover {
            transform: scale(1.15);
        }

        h2.text-start {
            color: #1e3a8a;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: -0.5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            .card-body {
                padding: 5px;
            }

            .table td,
            .table th {
                padding: 6px 8px;
                font-size: 0.9rem;
            }

            .rounded-circle {
                width: 40px;
                height: 40px;
            }

            h2.text-start {
                font-size: 1.75rem;
            }
        }

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

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .no-orders-message {
            display: none;
            padding: 10px;
            text-align: center;
            color: #666;
            font-style: italic;
        }

        .filter-button {
            border-radius: 10px;
            padding: 8px 16px;
           
            color: #374151;
            font-weight: 500;
            border: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            min-width: 150px;
            cursor: pointer;
        }

       

        .filter-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.4);
        }

        .date-picker-container {
            position: relative;
            display: inline-block;
        }

        .date-picker-button {
            border-radius: 10px;
            padding: 8px 16px;
          
            color: #374151;
            font-weight: 500;
            border: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            min-width: 150px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .date-picker-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.4);
        }

        .dropdown-icon {
            margin-left: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            color: #374151;
            transition: transform 0.2s ease;
        }

        .dropdown-icon:hover {
            color: #f97316;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
           
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            z-index: 1000;
            display: none;
            animation: slideDown 0.2s ease-in-out;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 8px 16px;
            color: #374151;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

    

        /* Custom scrollbar for Firefox */
        .table-responsive {
            scrollbar-width: thin;
            scrollbar-color: #f97316 #f1f5f9;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .pagination button {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background-color: #f97316;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        

        .pagination button:hover:not(:disabled) {
            background-color: #ea580c;
        }

        .flatpickr-calendar {
            width: 320px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
           
            border: none;
            padding: 15px;
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .flatpickr-month {
            background: linear-gradient(90deg, #ff6f61, #ff9f43);
            color: white;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .flatpickr-current-month {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
        }

        .flatpickr-current-month .numInputWrapper {
            margin-left: 10px;
        }

        .flatpickr-current-month select,
        .flatpickr-current-month input {
            color: white;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .flatpickr-current-month select:focus,
        .flatpickr-current-month input:focus {
            outline: none;
        }

        .flatpickr-day {
            border-radius: 50%;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #333;
        }

        .flatpickr-day:hover {
            background: #ff9f43;
            color: white;
            transform: scale(1.1);
        }

        .flatpickr-day.selected {
            background: #ff6f61;
            border-color: #ff6f61;
            color: white;
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .flatpickr-day.today {
            border: 2px solid #ff9f43;
            color: #ff6f61;
            font-weight: 700;
        }

        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .flatpickr-prev-month:hover,
        .flatpickr-next-month:hover {
            color: #ff9f43;
            transform: scale(1.2);
        }

        .flatpickr-weekdays {
            margin-bottom: 10px;
        }

        .flatpickr-weekday {
            color: #ff6f61;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .filter-dropdown {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-button,
            .date-picker-button {
                width: 100%;
            }
        }
    </style>

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
                                                <img src="<?= $imagePath ?>" class="rounded-circle" alt="Product Image">
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

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('timeFilter');
            const datePickerButton = document.getElementById('datePickerButton');
            const dropdownIcon = document.getElementById('dropdownIcon');
            const datePickerMenu = document.getElementById('datePickerMenu');
            const selectDateItem = document.getElementById('selectDate');
            const selectDateRangeItem = document.getElementById('selectDateRange');
            const rows = Array.from(document.querySelectorAll('#orderTableBody tr:not(.no-orders-row)'));
            const noOrdersMessage = document.getElementById('noOrdersMessage');
            const orderTableBody = document.getElementById('orderTableBody');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const today = new Date();
            const currentYear = today.getFullYear();
            const currentMonth = today.getMonth();
            const ITEMS_PER_PAGE = 10;
            let currentPage = 1;
            let filteredRows = rows;
            let isSingleDateMode = true;
            let currentPicker = null;

            function formatDateForButton(dateStr) {
                if (!dateStr) return isSingleDateMode ? 'Select Date' : 'Select Date Range';
                const date = new Date(dateStr);
                return date.toLocaleDateString('en-US', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }

            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function destroyCurrentPicker() {
                if (currentPicker) {
                    currentPicker.destroy();
                    currentPicker = null;
                }
            }

            function initializePicker() {
                destroyCurrentPicker();
                currentPicker = flatpickr(datePickerButton, {
                    dateFormat: "Y-m-d",
                    mode: isSingleDateMode ? "single" : "range",
                    onChange: function(selectedDates, dateStr) {
                        if (isSingleDateMode && selectedDates.length > 0) {
                            filterOrdersByDate(dateStr);
                            datePickerButton.childNodes[0].textContent = formatDateForButton(dateStr);
                            filterSelect.value = 'all';
                        } else if (!isSingleDateMode && selectedDates.length === 2) {
                            const startDate = selectedDates[0];
                            const endDate = selectedDates[1];
                            const startDateStr = formatDate(startDate);
                            const endDateStr = formatDate(endDate);
                            filterOrdersByDateRange(startDateStr, endDateStr);
                            datePickerButton.childNodes[0].textContent = `${formatDateForButton(startDateStr)} - ${formatDateForButton(endDateStr)}`;
                            filterSelect.value = 'all';
                        }
                    },
                    onClose: function() {
                        if (isSingleDateMode) {
                            if (currentPicker.selectedDates.length > 0) {
                                const dateStr = formatDate(currentPicker.selectedDates[0]);
                                datePickerButton.childNodes[0].textContent = formatDateForButton(dateStr);
                            } else {
                                datePickerButton.childNodes[0].textContent = 'Select Date';
                            }
                        } else {
                            if (currentPicker.selectedDates.length === 2) {
                                const startDateStr = formatDate(currentPicker.selectedDates[0]);
                                const endDateStr = formatDate(currentPicker.selectedDates[1]);
                                datePickerButton.childNodes[0].textContent = `${formatDateForButton(startDateStr)} - ${formatDateForButton(endDateStr)}`;
                            } else {
                                datePickerButton.childNodes[0].textContent = 'Select Date Range';
                            }
                        }
                    }
                });
                return currentPicker;
            }

            datePickerButton.addEventListener('click', function(event) {
                if (event.target === dropdownIcon) return; // Let the icon handle its own click
                if (datePickerMenu.classList.contains('show')) {
                    datePickerMenu.classList.remove('show');
                    return;
                }
                if (!currentPicker) {
                    currentPicker = initializePicker();
                }
                if (currentPicker.isOpen) {
                    currentPicker.close();
                } else {
                    currentPicker.open();
                }
            });

            dropdownIcon.addEventListener('click', function(event) {
                if (currentPicker?.isOpen) {
                    currentPicker.close();
                }
                datePickerMenu.classList.toggle('show');
                event.stopPropagation();
            });

            document.addEventListener('click', function(event) {
                if (!datePickerButton.contains(event.target) && !datePickerMenu.contains(event.target)) {
                    datePickerMenu.classList.remove('show');
                }
            });

            selectDateItem.addEventListener('click', function(event) {
                isSingleDateMode = true;
                datePickerButton.childNodes[0].textContent = 'Select Date';
                datePickerMenu.classList.remove('show');
                currentPicker = initializePicker();
                currentPicker.open();
                event.stopPropagation();
            });

            selectDateRangeItem.addEventListener('click', function(event) {
                isSingleDateMode = false;
                datePickerButton.childNodes[0].textContent = 'Select Date Range';
                datePickerMenu.classList.remove('show');
                currentPicker = initializePicker();
                currentPicker.open();
                event.stopPropagation();
            });

            function updatePagination() {
                const totalPages = Math.ceil(filteredRows.length / ITEMS_PER_PAGE);
                const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
                const endIndex = startIndex + ITEMS_PER_PAGE;

                rows.forEach(row => row.style.display = 'none');
                filteredRows.slice(startIndex, endIndex).forEach((row, index) => {
                    row.style.display = '';
                    const indexCell = row.querySelector('.index');
                    if (indexCell) {
                        indexCell.textContent = startIndex + index + 1;
                    }
                });

                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages || totalPages === 0;
                noOrdersMessage.style.display = filteredRows.length === 0 ? 'block' : 'none';
                const noOrdersRow = orderTableBody.querySelector('.no-orders-row');
                if (noOrdersRow) noOrdersRow.style.display = filteredRows.length === 0 ? '' : 'none';
            }

            function filterOrders(filter) {
                if (currentPicker) {
                    currentPicker.clear();
                    datePickerButton.childNodes[0].textContent = isSingleDateMode ? 'Select Date' : 'Select Date Range';
                }

                filteredRows = rows.filter(row => {
                    const rowDateStr = row.getAttribute('data-date');
                    if (!rowDateStr || rowDateStr === 'N/A') return false;

                    const rowDate = new Date(rowDateStr);
                    switch (filter) {
                        case 'today':
                            return isSameDay(rowDate, today);
                        case 'yesterday':
                            const yesterday = new Date(today);
                            yesterday.setDate(today.getDate() - 1);
                            return isSameDay(rowDate, yesterday);
                        case 'last-week':
                            const lastWeekStart = new Date(today);
                            lastWeekStart.setDate(today.getDate() - today.getDay() - 7);
                            const lastWeekEnd = new Date(lastWeekStart);
                            lastWeekEnd.setDate(lastWeekStart.getDate() + 6);
                            return rowDate >= lastWeekStart && rowDate <= lastWeekEnd;
                        case 'last-month':
                            const lastMonthStart = new Date(currentYear, currentMonth - 1, 1);
                            const lastMonthEnd = new Date(currentYear, currentMonth, 0);
                            return rowDate >= lastMonthStart && rowDate <= lastMonthEnd;
                        case 'last-year':
                            const lastYearStart = new Date(currentYear - 1, 0, 1);
                            const lastYearEnd = new Date(currentYear - 1, 11, 31);
                            return rowDate >= lastYearStart && rowDate <= lastYearEnd;
                        case 'all':
                            return true;
                    }
                });
                currentPage = 1;
                updatePagination();
            }

            function filterOrdersByDate(dateStr) {
                const selectedDate = new Date(dateStr);
                filteredRows = rows.filter(row => {
                    const rowDateStr = row.getAttribute('data-date');
                    if (!rowDateStr || rowDateStr === 'N/A') return false;
                    const rowDate = new Date(rowDateStr);
                    return isSameDay(rowDate, selectedDate);
                });
                currentPage = 1;
                updatePagination();
            }

            function filterOrdersByDateRange(startDateStr, endDateStr) {
                const startDate = new Date(startDateStr);
                startDate.setHours(0, 0, 0, 0);
                const endDate = new Date(endDateStr);
                endDate.setHours(23, 59, 59, 999);

                filteredRows = rows.filter(row => {
                    const rowDateStr = row.getAttribute('data-date');
                    if (!rowDateStr || rowDateStr === 'N/A') return false;
                    const rowDate = new Date(rowDateStr);
                    return rowDate >= startDate && rowDate <= endDate;
                });
                currentPage = 1;
                updatePagination();
            }

            function isSameDay(date1, date2) {
                return date1.getDate() === date2.getDate() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getFullYear() === date2.getFullYear();
            }

            filterSelect.addEventListener('change', function() {
                filterOrders(this.value);
            });

            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                }
            });

            nextBtn.addEventListener('click', function() {
                const totalPages = Math.ceil(filteredRows.length / ITEMS_PER_PAGE);
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                }
            });

            filterOrders('all');
        });
    </script>
    <script src="views/assets/js/Language_options/order-list-o.js"></script>
