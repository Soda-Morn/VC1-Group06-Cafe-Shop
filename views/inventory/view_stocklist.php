<div class="container d-flex justify-content-center">
    <div class="card-body w-100 mt-5" style="max-width: 400px;">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-header bg-warning d-flex align-items-center justify-content-between rounded-top-4 px-3 py-2">
                <h4 class="view m-0 flex-grow-1 text-center fw-bold m-left-50px">View Details</h4>
                <a href="/stocklist" class="btn fw-bold text-dark p-0" style="margin-right: 5px;">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <div class="card-body d-flex flex-column align-items-center p-3">
                <!-- Product Image -->
                <div class="form-group mb-4 mx-auto" style="max-width: 300px;">
                    <div class="image-upload-area" id="image-upload-area">
                        <input type="file" name="product_image" accept="image/*" id="file-input" style="display: none;">
                        <img id="preview-image" class="preview-image border border-0 mb-3 img-fluid rounded-3 shadow-sm"
                            src="/<?= htmlspecialchars($stock['product_image']); ?>" alt="Product Image"
                            style="width:100%; height: auto; max-height: 200px; object-fit: cover;">
                    </div>
                </div>
                <!-- Details -->
                <div class="text-center mt-3">
                    <p class="fw-bold fs-6 mb-2 text-dark">Name: <?= htmlspecialchars($stock['product_name']); ?></p>
                    <p class="text-muted mb-2">Date: <?= date('F j, Y', strtotime($stock['date'])); ?></p>
                    <p class="fw-semibold mb-3 text-dark">Stocks: <?= htmlspecialchars($stock['quantity']); ?> item</p>
                    <span class="badge px-3 py-2 rounded-pill fw-bold m-2 shadow-sm
                        <?php
                        $quantity = $stock['quantity'];
                        if ($quantity == 0) {
                            echo 'bg-danger'; // Out of Stock
                        } elseif ($quantity <= 3) {
                            echo 'bg-danger'; // Low Stock (change to red)
                        } else {
                            echo 'bg-success'; // In Stock
                        }
                        ?>" style="font-size: 1.2rem;">
                        <?= $quantity == 0 ? 'Out of Stock' : ($quantity <= 3 ? 'Low Stock' : 'In Stock'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function () {
        const $previewImage = $('#preview-image');
        const defaultImage = '/assets/images/default-image.jpg';

        // Error handling for image
        $previewImage.on('error', function () {
            console.log('Image failed to load: ' + $(this).attr('src'));
            $(this).attr('src', defaultImage);
        }).on('load', function () {
            console.log('Image loaded: ' + $(this).attr('src'));
        });
    });
</script>

<!-- Add this script after your existing <script> tags -->
<script>
  // Define translations for View Details page
  const viewDetailsTranslations = {
    en: {
      title: "View Details",
      labels: ["Name:", "Date:", "Stocks:", "item"],
      status_labels: ["In Stock", "Low Stock", "Out of Stock"]
    },
    km: {
      title: "មើលលម្អិត",
      labels: ["ឈ្មោះ:", "កាលបរិច្ឆេទ:", "ស្តុក:", "ធាតុ"],
      status_labels: ["មានស្តុក", "ស្តុកតិច", "អស់ស្តុក"]
    }
  };

  // Function to update View Details page language
  function updateViewDetailsLanguage(language) {
    // Update title
    const title = document.querySelector('.card-header h4');
    if (title) title.textContent = viewDetailsTranslations[language].title;

    // Update labels
    const labelElements = document.querySelectorAll('.card-body .text-center p');
    labelElements.forEach((element, index) => {
      if (index < 3) { // Only the first 3 <p> tags have labels
        const currentText = element.textContent;
        const value = currentText.split(': ')[1]; // Extract the value after the colon
        element.textContent = `${viewDetailsTranslations[language].labels[index]} ${value}`;
      }
    });

    // Update "item" in Stocks line
    const stocksText = labelElements[2]; // Third <p> is Stocks
    if (stocksText) {
      const quantity = stocksText.textContent.match(/\d+/)[0]; // Extract number
      stocksText.textContent = `${viewDetailsTranslations[language].labels[2]} ${quantity} ${viewDetailsTranslations[language].labels[3]}`;
    }

    // Update status badge
    const statusBadge = document.querySelector('.card-body .badge');
    if (statusBadge) {
      const currentStatus = statusBadge.textContent.trim();
      const statusIndex = viewDetailsTranslations.en.status_labels.indexOf(currentStatus);
      if (statusIndex === -1) { // If current text is in Khmer, check against Khmer to find index
        const kmIndex = viewDetailsTranslations.km.status_labels.indexOf(currentStatus);
        if (kmIndex !== -1) statusBadge.textContent = viewDetailsTranslations[language].status_labels[kmIndex];
      } else {
        statusBadge.textContent = viewDetailsTranslations[language].status_labels[statusIndex];
      }
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    originalSetLanguage(language); // Call the navbar/stock list setLanguage
    updateViewDetailsLanguage(language); // Update this page
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    setLanguage(savedLanguage);
  });
</script>