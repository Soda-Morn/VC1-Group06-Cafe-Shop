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
        const storeUnitSelect = document.getElementById('store_unit');

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

        if (storeUnitSelect.value === '') {
            alert('Please select a store unit');
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