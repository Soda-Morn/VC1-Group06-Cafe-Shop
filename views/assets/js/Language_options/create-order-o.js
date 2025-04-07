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

    // Form submission with validation
    document.getElementById('product-form').addEventListener('submit', function(e) {
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
        
        if (!isValid) {
            e.preventDefault();
        } else {
            submitButton.textContent = 'Adding...';
            submitButton.disabled = true;
        }
    });

// Define translations for Add Product (Order Menu) page
const addOrderProductTranslations = {
    en: {
        title: "Add a New Product",
        subtitle: "Fill in the details below to create a product",
        labels: ["Product Image", "Product Name", "Price ($)", "Description"],
        upload_text: "Select Product Image",
        change_image: "Change Image",
        buttons: ["Add To Menu", "Cancel"],
        placeholders: ["Enter product name", "Enter price", "Enter product description"],
        alerts: [
            "Please select a product image",
            "Please enter a product name",
            "Please enter a valid price"
        ]
    },
    km: {
        title: "បន្ថែមផលិតផលថ្មី",
        subtitle: "បំពេញព័ត៌មានខាងក្រោមដើម្បីបង្កើតផលិតផល",
        labels: ["រូបភាពផលិតផល", "ឈ្មោះផលិតផល", "តម្លៃ ($)", "ការពិពណ៌នា"],
        upload_text: "ជ្រើសរូបភាពផលិតផល",
        change_image: "ផ្លាស់ប្តូររូបភាព",
        buttons: ["បន្ថែមទៅម៉ឺនុយ", "បោះបង់"],
        placeholders: ["បញ្ចូលឈ្មោះផលិតផល", "បញ្ចូលតម្លៃ", "បញ្ចូលការពិពណ៌នាផលិតផល"],
        alerts: [
            "សូមជ្រើសរូបភាពផលិតផល",
            "សូមបញ្ចូលឈ្មោះផលិតផល",
            "សូមបញ្ចូលតម្លៃត្រឹមត្រូវ"
        ]
    }
};

// Function to update Add Product (Order Menu) page language
function updateAddOrderProductLanguage(language) {
    // Update title
    const title = document.querySelector('.form-title');
    if (title) title.textContent = addOrderProductTranslations[language].title;

    // Update subtitle
    const subtitle = document.querySelector('.form-subtitle');
    if (subtitle) subtitle.textContent = addOrderProductTranslations[language].subtitle;

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
        if (index < addOrderProductTranslations[language].labels.length) {
            label.textContent = addOrderProductTranslations[language].labels[index];
        }
    });

    // Update upload text
    const uploadText = document.querySelector('.upload-text');
    if (uploadText) uploadText.textContent = addOrderProductTranslations[language].upload_text;

    // Update change image button
    const changeImageBtn = document.getElementById('change-image-btn');
    if (changeImageBtn) changeImageBtn.textContent = addOrderProductTranslations[language].change_image;

    // Update placeholders
    const nameInput = document.getElementById('name');
    if (nameInput) nameInput.placeholder = addOrderProductTranslations[language].placeholders[0];

    const priceInput = document.getElementById('price');
    if (priceInput) priceInput.placeholder = addOrderProductTranslations[language].placeholders[1];

    const descriptionInput = document.getElementById('description');
    if (descriptionInput) descriptionInput.placeholder = addOrderProductTranslations[language].placeholders[2];

    // Update buttons
    const buttons = document.querySelectorAll('.buttons-container .btn-submit, .buttons-container .btn');
    buttons.forEach((button, index) => {
        if (index < addOrderProductTranslations[language].buttons.length) {
            button.textContent = addOrderProductTranslations[language].buttons[index];
        }
    });

    // Store validation alerts in a global variable for the submit handler
    window.addOrderProductAlerts = addOrderProductTranslations[language].alerts;
}

// Integrate with existing setLanguage function
const originalSetLanguage = window.setLanguage || function() {};
window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateAddOrderProductLanguage(language); // Update this page
};

// Load saved language on page load
document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
});