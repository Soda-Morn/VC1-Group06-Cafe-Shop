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