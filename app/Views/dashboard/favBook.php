<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>My Booking</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <style>
        .bg-pastel-green {
            background-color: #e8fadf;
            border-color: #d4f5c3;
            color: #71dd37;
        }
        .bg-pastel-red {
            background-color: #ffe0db;
            border-color: #ffc5bb;
            color: #ff3e1d;
        }
    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
     <?php if (session()->has('isLoggedIn')): ?>
        <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="<?= base_url('menu') ?>" class="app-brand-link">
                <span class="app-brand-logo demo">
                <svg width="44" height="34" viewBox="0 0 44 34" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="44" height="34" fill="url(#pattern0_4032_190)"/>
                    <defs>
                    <pattern id="pattern0_4032_190" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_4032_190" transform="matrix(0.00430416 0 0 0.00609756 -0.00573888 0)"/>
                    </pattern>
                    <image id="image0_4032_190" width="235" height="164" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                    </defs>
                    </svg>
                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2">BorrowBud</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
          <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item">
            <a href="<?= site_url('menu') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Menu</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="<?= site_url('myRental') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx  bx-book-open"></i>
              <div data-i18n="Analytics">My Rental</div>
            </a>
          </li>
          <li class="menu-item active">
            <a href="<?= site_url('favBook') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx  bx-bookmark-heart"></i>
              <div data-i18n="Analytics">My Favourite</div>
            </a>
          </li>
        </ul>
        </aside>
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <form method="GET" action="<?= base_url('myRental') ?>" class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center" style="width: 400px;">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                    type="text"
                    name="search"
                    value="<?= esc($searchQuery ?? '') ?>"
                    class="form-control border-0 shadow-none"
                    placeholder="Search by rental ID, title, or status"
                    />
                </div>
                </form>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?= session()->get('profile_picture') ?>" alt class="w-px-40 h-40 rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?= session()->get('profile_picture') ?>" alt class="w-px-40 h-40 rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?= esc(substr(session()->get('fullName'), 0, 15)) ?><?= strlen(session()->get('fullName')) > 15 ? '...' : '' ?></span>
                            <small class="text-muted"><?= session()->get('userType') === 'admin' ? 'Admin' : 'Member' ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?= site_url('profile') ?>">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <form id="logout-form" action="<?= site_url('logout') ?>" method="get" style="display: none;">
                        <?= csrf_field() ?>
                      </form>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->
          <?php endif; ?>
          <!-- Content wrapper -->
          <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12 order-0 mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">My Favorites /</span> Books
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <?php if (!empty($favBooks)) : ?>
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    <?php foreach ($favBooks as $book): ?>
                                        <div class="col">
                                            <div class="card h-100 position-relative">
                                                <!-- Red Heart Icon - Click to remove -->
                                                <form method="POST" action="<?= base_url('remove-favorite/' . $book['bookId']) ?>" class="position-absolute top-0 end-0 m-2">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn p-0 border-0 bg-transparent" title="Remove from Favorites">
                                                        <i class="bi bi-heart-fill text-danger" style="font-size: 1.5rem;"></i>
                                                    </button>
                                                </form>

                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center mb-3">
                                                        <img src="<?= $book['book_cover'] ?>" alt="<?= $book['title'] ?>" class="rounded" height="200">
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div>
                                                            <h5 class="mb-0"><?= esc(strlen($book['title']) > 35 ? substr($book['title'], 0, 35) . '...' : $book['title']) ?></h5>
                                                            <small class="text-muted"><?= ucfirst($book['genre']) ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1 mb-2">
                                                        <h6 class="mb-0"><strong>Total Copies:</strong> <?= $book['totalCopies'] ?></h6>
                                                    </div>
                                                    <div class="down-content">
                                                        <span class="author"><strong>Author:</strong> <?= $book['author'] ?></span>
                                                        <br><br>
                                                        <div class="d-flex justify-content-center mb-3">
                                                        <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#courseModal<?= $book['bookId'] ?>">View More</button>
                                                        <a href="<?= base_url('rentnow/' . $book['bookId']) ?>" class="btn btn-primary">Rent Now</a>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="courseModal<?= $book['bookId'] ?>" tabindex="-1" aria-labelledby="courseModalLabel<?= $book['bookId'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="courseModalLabel<?= $book['bookId'] ?>"><?= $book['title'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center mb-3">
                                                            <img src="<?= $book['book_cover'] ?>" alt="<?= $book['title'] ?>" class="rounded" height="300" width="auto">
                                                        </div>
                                                        <p><strong>Genre:</strong> <?= ucfirst($book['genre']) ?></p>
                                                        <p><strong>Total Copies:</strong> <?= $book['totalCopies'] ?></p>
                                                        <p><strong>Author:</strong> <?= $book['author'] ?></p>
                                                        <p><strong>Description:</strong> <?= $book['description'] ?></p>
                                                        <p><strong>Rental Expiry :</strong> 5 days</p>
                                                        <p><strong>Available:</strong> <?= $book['availableCopies'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('rentnow/' . $book['bookId']) ?>" class="btn btn-primary">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-info text-center" role="alert">
                                    You have no favorite books yet.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
          <!-- / Content -->

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>