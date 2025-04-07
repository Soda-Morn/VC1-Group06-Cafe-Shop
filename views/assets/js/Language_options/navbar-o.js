
        // Define translations
        const translations = {
            en: {
                sidebar: [
                    "Dashboard",
                    "Order Menu",
                    "Order Report",
                    "Stock List",
                    "Restock",
                    "Supplier Info",
                    "Categories"
                ],
                topbar: {
                    hi: "Hi",
                    view_profile: "View Profile",
                    logout: "Logout",
                    my_profile: "My Profile",
                    account_settings: "Account Settings",
                    language_label: "English"
                }
            },
            km: {
                sidebar: [
                    "ផ្ទាំងគ្រប់គ្រង",
                    "ម៉ឺនុយបញ្ជាទិញ",
                    "របាយការណ៍បញ្ជាទិញ",
                    "បញ្ជីស្តុក",
                    "បំពេញស្តុក",
                    "ព័ត៌មានអ្នកផ្គត់ផ្គង់",
                    "ប្រភេទ"
                ],
                topbar: {
                    hi: "សួស្តី",
                    view_profile: "មើលប្រវត្តិរូប",
                    logout: "ចាកចេញ",
                    my_profile: "ប្រវត្តិរូបរបស់ខ្ញុំ",
                    account_settings: "ការកំណត់គណនី",
                    language_label: "ភាសាខ្មែរ"
                }
            }
        };

        function setLanguage(lang) {
            // Update language dropdown
            const flagIcon = document.getElementById('flagIcon');
            const languageText = document.getElementById('languageText');
            const dropdownMenu = document.getElementById('dropdownMenu');

            if (lang === 'en') {
                flagIcon.src = 'https://flagcdn.com/w40/gb.png';
                flagIcon.alt = 'English Flag';
                languageText.textContent = translations.en.topbar.language_label;
                dropdownMenu.innerHTML = `
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" data-lang="km">
                            <img src="https://flagcdn.com/w40/kh.png" alt="Khmer Flag" class="me-1" style="width: 20px; height: 20px;">
                            <span>${translations.km.topbar.language_label}</span>
                        </a>
                    </li>
                `;
            } else if (lang === 'km') {
                flagIcon.src = 'https://flagcdn.com/w40/kh.png';
                flagIcon.alt = 'Khmer Flag';
                languageText.textContent = translations.km.topbar.language_label;
                dropdownMenu.innerHTML = `
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" data-lang="en">
                            <img src="https://flagcdn.com/w40/gb.png" alt="English Flag" class="me-1" style="width: 20px; height: 20px;">
                            <span>${translations.en.topbar.language_label}</span>
                        </a>
                    </li>
                `;
            }

            // Update sidebar items
            const sidebarItems = document.querySelectorAll('.sidebar .nav-item p');
            sidebarItems.forEach((item, index) => {
                if (translations[lang].sidebar[index]) {
                    item.textContent = translations[lang].sidebar[index];
                }
            });

            // Update topbar items
            const hiText = document.querySelector('.profile-username .op-7');
            if (hiText) hiText.textContent = translations[lang].topbar.hi;

            const viewProfileBtn = document.querySelector('.user-box .btn-secondary');
            if (viewProfileBtn) viewProfileBtn.textContent = translations[lang].topbar.view_profile;

            const logoutBtn = document.querySelector('.user-box .btn-danger');
            if (logoutBtn) logoutBtn.textContent = translations[lang].topbar.logout;

            // Save selected language
            localStorage.setItem('selectedLanguage', lang);
        }

        // Event delegation for language selection
        document.addEventListener('click', (event) => {
            const target = event.target.closest('.dropdown-item');
            if (target && target.closest('#dropdownMenu')) {
                event.preventDefault();
                const lang = target.getAttribute('data-lang');
                if (lang) {
                    setLanguage(lang);
                }
            }
        });

        // Initialize language on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
            setLanguage(savedLanguage);
        });
    