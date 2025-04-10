<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Quantity</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        .image-display-area {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .preview-image {
            max-height: 100px;
            max-width: 80%;
            object-fit: contain;
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
        
        .display-text {
            font-size: 0.9rem;
            color: #4b5563;
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            text-align: center;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">Edit Product Quantity</h1>
            <p class="form-subtitle">Update the quantity below</p>
        </div>

        <form action="/stocklist/update/<?= $stock['stock_list_id']; ?>" method="POST">
            <input type="hidden" name="stock_list_id" value="<?= htmlspecialchars($stock['stock_list_id']); ?>">
            
            <!-- Display General Error Message if Exists (e.g., for update failure) -->
            <?php if (isset($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <!-- Display Product Image (Static, No Background) -->
            <div class="form-group text-center">
                <label class="form-label">Product Image</label>
                <div class="image-display-area">
                    <img class="preview-image" src="/<?= htmlspecialchars($stock['product_image']); ?>" alt="Product Image">
                </div>
            </div>
            
            <!-- Display Product Name (Static) -->
            <div class="form-group">
                <label class="form-label">Product Name</label>
                <p class="display-text"><?= htmlspecialchars($stock['product_name']); ?></p>
            </div>
            
            <!-- Quantity Field (Editable) -->
            <div class="form-group">
                <label class="form-label" for="quantity">Quantity</label>
                <!-- Fixed the truncated value attribute -->
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($stock['quantity']); ?>" min="0" required>
            </div>
            
            <div class="buttons-container">
                <button type="submit" class="btn-primary">Update Quantity</button>
                <a href="/stocklist" class="btn-danger">Cancel</a>
            </div>
        </form>
    </div>

    <!-- JavaScript to trigger SweetAlert for quantity error -->
    <script>
        // Check if quantityError flag is set
        <?php if (isset($quantityError) && $quantityError): ?>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Quantity',
                text: 'Quantity can only be decreased',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb'
            });
        <?php endif; ?>
    </script>
    <script src="/views/assets/js/Language_options/edit-stocklist-o.js"></script>
</body>
</html>