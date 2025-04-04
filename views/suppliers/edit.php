<div class="container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4 w-75 bg-light" style="border-radius: 15px;">
        <h1 class="text-center text-primary mb-4">Edit Supplier</h1>
        <form action="/suppliers/update/<?= htmlspecialchars($supplier['id']) ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Supplier Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($supplier['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                <input type="text" class="form-control " id="phone_number" name="phone_number" 
                       value="<?= htmlspecialchars($supplier['phone_number']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <input type="text" class="form-control " id="address" name="address" 
                       value="<?= htmlspecialchars($supplier['address']) ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                
                <a href="/suppliers" class="btn btn-danger w-45">Cancel</a>
                <button type="submit" class="btn btn-primary w-45">Update Supplier</button>
            </div>
        </form>
    </div>
</div>
<script>
  // Define translations for Edit Supplier page
  const editSupplierTranslations = {
    en: {
      title: "Edit Supplier",
      labels: ["Supplier Name", "Phone Number", "Address"],
      buttons: ["Cancel", "Update Supplier"]
    },
    km: {
      title: "កែសម្រួលអ្នកផ្គត់ផ្គង់",
      labels: ["ឈ្មោះអ្នកផ្គត់ផ្គង់", "លេខទូរស័ព្ទ", "អាសយដ្ឋាន"],
      buttons: ["បោះបង់", "ធ្វើបច្ចុប្បន្នភាពអ្នកផ្គត់ផ្គង់"]
    }
  };

  // Function to update Edit Supplier page language
  function updateEditSupplierLanguage(language) {
    // Update title
    const title = document.querySelector('.card h1');
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = editSupplierTranslations[language].title;
    } else {
      console.error('Title element not found with selector .card h1');
    }

    // Update form labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach((label, index) => {
      if (index < editSupplierTranslations[language].labels.length) {
        label.textContent = editSupplierTranslations[language].labels[index];
      }
    });

    // Update buttons with a more specific selector
    const buttons = document.querySelectorAll('.d-flex.justify-content-between .btn');
    console.log('Buttons found:', buttons); // Debug
    console.log('Number of buttons found:', buttons.length); // Debug
    buttons.forEach((button, index) => {
      if (index < editSupplierTranslations[language].buttons.length) {
        button.textContent = editSupplierTranslations[language].buttons[index];
      }
    });
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateEditSupplierLanguage(language);
  };

  // Load saved language on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    console.log('Initial language on page load:', savedLanguage); // Debug
    setLanguage(savedLanguage);
  });

  // For testing: Add a manual trigger to switch languages
  window.addEventListener('load', () => {
    const testButtons = `
      <div style="position: fixed; top: 10px; right: 10px;">
        <button onclick="setLanguage('en')">English</button>
        <button onclick="setLanguage('km')">Khmer</button>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', testButtons);
  });
</script>