<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* Form Container */
        .form-container {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            max-width: 700px;
            margin: 40px auto;
            padding: 30px 40px;
            border-radius: 12px;
            margin-top: 80px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Form Header */
        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: 0.95rem;
            color: #6b7280;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 10px;
        }

        .form-category {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #4b5563;
            font-size: 1rem;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: 8px;
            margin-right: 8PX;
            
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #3b82f6;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.95rem;
        }

        .form-select {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
        }

        .form-select:focus {
            border-color: #3b82f6;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Image Upload Area */
        .image-upload-area {
            background-color: #f0f9ff;
            border: 1px dashed #90cdf4;
            border-radius: 6px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            height: 152px;
            width: 600px;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .image-upload-area:hover {
            background-color: #e0f2fe;
            border-color: #60a5fa;
        }

        .upload-icon {
            color: #3b82f6;
            width: 24px;
            height: 24px;
            margin-bottom: 10px;
        }

        .upload-text {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .image-preview-container {
            display: none;
            width: 100%;
            height: 100%;
            text-align: center;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .preview-image {
            max-height: 100px;
            max-width: 80%;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .change-image-btn {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: background-color 0.2s;
            font-weight: 500;
        }
        .btn-submit{
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background-color 0.2s;
            font-weight: 450;
        }

        .change-image-btn:hover {
            background-color: #2563eb;
        }

        /* Buttons */
        .buttons-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .form-container {
                padding: 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 16px;
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
        <form action="/order_menu/store" method="POST" enctype="multipart/form-data" id="product-form">
            <!-- Image Upload Section -->
            <div class="form-group">
                <label class="form-label">Product Image</label>
                <div class="image-upload-area" id="image-upload-area">
                    <input type="file" name="image" accept="image/*" id="file-input" style="display: none;" required>
                    <div class="upload-prompt" id="upload-prompt">
                        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <span class="upload-text">Select Product Image</span>
                    </div>
                    <div class="image-preview-container" id="image-preview-container">
                        <img id="preview-image" class="preview-image" src="#" alt="Preview">
                        <button type="button" class="change-image-btn" id="change-image-btn">
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
                    <input type="number" name="price" id="price" class="form-control" step="0.01" placeholder="Enter price" required>
                </div>
            </div>

            <!-- Category Section -->
            <div class="form-category">
                <label class="form-label" for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
            </div>

                <!-- Buttons -->
                <div class="buttons-container">
                <button type="submit" class="btn-submit" id="submit-btn">
                    Add To Menu
                </button>
                <a href="/order_menu" class="btn btn-danger">
                    Cancel
                </a>
            </div>
        </form>
    </div>

  
</body>
</html>