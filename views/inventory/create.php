<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #ffffff;
            color: #333;
            line-height: 1.5;
            padding: 20px;
        }

        /* Form Container */
        .form-container {
            background-color: transparent;
            border: 1px solid #ccc;
            max-width: 600px;
            margin: 71px auto 20px;
            padding: 20px;
            border-radius: 12px;
        }

        /* Form Header */
        .form-header {
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
            text-align: center;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            text-align: center;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4b5563;
            font-size: 0.95rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            font-size: 0.9rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #3b82f6;
            outline: 0;
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .form-select {
            width: 100%;
            padding: 10px 12px;
            font-size: 0.9rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #fff;
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
        }

        .form-select:focus {
            border-color: #3b82f6;
            outline: 0;
        }

        /* Image Upload Area */
        .image-upload-area {
            background-color: #f0f9ff;
            border: 1px dashed #0ea5e9;
            border-radius: 6px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            height: 140px;
            margin-top: 10px;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .image-upload-area:hover {
            background-color: #e0f2fe;
            border-color: #0c4a6e;
        }

        .upload-icon {
            color: #3b82f6;
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .upload-text {
            font-size: 0.9rem;
            color: #6b7280;
            display: flex;
            align-items: center;
        }

        .image-preview-container {
            display: none;
            width: 100%;
            height: auto;
            text-align: center;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .preview-image {
            max-height: 100px;
            max-width: 80%;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .change-image-btn {
            background-color: #0ea5e9;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 0.70rem;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .change-image-btn:hover {
            background-color: #0284c7;
        }

        /* Buttons */
        .buttons-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-primary.loading {
            position: relative;
            pointer-events: none;
        }

        .btn-primary.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .btn-danger {
            background-color: #f87171;
            color: white;
        }

        .btn-danger:hover {
            background-color: #ef4444;
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <h1 class="form-title">Add a New Product</h1>
            <p class="form-subtitle">Fill in the details below to create a product</p>
        </div>

        <!-- Form -->
        <form action="/purchase_item_add/store" method="POST" enctype="multipart/form-data" id="product-form">
            <!-- Image Upload Section -->
            <div class="form-group">
                <label class="form-label">Product Image</label>
                <div class="image-upload-area" id="image-upload-area">
                    <input type="file" name="image" accept="image/*" id="file-input" style="display: none;" required>
                    <div class="upload-prompt" id="upload-prompt">
                        <span class="upload-text">
                            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            Select Product Image
                        </span>
                    </div>
                    <div class="image-preview-container" id="image-preview-container">
                        <img id="preview-image" class="preview-image" src="#" alt="Preview">
                        <button type="button" class="change-image-btn" id="change-image-btn">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 4v6h-6"></path>
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                            </svg>
                            Change Image
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Name and Price Row -->
            <div class="form-row">
                <!-- Product Name -->
                <div class="form-group">
                    <label class="form-label" for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label class="form-label" for="price">Price ($)</label>
                    <input type="number" name="price" id="price" class="form-control" step="1" placeholder="Enter price" required>
                </div>
            </div>

            <!-- Category Section -->
            <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Buttons -->
            <div class="buttons-container">
                <button type="submit" class="btn btn-primary" id="submit-btn">
                    Add To Stock
                </button>
                <a href="/purchase_item_add" class="btn btn-danger">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // DOM Elements
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imageUploadArea = document.getElementById('image-upload-area');
        const changeImageBtn = document.getElementById('change-image-btn');
        const submitButton = document.getElementById('submit-btn');

        // Make the upload area clickable
        imageUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Change image button functionality
        changeImageBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent triggering the upload area click
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                // Create and display image preview
                const imageUrl = URL.createObjectURL(file);
                previewImage.src = imageUrl;
                uploadPrompt.style.display = 'none';
                imagePreviewContainer.style.display = 'flex';

                // Free memory when image is loaded
                previewImage.onload = () => {
                    URL.revokeObjectURL(imageUrl);
                };
            } else {
                resetImageDisplay();
            }
        });

        // Reset image display
        function resetImageDisplay() {
            uploadPrompt.style.display = 'flex';
            imagePreviewContainer.style.display = 'none';
        }

        // Form submission with loading state
        document.getElementById('product-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validate inputs
            const fileInput = document.getElementById('file-input');
            const nameInput = document.getElementById('name');
            const priceInput = document.getElementById('price');
            const categorySelect = document.getElementById('category');

            let isValid = true;

            if (fileInput.files.length === 0) {
                alert('Please select a product image');
                isValid = false;
            }

            if (nameInput.value.trim() === '') {
                alert('Please enter a product name');
                isValid = false;
            }

            if (priceInput.value <= 0) {
                alert('Please enter a valid price');
                isValid = false;
            }

            if (categorySelect.value === '') {
                alert('Please select a category');
                isValid = false;
            }

            if (isValid) {
                // Show loading state
                submitButton.classList.add('loading');
                submitButton.textContent = 'Adding...';

                // Submit the form
                document.getElementById('product-form').submit();
            }
        });
    </script>
    <!-- Add this script after your existing <script> tag -->
<script>
  // Define translations for Add Product page
  const addProductTranslations = {
    en: {
      title: "Add a New Product",
      subtitle: "Fill in the details below to create a product",
      labels: ["Product Image", "Product Name", "Price ($)", "Category"],
      upload_text: "Select Product Image",
      change_image: "Change Image",
      buttons: ["Add To Stock", "Cancel"],
      placeholders: ["Enter product name", "Enter price", "Select a category"],
      alerts: [
        "Please select a product image",
        "Please enter a product name",
        "Please enter a valid price",
        "Please select a category"
      ]
    },
    km: {
      title: "បន្ថែមផលិតផលថ្មី",
      subtitle: "បំពេញព័ត៌មានខាងក្រោមដើម្បីបង្កើតផលិតផល",
      labels: ["រូបភាពផលិតផល", "ឈ្មោះផលិតផល", "តម្លៃ ($)", "ប្រភេទ"],
      upload_text: "ជ្រើសរូបភាពផលិតផល",
      change_image: "ផ្លាស់ប្តូររូបភាព",
      buttons: ["បន្ថែមទៅស្តុក", "បោះបង់"],
      placeholders: ["បញ្ចូលឈ្មោះផលិតផល", "បញ្ចូលតម្លៃ", "ជ្រើសប្រភេទ"],
      alerts: [
        "សូមជ្រើសរូបភាពផលិតផល",
        "សូមបញ្ចូលឈ្មោះផលិតផល",
        "សូមបញ្ចូលតម្លៃត្រឹមត្រូវ",
        "សូមជ្រើសប្រភេទ"
      ]
    }
  };

  // Function to update Add Product page language
  function updateAddProductLanguage(language) {
    // Update title
    const title = document.querySelector('.form-title');
    if (title) title.textContent = addProductTranslations[language].title;

    // Update subtitle
    const subtitle = document.querySelector('.form-subtitle');
    if (subtitle) subtitle.textContent = addProductTranslations[language].subtitle;

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < addProductTranslations[language].labels.length) {
        label.textContent = addProductTranslations[language].labels[index];
      }
    });

    // Update upload text
    const uploadText = document.querySelector('.upload-text');
    if (uploadText) {
      uploadText.innerHTML = `
        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="17 8 12 3 7 8"></polyline>
          <line x1="12" y1="3" x2="12" y2="15"></line>
        </svg>
        ${addProductTranslations[language].upload_text}
      `;
    }

    // Update change image button
    const changeImageBtn = document.getElementById('change-image-btn');
    if (changeImageBtn) {
      changeImageBtn.innerHTML = `
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M23 4v6h-6"></path>
          <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
        </svg>
        ${addProductTranslations[language].change_image}
      `;
    }

    // Update placeholders
    const nameInput = document.getElementById('name');
    if (nameInput) nameInput.placeholder = addProductTranslations[language].placeholders[0];

    const priceInput = document.getElementById('price');
    if (priceInput) priceInput.placeholder = addProductTranslations[language].placeholders[1];

    const categorySelect = document.getElementById('category');
    if (categorySelect) {
      const defaultOption = categorySelect.querySelector('option[value=""]');
      if (defaultOption) defaultOption.textContent = addProductTranslations[language].placeholders[2];
    }

    // Update buttons
    const buttons = document.querySelectorAll('.buttons-container .btn');
    buttons.forEach((button, index) => {
      if (index < addProductTranslations[language].buttons.length) {
        button.textContent = addProductTranslations[language].buttons[index];
      }
    });

    // Update validation alerts (store in a global variable for the submit handler)
    window.addProductAlerts = addProductTranslations[language].alerts;
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateAddProductLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });

  // Update the existing form submission script to use translated alerts
  document.getElementById('product-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const fileInput = document.getElementById('file-input');
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const categorySelect = document.getElementById('category');
    const submitButton = document.getElementById('submit-btn');

    let isValid = true;

    if (fileInput.files.length === 0) {
      alert(window.addProductAlerts[0]); // Use translated alert
      isValid = false;
    }

    if (nameInput.value.trim() === '') {
      alert(window.addProductAlerts[1]);
      isValid = false;
    }

    if (priceInput.value <= 0) {
      alert(window.addProductAlerts[2]);
      isValid = false;
    }

    if (categorySelect.value === '') {
      alert(window.addProductAlerts[3]);
      isValid = false;
    }

    if (isValid) {
      submitButton.classList.add('loading');
      submitButton.textContent = 'Adding...'; // Note: This could also be translated if desired
      document.getElementById('product-form').submit();
    }
  });
</script>
</body>
</html>