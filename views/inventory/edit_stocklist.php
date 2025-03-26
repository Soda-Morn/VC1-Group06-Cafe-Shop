<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            margin-bottom: 2px;
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
            <h1 class="form-title">Edit Product</h1>
            <p class="form-subtitle">Update the details below</p>
        </div>

        <!-- Form -->
        <form action="/purchase_item_add/update/<?= $purchaseItemId['purchase_item_id']; ?>" method="POST" enctype="multipart/form-data">
            <!-- Image Upload Section -->
            <div class="form-group">
                <label class="form-label">Product Image</label>
                <div class="image-upload-area" id="image-upload-area">
                    <input type="file" name="image" accept="image/*" id="file-input" class="d-none">
                    <div class="upload-prompt" id="upload-prompt" style="display: none;">
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
                        <img id="preview-image" class="preview-image" src="/<?= htmlspecialchars($product['product_image']); ?>" alt="Preview">
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
<!-- <?php print_r($stocklist); ?> -->
            <!-- Product Name and Price Row -->
            <div class="form-row">
                <!-- Product Name -->
                <div class="form-group">
                    <label class="form-label" for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($productName['stocklist']); ?>" required>
                </div>

                <!-- Price -->
            </div>

            <!-- Hidden Field for Existing Image -->
            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($product['product_image']); ?>">

            <!-- Buttons -->
            <div class="buttons-container">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/purchase_item_add" class="btn btn-danger">Cancel</a>
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

        // On page load, show the existing image
        window.addEventListener('load', () => {
            if (previewImage.src) {
                uploadPrompt.style.display = 'none';
                imagePreviewContainer.style.display = 'flex';
            }
        });
    </script>
</body>
</html>