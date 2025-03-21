<script src="views/assets/js/research.js"></script>
<script src="views/assets/js/purchaseitem.js" defer></script>




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
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="/" class="logo">
        <img
          src="../../views/assets/img/kaiadmin/logo_light.svg"
          alt="navbar brand"
          class="navbar-brand"
          height="20" />
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
        <li class="nav-item active">
          <a
            href="/"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Products</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="/product_list">
                  <span class="sub-item">Product List</span>
                </a>
              </li>
              <li>
                <a href="components/buttons.html">
                  <span class="sub-item">Product Add</span>
                </a>
              </li>
              <li>
                <a href="/product_detail">
                  <span class="sub-item">Product Detail</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayouts">
            <i class="fas fa-th-list"></i>
            <p>Categories</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="sidebar-style-2.html">
                  <span class="sub-item">Category List</span>
                </a>
              </li>
              <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Category Add</span>
                </a>
              </li>
              <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Category Edite</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Orders</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="/order_list">
                  <span class="sub-item">Order List</span>
                </a>
              </li>
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Order Detail</span>
                </a>
              </li>
              <li>
                <a href="/order_menu">
                  <span class="sub-item">Order Menu</span>
                </a>
              </li>
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Order History</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Inventory</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="/stocklist">
                  <span class="sub-item">Stock List</span>
                </a>
              </li>
              <li>
                <a href="/purchase_item_add">
                  <span class="sub-item">Purchase Item Add</span>
                </a>
              </li>
              <li>
                <a href="/purchase">
                  <span class="sub-item">Purchase History</span>
                </a>
              </li>
              <li>
                <a href="/suppliers">
                  <span class="sub-item">Suplier info</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#maps">
            <i class="fas fa-user-friends"></i>
            <p>Customer</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="maps">
            <ul class="nav nav-collapse">
              <li>
                <a href="maps/googlemaps.html">
                  <span class="sub-item">Customer List</span>
                </a>
              </li>
            </ul>
          </div>
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
        <nav
          class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
          <div class="input-group">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-search pe-1">
                <i class="fa fa-search search-icon"></i>
              </button>
            </div>
            <input
              type="text"
              placeholder="Search ..."
              class="form-control" />
          </div>
        </nav>

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
              <i class="fas fa-layer-group"></i>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap dropdowns
    var dropdownElementList = document.querySelectorAll('.dropdown-toggle');
    dropdownElementList.forEach(function (dropdownToggleEl) {
        new bootstrap.Dropdown(dropdownToggleEl);
    });

    // Ensure profile dropdown toggles correctly
    var profileDropdown = document.querySelector('.topbar-user .dropdown-toggle');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var dropdown = bootstrap.Dropdown.getOrCreateInstance(this);
            dropdown.toggle();
        });
    }
});
</script>
