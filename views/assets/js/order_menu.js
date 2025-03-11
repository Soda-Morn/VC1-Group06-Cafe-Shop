document.addEventListener('DOMContentLoaded', () => {
    // Select all "Add to cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cardContainer = document.querySelector('.cart .card-container');
    const cartTotalItems = document.querySelector('.total-items');
    const cartTotalDiscounts = document.querySelector('.total-discounts');
    const cartTotalAmount = document.querySelector('.total-amount');

    // Function to update cart totals
    function updateCartTotals() {
        const cartItems = document.querySelectorAll('.cart .card');
        let totalItemsPrice = 0;

        cartItems.forEach(item => {
            const price = parseFloat(item.querySelector('.item-price').textContent.replace('$', ''));
            totalItemsPrice += price;
        });

        const discounts = parseFloat(cartTotalDiscounts.textContent.replace('-$', '')) || 0;
        cartTotalItems.textContent = `$${totalItemsPrice.toFixed(2)}`;
        cartTotalAmount.textContent = `$${(totalItemsPrice - discounts).toFixed(2)}`;
    }

    // Function to update price based on quantity
    function updatePrice(quantitySpan, priceElement, basePrice) {
        const quantity = parseInt(quantitySpan.textContent);
        const totalPrice = (basePrice * quantity).toFixed(2);
        priceElement.textContent = `$${totalPrice}`;
    }

    // Function to add or update item in the cart
    function addItemToCart(name, price, imageSrc) {
        const existingCartItem = Array.from(cardContainer.children).find(item => {
            return item.dataset.name === name;
        });

        if (existingCartItem) {
            // If item exists, increment quantity
            const quantitySpan = existingCartItem.querySelector('.cart-quantity span');
            let quantity = parseInt(quantitySpan.textContent);
            quantity++;
            quantitySpan.textContent = quantity;
            updatePrice(quantitySpan, existingCartItem.querySelector('.item-price'), price);
        } else {
            // If item doesn't exist, create a new cart item with compact layout
            const cartItem = document.createElement('div');
            cartItem.classList.add('card');
            cartItem.dataset.name = name;
            cartItem.innerHTML = `
                <img src="${imageSrc}" alt="${name}">
                <div class="cart-info">
                    <h3>${name}</h3>
                    <p class="size">Small - 200g</p>
                    <span class="item-price">$${price.toFixed(2)}</span>
                    <div class="cart-quantity">
                        <button class="minus">-</button>
                        <span>1</span>
                        <button class="plus">+</button>
                    </div>
                </div>
            `;
            cardContainer.appendChild(cartItem);

            // Add event listeners for quantity controls
            const plusButton = cartItem.querySelector('.plus');
            const minusButton = cartItem.querySelector('.minus');
            const quantitySpan = cartItem.querySelector('.cart-quantity span');
            plusButton.addEventListener('click', () => {
                let currentValue = parseInt(quantitySpan.textContent);
                quantitySpan.textContent = currentValue + 1;
                updatePrice(quantitySpan, cartItem.querySelector('.item-price'), price);
                updateCartTotals();
            });
            minusButton.addEventListener('click', () => {
                let currentValue = parseInt(quantitySpan.textContent);
                if (currentValue > 1) {
                    quantitySpan.textContent = currentValue - 1;
                    updatePrice(quantitySpan, cartItem.querySelector('.item-price'), price);
                    updateCartTotals();
                }
            });
        }

        // Update cart totals after adding/updating item
        updateCartTotals();
    }

    // Add event listeners to "Add to cart" buttons
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const menuItem = button.closest('.card');
            const name = menuItem.dataset.name;
            const price = parseFloat(menuItem.dataset.price);
            const imageSrc = menuItem.querySelector('img').src;

            addItemToCart(name, price, imageSrc);
            button.textContent = 'Added to cart';
            button.disabled = true;
            setTimeout(() => {
                button.textContent = 'Add to cart';
                button.disabled = false;
            }, 1000); // Re-enable after 1 second
        });
    });
});