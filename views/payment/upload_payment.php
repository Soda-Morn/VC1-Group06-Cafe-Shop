<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valea Cafe - Upload Payment QR Code</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .upload-container {
            margin-top: 100px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-upload {
            padding: 10px;
            font-size: 1.1rem;
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }
        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="upload-container card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Upload Payment QR Code</h3>
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="qr_image">Select QR Code Image</label>
                    <input type="file" class="form-control-file" id="qr_image" name="qr_image" accept="image/*" required>
                    <small class="text-muted">Only image files (e.g., PNG, JPEG) are allowed.</small>
                </div>
                <button type="submit" class="btn-upload btn btn-primary btn-block rounded">
                    <i class="fas fa-upload mr-2"></i> Upload QR Code
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this);

                $.ajax({
                    url: '/payment/upload', // Adjust this URL to match your server route
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Assuming the server returns JSON with 'success' and 'message'
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#007bff'
                            });
                            $('#uploadForm')[0].reset(); // Reset form after success
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#007bff'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#007bff'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>