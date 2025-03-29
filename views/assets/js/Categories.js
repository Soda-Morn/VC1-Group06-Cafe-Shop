
// Pagination variables
let currentPage = 1;
const rowsPerPage = 5; // Set how many rows you want per page
const tableRows = document.querySelectorAll('.category-row'); // All table rows

// Function to display rows for the current page
function displayTableRows() {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;

    tableRows.forEach((row, index) => {
        if (index >= startIndex && index < endIndex) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Disable buttons when necessary
    document.getElementById('prev-button').disabled = currentPage === 1;
    document.getElementById('next-button').disabled = currentPage * rowsPerPage >= tableRows.length;
}

// Change page function
function changePage(direction) {
    if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (direction === 'next' && currentPage * rowsPerPage < tableRows.length) {
        currentPage++;
    }
    displayTableRows();
}

// Dropdown functionality for toggling menu visibility
document.querySelectorAll('.category-actions .dropdown button').forEach(button => {
    button.addEventListener('click', function() {
        const dropdownMenu = button.closest('.dropdown').querySelector('.category-dropdown-menu');
        dropdownMenu.classList.toggle('show');
    });
});

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.category-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});

// Initialize the table
displayTableRows();

