document.getElementById('showQrBtn').addEventListener('click', function() {
    const qrContainer = document.getElementById('qrCodeContainer');
    qrContainer.style.display = 'block';
    this.style.display = 'none';
    
    // Scroll to QR code for better UX
    qrContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
});

// Add animation when page loads
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.payment-container').style.opacity = '1';
});