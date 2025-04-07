
        function filterProducts() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach(card => {
                const name = card.getAttribute('data-name');
                
                if (name.includes(filter)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        $(document).ready(function() {
            // Handle remove button click with AJAX
            $('.btn-remove').click(function(e) {
                e.stopPropagation();
                const productId = $(this).data('product-id');
                const card = $(this).closest('.card');
                
                // Show confirmation dialog
                const isConfirmed = confirm('Are you sure you want to delete this product?');
                if (!isConfirmed) {
                    return; // Exit if user cancels
                }

                $.ajax({
                    url: `/order_menu/destroy/${productId}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            card.closest('.col-5-cards').remove();
                            if ($('.card').length === 0) {
                                $('.card-row').html('<div class="col-12 text-center">No products available.</div>');
                            }
                            const anyChecked = Array.from(document.querySelectorAll('.select-checkbox')).some(cb => cb.checked);
                            document.getElementById('checkoutBtn').classList.toggle('visible', anyChecked);
                        } else {
                            alert('Failed to delete product: ' + (data.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting product:', {status: status, error: error, responseText: xhr.responseText});
                        alert('An error occurred while deleting the product: ' + (xhr.responseText || error));
                    }
                });
            });

            // Handle Add to Cart button with AJAX
            $('.btn-add-to-cart').click(function(e) {
                e.stopPropagation();
                const productId = $(this).data('product-id');

                $.ajax({
                    url: '/orderCard/addToCart',
                    type: 'POST',
                    data: { product_id: productId },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            // Redirect to /orderCard after successful addition to cart
                            window.location.href = '/orderCard';
                        } else {
                            alert('Failed to add product to cart: ' + (data.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding to cart:', {status: status, error: error, responseText: xhr.responseText});
                        alert('An error occurred while adding to cart: ' + (xhr.responseText || error));
                    }
                });
            });

            // Card selection for multi-select
            const cards = document.querySelectorAll('.card');
            const checkoutBtn = document.getElementById('checkoutBtn');

            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.closest('.btn-danger') || e.target.closest('.btn-add-to-cart') || e.target.closest('.add-new-btn') || e.target.closest('.checkout-btn')) {
                        return;
                    }

                    const checkbox = this.querySelector('.select-checkbox');
                    checkbox.checked = !checkbox.checked;

                    if (checkbox.checked) {
                        this.classList.add('selected');
                    } else {
                        this.classList.remove('selected');
                    }

                    const anyChecked = Array.from(document.querySelectorAll('.select-checkbox')).some(cb => cb.checked);
                    checkoutBtn.classList.toggle('visible', anyChecked);
                });
            });
        });

   
  // Define translations for Coffee Menu page
  const coffeeMenuTranslations = {
    en: {
      title: "Drink Menu",
      search_placeholder: "Search menu......",
      buttons: {
        order_now: "Order Now",
        create_menu: "Create Menu",
        add_to_cart: "Add to cart"
      },
      no_products: "No products available."
    },
    km: {
      title: "ម៉ឺនុយភេសជ្ជៈ",
      search_placeholder: "ស្វែងរកម៉ឺនុយ......",
      buttons: {
        order_now: "បញ្ជាទិញឥឡូវ",
        create_menu: "បង្កើតម៉ឺនុយ",
        add_to_cart: "បន្ថែមទៅកន្ត្រក"
      },
      no_products: "គ្មានផលិតផលទេ។"
    }
  };

  // Function to update Coffee Menu page language
  function updateCoffeeMenuLanguage(language) {
    // Update title
    const title = document.querySelector('.header h2');
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = coffeeMenuTranslations[language].title;
    } else {
      console.error('Title element not found with selector .header h2');
    }

    // Update search placeholder
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.placeholder = coffeeMenuTranslations[language].search_placeholder;
    }

    // Update buttons
    const orderNowBtn = document.getElementById('checkoutBtn');
    if (orderNowBtn) {
      orderNowBtn.textContent = coffeeMenuTranslations[language].buttons.order_now;
    }

    const createMenuBtn = document.querySelector('.btn-create');
    if (createMenuBtn) {
      createMenuBtn.textContent = coffeeMenuTranslations[language].buttons.create_menu;
    }

    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    addToCartButtons.forEach(button => {
      button.textContent = coffeeMenuTranslations[language].buttons.add_to_cart;
    });

    // Store no_products message for use in AJAX response
    window.noProductsMessage = coffeeMenuTranslations[language].no_products;
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateCoffeeMenuLanguage(language);
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    console.log('Initial language on page load:', savedLanguage); // Debug
    setLanguage(savedLanguage);
  });

  // For testing: Add a manual trigger to switch languages
  window.addEventListener('load', () => {
    const testButtons = `
      <div style="position: fixed; top: 10px; right: 10px;">
        <button onclick="setLanguage('en')">English</button>
        <button onclick="setLanguage('km')">Khmer</button>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', testButtons);
  });

  

