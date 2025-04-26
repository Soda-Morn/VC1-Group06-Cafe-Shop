document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('supplier-search');
    const supplierItems = document.querySelectorAll('.supplier-item');

    function filterSuppliers() {
      const searchTerm = searchInput.value.toLowerCase().trim();

      supplierItems.forEach(item => {
        const supplierName = item.querySelector('td:nth-child(2)').textContent.toLowerCase();
        item.style.display = supplierName.includes(searchTerm) ? '' : 'none';
      });
    }

    searchInput.addEventListener('input', filterSuppliers);
  });