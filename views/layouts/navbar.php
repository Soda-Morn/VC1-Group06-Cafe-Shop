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
<div class="sidebar" data-background-color="#FFF8E7" data-active-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="pink">
      <a href="/" class="logo">
        <img
          src="../../views/assets/images/logo.png" alt="navbar brand"
          class="navbar-brand"
          height="90" />
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
  <div class="main-header">
    <div class="main-header-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
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
          <li class="nav-item topbar-icon dropdown hidden-caret">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="messageDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
              <i class="fa fa-envelope"></i>
            </a>
            <ul
              class="dropdown-menu messages-notif-box animated fadeIn"
              aria-labelledby="messageDropdown">
              <li>
                <div
                  class="dropdown-title d-flex justify-content-between align-items-center">
                  Messages
                  <a href="#" class="small">Mark all as read</a>
                </div>
              </li>
              <li>
                <div class="message-notif-scroll scrollbar-outer">
                  <div class="notif-center">
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="views/assets/img/jm_denis.jpg"
                          alt="Img Profile" />
                      </div>
                      <div class="notif-content">
                        <span class="subject">Jimmy Denis</span>
                        <span class="block"> How are you ? </span>
                        <span class="time">5 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="assets/img/chadengle.jpg"
                          alt="Img Profile" />
                      </div>
                      <div class="notif-content">
                        <span class="subject">Chad</span>
                        <span class="block"> Ok, Thanks ! </span>
                        <span class="time">12 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="assets/img/mlane.jpg"
                          alt="Img Profile" />
                      </div>
                      <div class="notif-content">
                        <span class="subject">Jhon Doe</span>
                        <span class="block">
                          Ready for the meeting today...
                        </span>
                        <span class="time">12 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="assets/img/talha.jpg"
                          alt="Img Profile" />
                      </div>
                      <div class="notif-content">
                        <span class="subject">Talha</span>
                        <span class="block"> Hi, Apa Kabar ? </span>
                        <span class="time">17 minutes ago</span>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              <li>
                <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item topbar-icon dropdown hidden-caret">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="notifDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
              <i class="fa fa-bell"></i>
              <span class="notification">4</span>
            </a>
            <ul
              class="dropdown-menu notif-box animated fadeIn"
              aria-labelledby="notifDropdown">
              <li>
                <div class="dropdown-title">
                  You have 4 new notification
                </div>
              </li>
              <li>
                <div class="notif-scroll scrollbar-outer">
                  <div class="notif-center">
                    <a href="#">
                      <div class="notif-icon notif-primary">
                        <i class="fa fa-user-plus"></i>
                      </div>
                      <div class="notif-content">
                        <span class="block"> New user registered </span>
                        <span class="time">5 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-icon notif-success">
                        <i class="fa fa-comment"></i>
                      </div>
                      <div class="notif-content">
                        <span class="block">
                          Rahmad commented on Admin
                        </span>
                        <span class="time">12 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="assets/img/profile2.jpg"
                          alt="Img Profile" />
                      </div>
                      <div class="notif-content">
                        <span class="block">
                          Reza send messages to you
                        </span>
                        <span class="time">12 minutes ago</span>
                      </div>
                    </a>
                    <a href="#">
                      <div class="notif-icon notif-danger">
                        <i class="fa fa-heart"></i>
                      </div>
                      <div class="notif-content">
                        <span class="block"> Farrah liked Admin </span>
                        <span class="time">17 minutes ago</span>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              <li>
                <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item topbar-icon dropdown hidden-caret">
            <a
              class="nav-link"
              href="/orderCard"
              aria-expanded="false">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>


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
                        <a href="/profile" class="btn btn-xs btn-secondary btn-sm me-2">View Profile</a>
                        <a href="/logout" class="btn btn-xs btn-danger btn-sm">Logout</a>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user me-2"></i> My Profile
                  </a>
                  <a class="dropdown-item" href="/profile#settings">
                    <i class="fas fa-cog me-2"></i> Account Settings
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
    document.addEventListener("DOMContentLoaded", function () {
  const currentLocation = window.location.pathname;
  const navLinks = document.querySelectorAll(".nav-item a");

  navLinks.forEach(link => {
    if (link.getAttribute("href") === currentLocation) {
      link.parentElement.classList.add("active");
    }
  });
});
document.addEventListener("DOMContentLoaded", function () {
  let navItems = document.querySelectorAll(".nav-item a");

  navItems.forEach((item) => {
    if (item.href === window.location.href) {
      item.classList.add("active");
    }
  });
});


  </script>
  <style>
    .collapse {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
      opacity: 0;
    }

    .collapse.show {
      max-height: 500px;
      /* Adjust as needed */
      opacity: 1;
    }

    /* Caret animation */
    .caret {
      transition: transform 0.3s ease;
    }

    .caret.down {
      transform: rotate(180deg);
    }
    .nav-item.active a {
  font-weight: bold;
  color: #ffffff; /* Adjust color as needed */
}

    .logo{
      width: 170px;
      display: flex;
      justify-content: center;

    }
    .logo-header{
      margin-top: 30px;
      margin-bottom: 15px;
    }
    .nav-item a.active {
  font-weight: bold;
  color: #000000; /* Black text */
  background-color: #ff5722; /* Highlight */
  border-radius: 5px;
  padding: 8px 12px;
}

  </style>