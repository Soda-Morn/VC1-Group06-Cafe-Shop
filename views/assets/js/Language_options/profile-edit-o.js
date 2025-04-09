// Define translations for Edit Profile page
const editProfileTranslations = {
    en: {
      title: "Edit Your Profile",
      labels: {
        name: "Name",
        email: "Email",
        current_password: "Current Password",
        new_password: "New Password"
      },
      buttons: {
        save_changes: "Save Changes",
        back_to_profile: "Back to Profile"
      },
      errors: {
        required_fields: "Name and email are required!",
        email_in_use: "Email is already in use by another account!",
        password_fields_required: "All password fields are required when changing password!",
        incorrect_current_password: "Incorrect current password!",
        password_length: "New password must be at least 6 characters long!",
        update_failed: "Failed to update profile. Please try again."
      }
    },
    km: {
      title: "កែសម្រួលប្រវត្តិរូបរបស់អ្នក",
      labels: {
        name: "ឈ្មោះ",
        email: "អ៊ីមែល",
        current_password: "លេខសម្ងាត់បច្ចុប្បន្ន",
        new_password: "លេខសម្ងាត់ថ្មី"
      },
      buttons: {
        save_changes: "រក្សាទុកការផ្លាស់ប្តូរ",
        back_to_profile: "ត្រឡប់ទៅប្រវត្តិរូប"
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
    // Update title with retry mechanism
    function updateTitle() {
      const title = document.querySelector('.profile-header h1');
      if (title) {
        title.textContent = editProfileTranslations[language].title;
      } else {
        console.warn('Title element not found, retrying...');
        setTimeout(updateTitle, 100);
      }
    }
    updateTitle();
  
    // Update back button title
    function updateBackButton() {
      const backButton = document.querySelector('.back-button');
      if (backButton) {
        backButton.setAttribute('title', editProfileTranslations[language].buttons.back_to_profile);
      } else {
        console.warn('Back button not found, retrying...');
        setTimeout(updateBackButton, 100);
      }
    }
    updateBackButton();
  
    // Update form labels with retry mechanism
    function updateLabels() {
      const nameLabel = document.querySelector('label[for="name"]');
      const emailLabel = document.querySelector('label[for="email"]');
      const currentPasswordLabel = document.querySelector('label[for="current_password"]');
      const newPasswordLabel = document.querySelector('label[for="new_password"]');
  
      if (nameLabel) {
        nameLabel.textContent = editProfileTranslations[language].labels.name;
      } else {
        console.warn('Name label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
  
      if (emailLabel) {
        emailLabel.textContent = editProfileTranslations[language].labels.email;
      } else {
        console.warn('Email label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
  
      if (currentPasswordLabel) {
        currentPasswordLabel.textContent = editProfileTranslations[language].labels.current_password;
      } else {
        console.warn('Current Password label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
  
      if (newPasswordLabel) {
        newPasswordLabel.textContent = editProfileTranslations[language].labels.new_password;
      } else {
        console.warn('New Password label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
    }
    updateLabels();
  
    // Update Save Changes button with retry mechanism
    function updateSaveButton() {
      const saveButton = document.querySelector('.save-button span');
      if (saveButton) {
        saveButton.textContent = editProfileTranslations[language].buttons.save_changes;
      } else {
        console.warn('Save button span not found, retrying...');
        setTimeout(updateSaveButton, 100);
      }
    }
    updateSaveButton();
  
    // Update error message with retry mechanism
    function updateErrorMessage() {
      const errorMessage = document.querySelector('.error-message');
      if (errorMessage) {
        const currentError = errorMessage.textContent;
        const errorKey = Object.keys(editProfileTranslations.en.errors).find(
          key => editProfileTranslations.en.errors[key] === currentError
        );
        if (errorKey) {
          errorMessage.textContent = editProfileTranslations[language].errors[errorKey];
        }
      } else {
        console.warn('Error message not found, retrying...');
        setTimeout(updateErrorMessage, 100);
      }
    }
    updateErrorMessage();
  
    // Store error translations for dynamic updates
    window.errorTranslations = editProfileTranslations[language].errors;
  }
  
  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    localStorage.setItem('selectedLanguage', language); // Save language
    originalSetLanguage(language);
    updateEditProfileLanguage(language);
  };
  
  // Load saved language on page load
  window.addEventListener('load', () => {
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