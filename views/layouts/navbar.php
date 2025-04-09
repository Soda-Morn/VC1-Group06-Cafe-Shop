<script src="views/assets/js/research.js"></script>
<script src="views/assets/js/purchaseitem.js" defer></script>
<script src="views/assets/js/stock_list.js" defer></script>

<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


// Check if user is logged in
$isLoggedIn = isset($_SESSION['admin_ID']);
$userName = $isLoggedIn ? ($_SESSION['name'] ?? 'Admin') : 'User';
$userEmail = $isLoggedIn ? ($_SESSION['email'] ?? 'admin@example.com') : 'user@example.com';
$profilePicture = $isLoggedIn ? ($_SESSION['profile_picture'] ?? '') : '';
?>
<div class="sidebar " data-background-color="#FFF8E7" data-active-color="dark">
  <div class="sidebar-logo ">
    <!-- Logo Header -->
    <div class="logo-header " data-background-color="pink">
      <a href="/" class="logo">
        <img
          src="../../views/assets/images/logo.png" alt="navbar brand"
          class="navbar-brand"
          height="60" />
      </a>
      <a href="form_order"></a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item">
          <a
            href="/"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="/order_menu"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-store  "></i>
            <p>Order Menu</p>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="/order_list"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-shopping-bag"></i>
            <p>Order Report</p>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="/stocklist"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-inbox"></i>
            <p>Stock List</p>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="/purchase_item_add"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-cart-arrow-down"></i>
            <p>Restock</p>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="/suppliers"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-user-tag"></i>
            <p>Supplier Info</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/Categories">
            <i class="fas fa-th-list"></i>
            <p>Categories</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="main-panel">
  <div class="main-header ">
    <div class="main-header-logo ">
      <!-- Logo Header -->
      <div class="logo-header " data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="views/assets/img/kaiadmin/logo_light.svg"
            alt="navbar brand"
            class="navbar-brand"
            height="20" />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav
      class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
      <div class="container-fluid">


        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
          <li
            class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
            <a
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-expanded="false"
              aria-haspopup="true">
              <i class="fa fa-search"></i>
            </a>
            <ul class="dropdown-menu dropdown-search animated fadeIn">
              <form class="navbar-left navbar-form nav-search">
                <div class="input-group">
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control" />
                </div>
              </form>
            </ul>
          </li>
          <!-- Topbar -->
          <div class="topbar">
            <div class="d-flex justify-content-between align-items-center">
              <div class="user-box">
                <!-- Language Selector -->
                <div class="language-selector d-inline-flex align-items-center">
                  <div class="dropdown">
                    <button class="btn  dropdown-toggle " type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <img id="flagIcon" src="https://flagcdn.com/w40/gb.png" alt="English Flag" class="me-1" style="width: 20px; height: 20px;">
                      <span id="languageText">English</span>
                    </button>
                    <ul class="dropdown-menu dropdown-user" id="dropdownMenu" aria-labelledby="languageDropdown" style="width: 20px;">
                      <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" data-lang="km">
                          <img src="https://flagcdn.com/w40/kh.png" alt="Khmer Flag" class="me-1" style="width: 20px; height: 20px;">
                          <span>ភាសាខ្មែរ</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- //card -->
          <li class="nav-item topbar-icon dropdown hidden-caret">
            <a class="nav-link" href="/orderCard" aria-expanded="false">

              <div class="cart-container">
                <span class="cart-icon"><i class="fas fa-shopping-cart"></i></span>

                <span class="badge-pill badge-danger count_cart" style="font-size: 10px; padding: 2px 5px;">

                  <?php
                  echo (!empty($_SESSION['cart']) && count($_SESSION['cart']) > 0)
                    ? array_sum(array_column($_SESSION['cart'], 'quantity'))
                    : '0';
                  ?>
                </span>
              </div>
            </a>
          </li>

          <!-- profile -->
          <li class="nav-item topbar-user dropdown hidden-caret">
            <a
              class="dropdown-toggle profile-pic"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-expanded="false">
              <div class="avatar-sm">
                <?php if (!empty($_SESSION['profile_picture'])): ?>
                  <img
                    src="/<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>"
                    alt="Profile"
                    class="avatar-img rounded-circle" />
                <?php else: ?>
                  <div class="avatar-img rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">
                    <?php echo strtoupper(substr($_SESSION['name'], 0, 1)); ?>
                  </div>
                <?php endif; ?>
              </div>
              <span class="profile-username">
                <span class="op-7">Hi,</span>
                <span class="fw-bold"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">
                    <div class="avatar-lg">
                      <?php if (!empty($_SESSION['profile_picture'])): ?>
                        <img
                          src="/<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>"
                          alt="Profile"
                          class="avatar-img rounded" />
                      <?php else: ?>
                        <div class="avatar-img rounded bg-primary text-white d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
                          <?php echo strtoupper(substr($_SESSION['name'], 0, 1)); ?>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="u-text">
                      <h4><?php echo htmlspecialchars($_SESSION['name']); ?></h4>
                      <p class="text-muted"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                      <div class="d-flex mt-2">
                        <a href="/Profile_info" class="btn btn-xs btn-secondary btn-sm me-2">View Profile</a>
                        <a href="/logout" class="btn btn-xs btn-danger btn-sm">Logout</a>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/Profile_info">
                    <i class="fas fa-user me-2"></i> My Profile
                  </a>
                  <a class="dropdown-item" href="/payment_upload">
                    <i class="fas fa-cog me-2"></i> Upload QR
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="/logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                  </a>
                </li>
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
  </div>

  <!-- Add this script at the bottom of navbar.php -->
  <!-- Add this script at the bottom of navbar.php -->
  <script>
    const collapseLinks = document.querySelectorAll('.nav-item > a[data-bs-toggle="collapse"]');

    collapseLinks.forEach(link => {
      link.addEventListener('click', function() {
        const caret = this.querySelector('.caret');
        const targetCollapse = this.nextElementSibling; // Assuming the collapse element is right after the link

        // Toggle caret icon direction
        caret.classList.toggle('down');

        // Toggle collapse visibility
        if (caret.classList.contains('down')) {
          targetCollapse.style.display = 'block'; // Show the collapsible element
        } else {
          targetCollapse.style.display = 'none'; // Hide the collapsible element
        }
      });
    });
    document.addEventListener('DOMContentLoaded', function() {
      // Handle sidebar menu toggles
      const sidebarMenuItems = document.querySelectorAll('.nav-item > a[data-bs-toggle="collapse"]');

      sidebarMenuItems.forEach(function(menuItem) {
        menuItem.addEventListener('click', function(e) {
          e.preventDefault();

          const targetId = this.getAttribute('href');
          const targetElement = document.querySelector(targetId);

          // Toggle the target element's visibility
          targetElement.classList.toggle('show');
          this.setAttribute('aria-expanded', targetElement.classList.contains('show'));

          // Close all other submenus
          sidebarMenuItems.forEach(function(item) {
            if (item !== menuItem) {
              const otherTargetId = item.getAttribute('href');
              const otherTargetElement = document.querySelector(otherTargetId);
              otherTargetElement.classList.remove('show');
              item.setAttribute('aria-expanded', 'false');
            }
          });
        });
      });

      // Handle header dropdowns
      const headerDropdowns = document.querySelectorAll('.topbar-nav .dropdown-toggle');

      headerDropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          const parent = this.closest('.dropdown');
          const isOpen = parent.classList.contains('show');

          // Close all other dropdowns first
          document.querySelectorAll('.topbar-nav .dropdown.show').forEach(function(openDropdown) {
            if (openDropdown !== parent) {
              openDropdown.classList.remove('show');
              openDropdown.querySelector('.dropdown-menu').classList.remove('show');
              openDropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
            }
          });

          // Toggle this dropdown
          if (isOpen) {
            parent.classList.remove('show');
            parent.querySelector('.dropdown-menu').classList.remove('show');
            this.setAttribute('aria-expanded', 'false');
          } else {
            parent.classList.add('show');
            parent.querySelector('.dropdown-menu').classList.add('show');
            this.setAttribute('aria-expanded', 'true');
          }
        });
      });

      // Close dropdowns when clicking outside
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
          document.querySelectorAll('.dropdown.show').forEach(function(dropdown) {
            dropdown.classList.remove('show');
            dropdown.querySelector('.dropdown-menu').classList.remove('show');
            dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
          });
        }
      });
    });
    document.addEventListener("DOMContentLoaded", function() {
      const currentLocation = window.location.pathname;
      const navLinks = document.querySelectorAll(".nav-item a");

      navLinks.forEach(link => {
        if (link.getAttribute("href") === currentLocation) {
          link.parentElement.classList.add("active");
        }
      });
    });
    document.addEventListener("DOMContentLoaded", function() {
      let navItems = document.querySelectorAll(".nav-item a");

      navItems.forEach((item) => {
        if (item.href === window.location.href) {
          item.classList.add("active");
        }
      });
    });
  </script>
  <style>
    .count_cart {
      position: absolute;
      top: 5px;
      right: 2px;
      background-color: #dc3545;
      color: white;
      padding: 7px 7px;
      border-radius: 50rem;
      /* pill shape */
      font-size: 14px;
      font-weight: bold;
      line-height: 1;
    }
    .collapse {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
      opacity: 0;
    }
    .collapse.show {
      max-height: 500px;
      opacity: 1;
    }
    .caret {
      transition: transform 0.3s ease;
    }
    /* .logo {
      width: 170px;
      display: flex;
      justify-content: center;

    }
    .logo-header {
      margin-top: 30px;
      margin-bottom: 15px;
    } */
  </style>
  <script src="views/assets/js/Language_options/navbar-o.js"></script>