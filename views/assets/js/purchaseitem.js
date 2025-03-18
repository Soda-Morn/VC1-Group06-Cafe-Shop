document.addEventListener('DOMContentLoaded', function() {
    let openDropdown = null; // Keep track of the open dropdown

    function closeDropdown(dropdown) {
        if (dropdown) {
            dropdown.classList.remove('show');
        }
    }

    // Toggle dropdowns
    document.querySelectorAll('.ellipsis-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const dropdownMenu = this.nextElementSibling;

            // Close the previously opened dropdown (if any)
            if (openDropdown && openDropdown !== dropdownMenu) {
                closeDropdown(openDropdown);
            }

            // Toggle the clicked dropdown
            if (dropdownMenu.classList.contains('show')) {
                closeDropdown(dropdownMenu);
                openDropdown = null;
            } else {
                dropdownMenu.classList.add('show');
                openDropdown = dropdownMenu;
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (openDropdown && !e.target.closest('.fancy-dropdown')) {
            closeDropdown(openDropdown);
            openDropdown = null;
        }
    });

    // ✅ Delete item functionality
    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            const purchaseItemId = this.getAttribute('data-id');

            if (confirm('Are you sure you want to delete this item?')) {
                try {
                    const response = await fetch(`/purchase_item/destroy/${purchaseItemId}`, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' }
                    });

                    if (!response.ok) throw new Error('Failed to delete');

                    const data = await response.json();

                    if (data.success) {
                        // Remove the deleted item from the DOM instantly
                        const itemToRemove = this.closest('.product-card');
                        if (itemToRemove) {
                            itemToRemove.remove();
                        }
                    } else {
                        throw new Error('Server did not confirm deletion');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // Fallback: Redirect to delete page if AJAX fails
                    window.location.href = `/purchase_item/destroy/${purchaseItemId}`;
                }
            }
        });
    });
});
