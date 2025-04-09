
  // Define translations for Edit Profile page
  const editProfileTranslations = {
    en: {
      title: "Edit Profile",
      labels: {
        name: "Name",
        email: "Email",
        current_password: "Current Password",
        new_password: "New Password"
      },
      buttons: {
        save_changes: "Save Changes"
      },
      errors: {
        required_fields: "Name and email are required!",
        email_in_use: "Email is already in use by another account!",
        password_fields_required: "All password fields are required when changing password!",
        incorrect_current_password: "Current password is incorrect!",
        password_length: "New password must be at least 6 characters long!",
        update_failed: "Failed to update profile. Please try again."
      }
    },
    km: {
      title: "កែសម្រួលប្រវត្តិរូប",
      labels: {
        name: "ឈ្មោះ",
        email: "អ៊ីមែល",
        current_password: "លេខសម្ងាត់បច្ចុប្បន្ន",
        new_password: "លេខសម្ងាត់ថ្មី"
      },
      buttons: {
        save_changes: "រក្សាទុកការផ្លាស់ប្តូរ"
      },
      errors: {
        required_fields: "ឈ្មោះ និងអ៊ីមែលត្រូវតែបំពេញ!",
        email_in_use: "អ៊ីមែលនេះត្រូវបានប្រើប្រាស់រួចហើយដោយគណនីផ្សេង!",
        password_fields_required: "គ្រប់វាលលេខសម្ងាត់ត្រូវតែបំពេញនៅពេលផ្លាស់ប្តូរលេខសម្ងាត់!",
        incorrect_current_password: "លេខសម្ងាត់បច្ចុប្បន្នមិនត្រឹមត្រូវទេ!",
        password_length: "លេខសម្ងាត់ថ្មីត្រូវតែមានយ៉ាងហោចណាស់ ៦ តួអក្សរ!",
        update_failed: "បរាជ័យក្នុងការធ្វើបច្ចុប្បន្នភាពប្រវត្តិរូប។ សូមព្យាយាមម្តងទៀត។"
      }
    }
  };

  // Function to update Edit Profile page language
  function updateEditProfileLanguage(language) {
    // Update title
    const title = document.querySelector('.profile-edit-container h2');
    console.log('Title element found:', title); // Debug
    if (title) {
      title.textContent = editProfileTranslations[language].title;
    } else {
      console.error('Title element not found with selector .profile-edit-container h2');
    }

    // Update form labels using specific selectors
    const nameLabel = document.querySelector('label[for="name"]');
    const emailLabel = document.querySelector('label[for="email"]');
    const currentPasswordLabel = document.querySelector('label[for="current_password"]');
    const newPasswordLabel = document.querySelector('label[for="new_password"]');

    if (nameLabel) {
      nameLabel.textContent = editProfileTranslations[language].labels.name;
    } else {
      console.error('Name label not found with selector label[for="name"]');
    }

    if (emailLabel) {
      emailLabel.textContent = editProfileTranslations[language].labels.email;
    } else {
      console.error('Email label not found with selector label[for="email"]');
    }

    if (currentPasswordLabel) {
      currentPasswordLabel.textContent = editProfileTranslations[language].labels.current_password;
    } else {
      console.error('Current Password label not found with selector label[for="current_password"]');
    }

    if (newPasswordLabel) {
      newPasswordLabel.textContent = editProfileTranslations[language].labels.new_password;
    } else {
      console.error('New Password label not found with selector label[for="new_password"]');
    }

    // Update Save Changes button
    const saveButton = document.querySelector('.save-button');
    if (saveButton) {
      saveButton.textContent = editProfileTranslations[language].buttons.save_changes;
    }

    // Update error message (if present)
    const errorMessage = document.querySelector('.error-message');
    if (errorMessage) {
      const currentError = errorMessage.textContent;
      const errorKey = Object.keys(editProfileTranslations.en.errors).find(
        key => editProfileTranslations.en.errors[key] === currentError
      );
      if (errorKey) {
        errorMessage.textContent = editProfileTranslations[language].errors[errorKey];
      }
    }

    // Store error translations for dynamic updates
    window.errorTranslations = editProfileTranslations[language].errors;
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateEditProfileLanguage(language);
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

  // Existing script for image preview (unchanged)
  function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }
