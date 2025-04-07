<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #333;
            line-height: 1.5;
        }
        
        .form-container {
            background-color: transparent;
            border: 1px solid #ccc;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 12px;
            margin-top: 100px;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }
        
        .form-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
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
        
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 0.9rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #3b82f6;
            outline: none;
        }
        
        .image-upload-area {
            background-color: #f0f9ff;
            border: 1px dashed #0ea5e9;
            border-radius: 6px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            text-align: center;
            margin-bottom: 16px;
        }
        
        .image-upload-area:hover {
            background-color: #e0f2fe;
            border-color: #0c4a6e;
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
            font-size: 0.75rem;
        }
        
        .buttons-container {
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
        }
        
        .btn-danger {
            background-color: #f87171;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">Edit Product</h1>
            <p class="form-subtitle">Update the details below</p>
        </div>

        <form action="/stocklist/update/<?= $stock['stock_list_id']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="stock_list_id" value="<?= htmlspecialchars($stock['stock_list_id']); ?>">
            
            <div class="form-group text-center">
                <label class="form-label">Product Image</label>
                <div class="image-upload-area" id="image-upload-area">
                    <input type="file" name="product_image" accept="image/*" id="file-input" style="display: none;">
                    <img id="preview-image" class="preview-image" src="/<?= htmlspecialchars($stock['product_image']); ?>" alt="Product Image">
                    <button type="button" class="change-image-btn" id="change-image-btn">Change Image</button>
                </div>
            </div>
            
            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($stock['product_image']); ?>">
            
            <div class="form-group">
                <label class="form-label" for="name">Product Name</label>
                <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($stock['product_name']); ?>" required>
            </div>
            
            <div class="buttons-container">
                <button type="submit" class="btn-primary">Update</button>
                <a href="/stocklist" class="btn-danger">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>

    <script>
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');
        const changeImageBtn = document.getElementById('change-image-btn');
        const imageUploadArea = document.getElementById('image-upload-area');

        imageUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        changeImageBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                const imageUrl = URL.createObjectURL(file);
                previewImage.src = imageUrl;
                previewImage.onload = () => {
                    URL.revokeObjectURL(imageUrl);
                };
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

        // Add event listener for the Delete button
        document.querySelector('.delete-stock-item').addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this item?')) {
                const stockId = this.getAttribute('data-id');
                console.log('Attempting to delete stock item with ID:', stockId); // Debug log

                fetch('/stocklist/delete/' + stockId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status); // Debug log
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data); // Debug log
                    if (data.success) {
                        window.location.href = '/stocklist';
                    } else {
                        alert('Error deleting item: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error); // Debug log
                    alert('Error connecting to server: ' + error.message);
                });
            }
        });
    </script>
    <!-- Move your existing script inside </body> and add this after it -->
<script>
    const fileInput = document.getElementById('file-input');
    const previewImage = document.getElementById('preview-image');
    const changeImageBtn = document.getElementById('change-image-btn');
    const imageUploadArea = document.getElementById('image-upload-area');

    imageUploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    changeImageBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (file) {
            const imageUrl = URL.createObjectURL(file);
            previewImage.src = imageUrl;
            previewImage.onload = () => {
                URL.revokeObjectURL(imageUrl);
            };
        }
    });

    // Note: resetImageDisplay and delete functionality are omitted since they reference missing elements
</script>

<script src="/views/assets/js/Language_options/edit-stocklist-o.js"></script>

</body>
</html>
