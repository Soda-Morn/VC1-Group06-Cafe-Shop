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