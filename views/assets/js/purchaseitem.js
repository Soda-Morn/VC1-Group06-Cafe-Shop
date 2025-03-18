document.addEventListener("DOMContentLoaded", function () {
    console.log("Product search script loaded!");

    // Get the search input element
    const searchInput = document.getElementById("product-search");

    if (!searchInput) {
        console.error("Search input not found! Make sure you have an element with id 'product-search'");
        return;
    }

    console.log("Search input found:", searchInput);

    let timeoutId;

    // Add event listener to the search input
    searchInput.addEventListener("input", function () {
        clearTimeout(timeoutId);

        timeoutId = setTimeout(() => {
            const searchValue = searchInput.value.toLowerCase().trim();
            console.log("Searching for:", searchValue);

            const productElements = document.querySelectorAll("#product-list .card");
            console.log("Found products:", productElements.length);

            productElements.forEach(product => {
                const nameElement = product.querySelector(".product-name");
                
                if (nameElement) {
                    const nameText = nameElement.textContent.toLowerCase();
                    console.log("Checking product:", nameText);

                    if (nameText.includes(searchValue)) {
                        product.style.display = "";
                    } else {
                        product.style.display = "none";
                    }
                } else {
                    console.error("Product name element not found in card");
                }
            });
        }, 300);
    });
});