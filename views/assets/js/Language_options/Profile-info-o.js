const profileTranslations = {
    en: {
      title: "'s Profile",
      labels: {
        email: "Email:",
        role: "Role:",
        last_login: "Last Login:"
      },
      buttons: {
        edit_profile: "Edit Profile",
        logout: "Logout",
        back_to_dashboard: "Back to Dashboard"
      },
      role_value: "Administrator"
    },
    km: {
      title: " ប្រវត្តិរូប",
      labels: {
        email: "អ៊ីមែល:",
        role: "តួនាទី:",
        last_login: "ការចូលចុងក្រោយ:"
      },
      buttons: {
        edit_profile: "កែសម្រួលប្រវត្តិរូប",
        logout: "ចាកចេញ",
        back_to_dashboard: "ត្រឡប់ទៅផ្ទាំងគ្រប់គ្រង"
      },
      role_value: "អ្នកគ្រប់គ្រង"
    }
  };
  
  // Function to update Profile page language
  function updateProfileLanguage(language) {
    // Update page title
    function updateTitle() {
      const userNameElement = document.querySelector('.profile-header h2');
      if (userNameElement) {
        const userName = userNameElement.textContent;
        document.title = userName + profileTranslations[language].title;
      } else {
        console.warn('User name element not found, retrying...');
        setTimeout(updateTitle, 100);
      }
    }
    updateTitle();
  
    // Update back button title
    function updateBackButton() {
      const backButton = document.querySelector('.back-button');
      if (backButton) {
        backButton.setAttribute('title', profileTranslations[language].buttons.back_to_dashboard);
      } else {
        console.warn('Back button not found, retrying...');
        setTimeout(updateBackButton, 100);
      }
    }
    updateBackButton();
  
    // Update labels with retry mechanism
    function updateLabels() {
      const emailLabel = document.querySelector('.profile-info div:nth-child(1) strong');
      const roleLabel = document.querySelector('.profile-info div:nth-child(2) strong');
      const lastLoginLabel = document.querySelector('.profile-info div:nth-child(3) strong');
  
      if (emailLabel) {
        emailLabel.textContent = profileTranslations[language].labels.email;
      } else {
        console.warn('Email label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
  
      if (roleLabel) {
        roleLabel.textContent = profileTranslations[language].labels.role;
      } else {
        console.warn('Role label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
  
      if (lastLoginLabel) {
        lastLoginLabel.textContent = profileTranslations[language].labels.last_login;
      } else {
        console.warn('Last Login label not found, retrying...');
        setTimeout(updateLabels, 100);
        return;
      }
    }
    updateLabels();
  
    // Update role value
    function updateRoleValue() {
      const roleValue = document.querySelector('.profile-info div:nth-child(2)').childNodes[2];
      if (roleValue) {
        roleValue.textContent = profileTranslations[language].role_value;
      } else {
        console.warn('Role value not found, retrying...');
        setTimeout(updateRoleValue, 100);
      }
    }
    updateRoleValue();
  
    // Update buttons
    function updateButtons() {
      const editButton = document.querySelector('.btn-edit');
      const logoutButton = document.querySelector('.btn-logout');
  
      if (editButton) {
        editButton.innerHTML = `<i class="fas fa-user-edit"></i> ${profileTranslations[language].buttons.edit_profile}`;
      } else {
        console.warn('Edit button not found, retrying...');
        setTimeout(updateButtons, 100);
        return;
      }
  
      if (logoutButton) {
        logoutButton.innerHTML = `<i class="fas fa-sign-out-alt"></i> ${profileTranslations[language].buttons.logout}`;
      } else {
        console.warn('Logout button not found, retrying...');
        setTimeout(updateButtons, 100);
        return;
      }
    }
    updateButtons();
  }
  
  // Integrate with existing setLanguage function
  const originalSetLanguage = window.setLanguage || function() {};
  window.setLanguage = function(language) {
    console.log('setLanguage called with language:', language); // Debug
    localStorage.setItem('selectedLanguage', language); // Save language
    originalSetLanguage(language);
    updateProfileLanguage(language);
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