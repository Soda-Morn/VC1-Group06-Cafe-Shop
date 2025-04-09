
  // Define translations for Profile page
  const profileTranslations = {
    en: {
      labels: {
        name: "Name:",
        email: "Email:"
      },
      buttons: {
        edit_profile: "Edit Profile"
      }
    },
    km: {
      labels: {
        name: "ឈ្មោះ:",
        email: "អ៊ីមែល:"
      },
      buttons: {
        edit_profile: "កែសម្រួលប្រវត្តិរូប"
      }
    }
  };

  // Function to update Profile page language
  function updateProfileLanguage(language) {
    // Update labels
    const nameLabel = document.querySelector('.profile-item:nth-child(1) strong');
    const emailLabel = document.querySelector('.profile-item:nth-child(2) strong');
    
    if (nameLabel) {
      nameLabel.textContent = profileTranslations[language].labels.name;
    } else {
      console.error('Name label not found with selector .profile-item:nth-child(1) strong');
    }

    if (emailLabel) {
      emailLabel.textContent = profileTranslations[language].labels.email;
    } else {
      console.error('Email label not found with selector .profile-item:nth-child(2) strong');
    }

    // Update Edit Profile button
    const editButton = document.querySelector('.edit-button');
    if (editButton) {
      editButton.textContent = profileTranslations[language].buttons.edit_profile;
    } else {
      console.error('Edit Profile button not found with selector .edit-button');
    }
  }

  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    originalSetLanguage(language);
    updateProfileLanguage(language);
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
