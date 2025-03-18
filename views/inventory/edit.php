<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .image-upload {
            cursor: pointer;
            background-color: #e7f3ff;
            border: 2px dashed #007bff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        .image-upload:hover {
            background-color: #d0e7ff;
        }

        .image-upload img {
            width: 50px;
            margin-bottom: 10px;
        }

        .btn-submit {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: white;
            transition: background 0.3s;
        }

        .btn-cancel {
            background-color: rgb(255, 51, 0);
            color: white;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: linear-gradient(90deg, #00c6ff, #007bff);
        }

        .btn-cancel:hover {
            opacity: 0.9;
        }

        .text-center {
            text-align: center;
            margin-top: 50px;
            padding: 5px;
        }

        .form-group input {
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .existing-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        @media (max-width: 576px) {
            .image-upload {
                padding: 15px;
            }

            .btn-submit, .btn-cancel {
                width: 100%;
                margin: 5px 0;
            }

            .btn-cancel {
                background: red;
            }

            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="font-weight-bold">Edit Product</h4>
                    <h6 class="text-muted">Update the details below</h6>
                </div>

                <form action="/purchase_item_add/update/<?= $product['purchase_item_id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="font-weight-bold">Product Image</label>
                        <div class="image-upload" onclick="document.getElementById('file-input').click();">
                            <input type="file" name="image" accept="image/*" id="file-input" class="d-none">
                            <img src="/Views/assets/img1/icons/upload.svg" alt="Upload Image">
                            <h5 class="text-muted">Select Product Image</h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['product_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" value="<?= htmlspecialchars($product['price']); ?>" required>
                    </div>
                    
                    <div class="form-group">

                        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($product['product_image']); ?>">
                        
                        <?php if (!empty($product['product_image'])): ?>
                            <p>Current Image:</p>
                            <img src="/<?= htmlspecialchars($product['product_image']); ?>" alt="Current Image" class="existing-image">
                        <?php endif; ?>

                        <div id="file-name" class="text-success"></div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit me-2">Update <i class="fas fa-check"></i></button>
                        <a href="/purchase_item_add" class="btn btn-cancel">Cancel <i class="fas fa-times"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            const fileName = fileInput.files[0] ? fileInput.files[0].name : 'No file chosen';
            fileNameDisplay.textContent = fileName;
        });
    </script>
</body>
</html>
