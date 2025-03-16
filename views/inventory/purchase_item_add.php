
<div class="container">
    <!-- Header Section -->
    <div class="header">
        <h2>Purchase Item Add</h2>
        <div class="header-controls">
            <!-- Add New Button triggers the Modal -->
            <button class="add-new-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal"><i class="fas fa-plus"></i> Add New</button>
            <select class="sort-dropdown form-select">
                <option value="">Sort by</option>
                <option value="price-low">Low to High</option>
                <option value="price-high">High to Low</option>
            </select>
            <button class="order btn btn-success"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
    </div>

    <!-- Product Cards -->
    <div class="row" id="product-list">
        <!-- Product Card Example -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-price="250.99">
            <div class="card">
                <div class="edit-delete-icons">
                    <i class="fas fa-edit edit-btn"></i>
                    <i class="fas fa-trash delete-btn"></i>
                </div>
                <img src="https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg" class="card-img">
                <div class="card-body text-center">
                    <h6>Cappuccino Coffee</h6>
                    <h4>$250.99</h4>
                    <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Repeat product cards as necessary -->
    </div>
</div>

<!-- Modal for Adding Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="profilePicture" class="form-label">Choose Product</label>
                    <input type="file" class="form-control" id="profilePicture">
                </div>
                <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter product name...">
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" placeholder="Enter category...">
                </div>
                <div class="form-group mb-3">
                    <label for="quality">Quality</label>
                    <select class="form-control" id="quality">
                        <option value="">Select Quality</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Enter product description..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>


<script>
  // Global variable to keep track of which product is being edited.
  let currentEditingIndex = null;


  // Helper function to map quality to a numeric rank for comparison
  function getQualityRank(quality) {
    const qualityRank = { "Low": 1, "Medium": 2, "High": 3 };
    return qualityRank[quality] || 0;
  }

  // Function to render the product list from localStorage
  function loadProducts() {
    const productList = document.getElementById('product-list');
    productList.innerHTML = ''; // Clear existing content

    // Retrieve stored products from localStorage or initialize an empty array
    const products = JSON.parse(localStorage.getItem('products')) || [];

    // Loop over each product and create its card
    products.forEach(function(product) {
      const productCard = document.createElement('div');
      productCard.classList.add('col-lg-3', 'col-md-4', 'col-sm-6', 'mb-4');
      productCard.setAttribute('data-price', product.price);

      productCard.innerHTML = `
        <div class="card">
          <div class="edit-delete-icons">
            <i class="fas fa-edit edit-btn"></i>
            <i class="fas fa-trash delete-btn"></i>
          </div>
          <img src="${product.imageUrl}" class="card-img" alt="${product.name}">
          <div class="card-body text-center">
            <h6>${product.name}</h6>
            <p>Quantity: ${product.quantity || 1}</p>
            <h4>$${product.price}</h4>
            <p>Quality: ${product.quality}</p>
            <button class="btn bg-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
          </div>
        </div>
      `;
      productList.appendChild(productCard);
    });
  }

  // Helper to reset the modal form fields and UI elements.
  function resetForm() {
    document.getElementById('name').value = '';
    document.getElementById('category').value = '';
    document.getElementById('quality').value = '';
    document.getElementById('description').value = '';
    document.getElementById('profilePicture').value = '';
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Load any saved products on page load
    loadProducts();

    // Get the button and modal form elements
    const addProductButton = document.querySelector('#productModal .btn-primary');
    const nameInput = document.getElementById('name');
    const categoryInput = document.getElementById('category');
    const qualityInput = document.getElementById('quality');
    const descriptionInput = document.getElementById('description');
    const fileInput = document.getElementById('profilePicture');

    // Event delegation for edit icon clicks on product cards
    document.getElementById('product-list').addEventListener('click', function(e) {
      const editIcon = e.target.closest('.edit-btn');
      if (editIcon) {
        // Get the product name from the card (assumed to be unique)
        const card = editIcon.closest('.col-lg-3');
        const productName = card.querySelector('h6').innerText;
        let products = JSON.parse(localStorage.getItem('products')) || [];
        const index = products.findIndex(item => item.name.toLowerCase() === productName.toLowerCase());
        if (index !== -1) {
          // Set edit mode
          currentEditingIndex = index;
          const product = products[index];
          // Pre-fill the form fields with the product's info
          nameInput.value = product.name;
          categoryInput.value = product.category;
          qualityInput.value = product.quality;
          descriptionInput.value = product.description;
          // Clear file input so the user can select a new image if desired
          fileInput.value = '';
          // Update modal UI for editing
          document.getElementById('productModalLabel').innerText = 'Edit Product';
          addProductButton.innerText = 'Update Product';
          // Show the modal
          $('#productModal').modal('show');
        }
      }
    });
    

    // Add event listener for the "Add Product" / "Update Product" button click
    addProductButton.addEventListener('click', function () {
      // Get the form data
      const productName = nameInput.value.trim();
      const productCategory = categoryInput.value.trim();
      const productQuality = qualityInput.value.trim();
      const productDescription = descriptionInput.value.trim();

      // Validate if all fields are filled
      if (productName && productCategory && productQuality && productDescription) {
        // Retrieve existing products from localStorage
        let products = JSON.parse(localStorage.getItem('products')) || [];

        // Function to finalize saving (common for both adding and updating)
        const finalizeSave = (imageDataUrl) => {
          if (currentEditingIndex !== null) {
            // Update existing product
            let product = products[currentEditingIndex];
            product.name = productName;
            product.category = productCategory;
            product.description = productDescription;
            // Update quality: set to the new value if it is higher, otherwise keep current or update as needed
            if (getQualityRank(productQuality) > getQualityRank(product.quality)) {
              product.quality = productQuality;
            } else {
              product.quality = productQuality; // Update regardless if desired
            }
            if (imageDataUrl) {
              product.imageUrl = imageDataUrl;
            }
            products[currentEditingIndex] = product;
            // Reset editing mode
            currentEditingIndex = null;
          } else {
            // Adding a new product: check if a product with the same name exists (case insensitive)
            const existingProduct = products.find(item => item.name.toLowerCase() === productName.toLowerCase());
            if (existingProduct) {
              // Increase the quantity
              existingProduct.quantity = (existingProduct.quantity || 1) + 1;
              // Update quality if the new quality is higher
              if (getQualityRank(productQuality) > getQualityRank(existingProduct.quality)) {
                existingProduct.quality = productQuality;
              }
            } else {
              // Create a new product object with quantity 1
              const newProduct = {
                name: productName,
                category: productCategory,
                quality: productQuality,
                description: productDescription,
                price: '250.99', // You can change or calculate the price as needed
                imageUrl: imageDataUrl || 'https://i.pinimg.com/736x/df/54/85/df5485fbc52cd5f90e3aac6a20ed7342.jpg',
                quantity: 1
              };
              products.push(newProduct);
            }
          }
          // Save updated products back to localStorage
          localStorage.setItem('products', JSON.stringify(products));
          // Update the UI
          loadProducts();
          // Reset the form and modal UI to default "Add" state
          resetForm();
          document.getElementById('productModalLabel').innerText = 'Add New Product';
          addProductButton.innerText = 'Add Product';
          $('#productModal').modal('hide');
        };

        // Check if a new image file is selected
        if (fileInput.files && fileInput.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            finalizeSave(e.target.result);
          };
          reader.readAsDataURL(fileInput.files[0]);
        } else {
          // No new image file selected—keep existing image if editing, or use default for new product
          finalizeSave(null);
        }
      } else {
        alert('Please fill in all fields!');
      }
    });
  });
</script>

</body>
</html>

