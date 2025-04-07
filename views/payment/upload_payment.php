<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valea Cafe - Upload Payment QR Code</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6C4AB6;
            --secondary-color: #8D72E1;
            --accent-color: #B9E0FF;
            --light-color: #F8F9FA;
            --dark-color: #212529;
            --brown: #a04d13;
        }
        
        .upload-container {
            max-width: 800px;
            width: 100%;
            margin: 120px auto;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(108, 74, 182, 0.2);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(to right, var(--brown), var(--brown));
            color: white;
            text-align: center;
            padding: 25px;
        }
        
        .card-header h3 {
            font-weight: 500;
            margin: 0;
            font-size: 2rem;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
            font-size: 1.8rem; /* Increased font size */
        }
        
        .file-upload-wrapper {
            position: relative;
            margin-bottom: 15px;
            margin: 0px auto;
            width: 100%;
        }
        
        .file-upload-input {
            width: 100%;
            height: 180px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            cursor: pointer;
            transition: all 0.3s;
            background-color: rgba(140, 114, 225, 0.05);
            padding: 30px;
            text-align: center;
            
        }
        
        .file-upload-input:hover {
            background-color: rgba(140, 114, 225, 0.1);
        }
        
        .file-upload-input.has-file {
            background-color: rgba(108, 74, 182, 0.1);
        }
        
        .file-upload-icon {
            font-size: 50px;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .file-upload-text {
            font-size: 16px;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .file-upload-hint {
            font-size: 14px;
            color: #6c757d;
        }
        
        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .btn-upload {
            background: linear-gradient(to right, var(--brown), var(--brown));
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(108, 74, 182, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30%;
            margin: 0px auto;
            font-size: 15px;
            color: white; /* Full width for button */
        }
        
        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 74, 182, 0.4);
        }
        
        .btn-upload:active {
            transform: translateY(0);
        }
        
        .btn-upload i {
            margin-right: 10px;
            font-size: 20px;
            color: white;
        }
        
        .text-muted {
            font-size: 0.85rem;
        }
        
        .progress {
            height: 8px;
            border-radius: 4px;
            margin-top: 15px;
            display: none;
        }
        
        .progress-bar {
            background: linear-gradient(to right, var(--brown), var(--brown));
            transition: width 0.3s ease;
        }
        
        @media (max-width: 576px) {
            .card-header h3 {
                font-size: 1.5rem;
            }
            
            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <div class="card shadow-lg">
            <div class="card-header">
                <h3>Upload Payment QR Code</h3>
            </div>
            <div class="card-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="qr_image" class="form-label">Select QR Code Image</label>
                        <div class="file-upload-wrapper">
                            <div id="fileUploadArea" class="file-upload-input">
                                <i class="fas fa-qrcode file-upload-icon"></i>
                                <div class="file-upload-text">Click drag & drop</div>
                                <div class="file-upload-hint">Upload your real QR here.</div>
                                <div id="fileName" class="file-name"></div>
                            </div>
                            <input type="file" class="d-none" id="qr_image" name="qr_image" accept="image/*" required>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn-upload">
                        <i class="fas fa-cloud-upload-alt"></i> Upload QR Code
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // File upload area click handler
            $('#fileUploadArea').on('click', function() {
                $('#qr_image').click();
            });
            
            // Drag and drop functionality
            $('#fileUploadArea').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('dragover');
            });
            
            $('#fileUploadArea').on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
            });
            
            $('#fileUploadArea').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
                if (e.originalEvent.dataTransfer.files.length) {
                    $('#qr_image')[0].files = e.originalEvent.dataTransfer.files;
                    updateFileName();
                }
            });
            
            // File input change handler
            $('#qr_image').on('change', function() {
                updateFileName();
            });
            
            function updateFileName() {
                const fileInput = $('#qr_image')[0];
                if (fileInput.files && fileInput.files.length > 0) {
                    const fileName = fileInput.files[0].name;
                    $('#fileName').text(fileName);
                    $('#fileUploadArea').addClass('has-file');
                } else {
                    $('#fileName').text('');
                    $('#fileUploadArea').removeClass('has-file');
                }
            }
            
            // Form submission
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                
                const fileInput = $('#qr_image')[0];
                if (!fileInput.files || fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select a QR code image to upload',
                        confirmButtonColor: 'var(--primary-color)'
                    });
                    return;
                }
                
                // Check file size (5MB max)
                if (fileInput.files[0].size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File too large',
                        text: 'Maximum file size is 5MB',
                        confirmButtonColor: 'var(--primary-color)'
                    });
                    return;
                }
                
                const formData = new FormData(this);
                const progressBar = $('.progress-bar');
                const progressContainer = $('.progress');
                
                // Show progress bar
                progressContainer.show();
                
                $.ajax({
                    url: '/payment/upload',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        const xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percent = Math.round((e.loaded / e.total) * 100);
                                progressBar.css('width', percent + '%').attr('aria-valuenow', percent);
                            }
                        });
                        return xhr;
                    },
                    success: function(response) {
                        progressContainer.hide();
                        
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message || 'QR Code uploaded successfully',
                                confirmButtonText: 'Great!',
                                confirmButtonColor: 'var(--primary-color)',
                                backdrop: `
                                    rgba(108,74,182,0.4)
                                `
                            }).then(() => {
                                $('#uploadForm')[0].reset();
                                $('#fileName').text('');
                                $('#fileUploadArea').removeClass('has-file');
                                progressBar.css('width', '0%').attr('aria-valuenow', 0);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message || 'Something went wrong with the upload',
                                confirmButtonText: 'Try Again',
                                confirmButtonColor: 'var(--primary-color)'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        progressContainer.hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: 'var(--primary-color)'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>