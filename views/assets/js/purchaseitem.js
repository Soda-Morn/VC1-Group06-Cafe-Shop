document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded. Attaching event listeners...");

    // Handle dropdown menu toggle
    const ellipsisButtons = document.querySelectorAll('.product-ellipsis-btn');
    console.log("Found ellipsis buttons:", ellipsisButtons.length);
    ellipsisButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            console.log("Ellipsis button clicked");
            e.stopPropagation(); // Prevent the click from bubbling up to the "click outside" handler
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-dropdown')) {
            console.log("Clicked outside dropdown. Closing all dropdowns...");
            document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    // Handle delete action
    const deleteButtons = document.querySelectorAll('.delete-product-item');
    console.log("Found delete buttons:", deleteButtons.length);
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            console.log('Delete button clicked for ID:', this.getAttribute('data-id'));

            const purchaseItemId = this.getAttribute('data-id');
            const productCard = this.closest('.col');

            fetch(`/purchase_item/destroy/${purchaseItemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    productCard.style.transition = 'opacity 0.3s ease';
                    productCard.style.opacity = '0';
                    setTimeout(() => {
                        productCard.remove();
                        console.log('Product card removed for ID:', purchaseItemId);
                    }, 300);
                } else {
                    console.error('Failed to delete product. Status:', response.status);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});