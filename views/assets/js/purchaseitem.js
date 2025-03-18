document.addEventListener('DOMContentLoaded', function() {
    // Custom dropdown functionality
    const dropdownButtons = document.querySelectorAll('.ellipsis-btn');
    
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Get the dropdown menu
            const dropdownMenu = this.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle the current dropdown
            dropdownMenu.classList.toggle('show');
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
    
    // Attach click event listener to all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-item');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const purchaseItemId = this.getAttribute('data-id');
            
            // Confirm deletion
            if (confirm('Are you sure you want to delete this item?')) {
                // Perform the delete action
                window.location.href = '/purchase_item/destroy/' + purchaseItemId;
            }
        });
    });
});