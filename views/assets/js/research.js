document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".form-control");
  
    if (searchInput) {
      let timeoutId;
  
      searchInput.addEventListener("input", function () {
        clearTimeout(timeoutId);
  
        timeoutId = setTimeout(() => {
          const searchValue = searchInput.value.toLowerCase();
  
          // Get all product elements
          const productElements = document.querySelectorAll(".name, .price, .card,#product-list");
  
          // If search is empty, show all products
          if (!searchValue.trim()) {
            productElements.forEach(product => {
              product.style.display = "";
            });
            return;
          }
  
          // Loop through all products and filter by name
          productElements.forEach(product => {
            // Get product name element
            const nameElement = product.querySelector("h4, .card-title, .product-name");
  
            // If nameElement exists, check the text content
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
        }, 300);
      });
    }
  });
  