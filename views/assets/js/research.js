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

