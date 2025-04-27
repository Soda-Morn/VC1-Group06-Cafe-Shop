<link rel="stylesheet" href="../views/assets/css/payment/upload_payment.css">
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
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
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
<script src="/views/assets/js/Language_options/upload-payment-o.js"></script>
<script src="/views/assets/js/payment/upload_payment.js"></script>