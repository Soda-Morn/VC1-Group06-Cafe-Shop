document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.querySelector(".form-control");
  
  if (searchInput) {
      searchInput.addEventListener("input", function () {
          const searchValue = searchInput.value.toLowerCase();
          const coffeeItems = document.querySelectorAll(".col-md-3");
          
          coffeeItems.forEach(item => {
              const itemName = item.querySelector(".card-title").textContent.toLowerCase();
              if (itemName.includes(searchValue)) {
                  item.style.display = "block";
              } else {
                  item.style.display = "none";
              }
          });
      });
  }
});
const searchInput = document.querySelector(".form-control"); // The search input field
let timeoutId;

if (searchInput) {
    searchInput.addEventListener("input", function () {
        clearTimeout(timeoutId); // Clear any previous timeout (debounce)

        timeoutId = setTimeout(() => {
            const searchValue = searchInput.value.toLowerCase(); // Get the search input value

            // Get all product elements that need to be filtered
            const productElements = document.querySelectorAll(".name, .price, .card, #product-list");

            // If the search is empty, show all products
            if (!searchValue.trim()) {
                productElements.forEach(product => {
                    product.style.display = "";
                });
                return;
            }

            // Loop through all products and filter by name
            productElements.forEach(product => {
                // Get product name element
                const nameElement = product.querySelector("h5, .card-title, .product-name");

                // If the nameElement exists, check the text content
                if (nameElement) {
                    const nameText = nameElement.textContent.toLowerCase();

                    // If the name matches the search value, show the product
                    if (nameText.includes(searchValue)) {
                        product.style.display = "";
                    } else {
                        product.style.display = "none";
                    }
                }
            });
        }, 300); // Set debounce delay (300ms)
    });
}


