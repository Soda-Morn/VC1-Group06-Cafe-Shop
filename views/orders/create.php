<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background for the entire page */
        }

        .card {
            background-color: #ffffff; /* White background for the card */
            border: none; /* Remove default border */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .image-upload {
            cursor: pointer;
            background-color: #e7f3ff;
            border: 2px dashed #007bff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            transition: background-color 0.3s; /* Smooth transition for hover */
        }

        .image-upload:hover {
            background-color: #d0e7ff;
        }

        .image-upload img {
            width: 50px;
            margin-bottom: 10px;
        }

        .btn-submit {
            background: linear-gradient(90deg, #007bff, #00c6ff); /* Gradient background */
            color: white;
            transition: background 0.3s; /* Smooth transition for hover */
        }

        .btn-cancel {
            background-color:rgb(255, 51, 0);
            color: white;
            transition: background 0.3s; /* Smooth transition for hover */
        }

        .btn-submit:hover {
            background: linear-gradient(90deg, #00c6ff, #007bff); /* Reverse gradient on hover */
        }

        .btn-cancel:hover {
            opacity: 0.9;
        }

        .text-center {
            text-align: center;
            margin-top: 50px;
            padding: 5px;
        }

        .form-group input, .form-group textarea {
            border-radius: 5px; /* Rounded corners for inputs */
            transition: border-color 0.3s; /* Smooth transition for focus */
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #007bff; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add shadow on focus */
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .image-upload {
                padding: 15px; /* Reduced padding for smaller screens */
            }

            .btn-submit, .btn-cancel {
                width: 100%; /* Full width buttons */
                margin: 5px 0; /* Margins between buttons */
            }
            .btn-cancel{
                background: red;
            }

            body {
                padding: 10px; /* Add some padding to the body */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="font-weight-bold">Add a New Product</h4>
                    <h6 class="text-muted">Fill in the details below to create a product</h6>
                </div>

                <form action="/order_menu/store" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image" class="font-weight-bold">Product Image</label>
                        <div class="image-upload" onclick="document.getElementById('file-input').click();">
                            <input type="file" name="image" accept="image/*" id="file-input" class="d-none" required>
                            <img src="/Views/assets/img1/icons/upload.svg" alt="Upload Image">
                            <h5 class="text-muted">Drag and drop a file to upload or click to select</h5>
                        </div>
                        <div id="file-name" class="text-success"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit me-2">Submit <i class="fas fa-check"></i></button>
                        <a href="/order_menu" class="btn btn-cancel">Cancel <i class="fas fa-times"></i></a>
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