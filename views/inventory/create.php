<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 0 auto;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        /* Image upload area */
        .image-upload-area {
            background-color: #e6f2ff;
            border: 1px dashed #007bff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 12px;
            position: relative;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        /* Initial upload state */
        .upload-prompt {
            text-align: center;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .upload-prompt img {
            width: 40px;
            margin-bottom: 10px;
        }

        .upload-prompt h5 {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Image preview state */
        .image-preview-container {
            display: none;
            width: 100%;
            text-align: center;
        }

        .preview-image-wrapper {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
        }

        .preview-image {
            max-height: 100px;
            max-width: 100%;
            border-radius: 4px;
            object-fit: contain;
        }

        .change-image-btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 13px;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .change-image-btn:hover {
            background-color: #0069d9;
        }

        .change-image-btn i {
            margin-right: 5px;
        }

        .file-name {
            color: #28a745;
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 500;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
        }

        /* Buttons */
        .btn-submit, .btn-cancel {
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .btn-submit {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: white;
            border: none;
        }

        .btn-cancel {
            background-color: rgb(255, 51, 0);
            color: white;
            border: none;
            margin-left: 5px;
        }

        .btn-submit:hover {
            background: linear-gradient(90deg, #00c6ff, #007bff);
        }

        .btn-cancel:hover {
            opacity: 0.9;
        }

        /* Compact header */
        .card-header-text h4 {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .card-header-text h6 {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container p-3">
        <div class="card">
            <div class="card-body p-3 p-md-4">
                <div class="text-center mb-3 card-header-text">
                    <h4 class="font-weight-bold">Add a New Product</h4>
                    <h6 class="text-muted">Fill in the details below to create a product</h6>
                </div>

                <form action="/purchase_item_add/store" method="POST" enctype="multipart/form-data">
                    <!-- Product Image Section -->
                    <div class="form-group">
                        <label for="image" class="font-weight-bold">Product Image</label>
                        
                        <!-- Upload Area -->
                        <div class="image-upload-area" id="image-upload-area">
                            <input type="file" name="image" accept="image/*" id="file-input" class="d-none" required>
                            
                            <!-- Initial Upload Prompt -->
                            <div class="upload-prompt" id="upload-prompt">
                                <img src="/Views/assets/img1/icons/upload.svg" alt="Upload">
                                <h5 class="text-muted">Select Product Image</h5>
                            </div>
                            
                            <!-- Image Preview -->
                            <div class="image-preview-container" id="image-preview-container">
                                <div class="preview-image-wrapper">
                                    <img id="preview-image" class="preview-image" src="#" alt="Preview">
                                </div>
                                <button type="button" class="change-image-btn" id="change-image-btn">
                                    <i class="fas fa-sync-alt"></i> Change Image
                                </button>
                            </div>
                        </div>
                        
                        <!-- File Name Display -->
                        <div id="file-name" class="file-name"></div>
                    </div>

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
                    </div>

                    <!-- Category -->
                    <!-- <?php print_r($categories); ?> -->
                    <div class="form-group">
                        <label for="category">Category</label>

                        <select name="category" id="category" class="form-control" required>
                     <?php foreach ($categories as $item):?>

                            <option><?= $item['name']?></option>
                           
                        <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Add now <i class="fas fa-check"></i></button>
                        <a href="/purchase_item_add" class="btn btn-cancel">Cancel <i class="fas fa-times"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name');
        const previewImage = document.getElementById('preview-image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imageUploadArea = document.getElementById('image-upload-area');
        const changeImageBtn = document.getElementById('change-image-btn');

        // Make the entire upload area clickable
        imageUploadArea.addEventListener('click', function(e) {
            // Only trigger if clicking on the area itself or the upload prompt
            // (not when clicking on preview elements or change button)
            if (e.target === imageUploadArea || 
                uploadPrompt.contains(e.target) || 
                e.target === uploadPrompt) {
                fileInput.click();
            }
        });

        // Change image button
        changeImageBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent bubbling to container
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            
            if (file) {
                // Display file name
                fileNameDisplay.textContent = file.name;
                
                // Create a URL for the file
                const imageUrl = URL.createObjectURL(file);
                
                // Set the preview image source
                previewImage.src = imageUrl;
                
                // Show preview, hide upload prompt
                uploadPrompt.style.display = 'none';
                imagePreviewContainer.style.display = 'block';
                
                // Ensure the image loads properly
                previewImage.onload = function() {
                    // Revoke the object URL to free memory
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
            fileNameDisplay.textContent = '';
        }
    </script>
</body>
</html>