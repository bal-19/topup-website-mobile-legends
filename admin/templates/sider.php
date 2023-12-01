<?php
session_start();
// print_r($_SESSION);
// die();
if (!isset($_SESSION['id_admin'])) {
  header("Location: http://localhost/ZeeShop/admin/auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="http://localhost/ZeeShop/image/logo/zeeshop-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="http://localhost/ZeeShop/admin/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
  <title>ZeeShop - Dashboard</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap');

    :root {
      --header-height: 3rem;
      --nav-width: 68px;
      --first-color: #212529;
      --first-color-light: #AFA5D9;
      --white-color: #F7F6FB;
      --red-color: #dc3545;
      --young-red-color: #ff6b6b;
      --body-font: 'Rubik', sans-serif;
      --normal-font-size: 1rem;
      --z-fixed: 100
    }

    *,
    ::before,
    ::after {
      box-sizing: border-box
    }

    body {
      position: relative;
      margin: var(--header-height) 0 0 0;
      padding: 0 1rem;
      font-family: var(--body-font);
      font-size: var(--normal-font-size);
      transition: .3s
    }

    a {
      text-decoration: none
    }

    .header {
      width: 100%;
      height: var(--header-height);
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1rem;
      background-color: #fff;
      z-index: var(--z-fixed);
      transition: .3s
    }

    .header_toggle {
      color: var(--first-color);
      font-size: 1.5rem;
      cursor: pointer
    }

    .img-small {
      width: 200px;
      height: auto;
    }

    .l-navbar {
      position: fixed;
      top: 0;
      left: -30%;
      width: var(--nav-width);
      height: 100vh;
      background-color: var(--first-color);
      padding: .5rem 1rem 0 0;
      transition: .3s;
      z-index: var(--z-fixed)
    }

    .nav {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow: hidden
    }

    .nav_logo,
    .nav_link,
    .text_danger {
      display: grid;
      grid-template-columns: max-content max-content;
      align-items: center;
      column-gap: 1rem;
      padding: .5rem 0 .5rem 1.5rem
    }

    .nav_logo {
      margin-bottom: 2rem
    }

    .nav_logo-icon {
      font-size: 1.25rem;
      color: var(--white-color)
    }

    .nav_logo-name {
      margin-left: -8px;
      color: var(--white-color);
      font-weight: 700
    }

    .text_danger {
      position: relative;
      color: var(--red-color);
      margin-bottom: 1.5rem;
      transition: .3s
    }

    .text_danger:hover {
      color: var(--young-red-color)
    }

    .nav_link {
      position: relative;
      color: var(--first-color-light);
      margin-bottom: 1rem;
      transition: .3s
    }

    .nav_link:hover {
      color: var(--white-color)
    }

    .nav_icon {
      font-size: 1.25rem
    }

    .show {
      left: 0
    }

    .body-pd {
      padding-left: calc(var(--nav-width) + 1rem)
    }

    .active {
      color: var(--white-color)
    }

    .active::before {
      content: '';
      position: absolute;
      left: 0;
      width: 2px;
      height: 32px;
      background-color: var(--white-color)
    }

    .header_img {
      margin-left: -10px;
      width: 35px;
      height: 35px;
      display: flex;
      justify-content: center;
      border-radius: 50%;
      overflow: hidden
    }

    .header_img img {
      width: 40px
    }

    .header_img {
      width: 40px;
      height: 40px
    }

    .header_img img {
      width: 45px
    }

    .height-100 {
      height: 100vh
    }

    .img-product {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    .display-4 {
      font-weight: bold;
    }

    .card-body-icon {
      position: absolute;
      z-index: 0;
      top: 25px;
      right: 25px;
      opacity: 0.4;
      font-size: 80px;
    }
    


    @media screen and (min-width: 768px) {
      body {
        margin: calc(var(--header-height) + 1rem) 0 0 0;
        padding-left: calc(var(--nav-width) + 2rem)
      }

      .header {
        height: calc(var(--header-height) + 1rem);
        padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
      }

      .l-navbar {
        left: 0;
        padding: 1rem 1rem 0 0
      }

      .show {
        width: calc(var(--nav-width) + 156px)
      }

      .body-pd {
        padding-left: calc(var(--nav-width) + 188px)
      }
    }
  </style>
</head>


<body id="body-pd" class="body-pd">
  <header class="header body-pd" id="header">
    <div class="header_toggle">
      <i class="fas fa-bars" id="header-toggle" aria-hidden="true"></i>
    </div>
  </header>
  <div class="l-navbar show" id="nav-bar">
    <nav class="nav">
      <div>
        <a href="http://localhost/ZeeShop/admin" class="nav_logo">
          <div class="header_img">
            <img src="http://localhost/ZeeShop/image/logo/zeeshop-logo.png" alt="Logo" class="">
          </div>
          <span class="nav_logo-name">ZeeShop</span>
        </a>
        <div class="nav_list">

          <?php
          $currentLocation = $_SERVER['REQUEST_URI'];
          ?>

          <a href="http://localhost/ZeeShop/admin" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/') {
                                                                              echo 'active';
                                                                            } ?>">
            <i class="fa-solid fa-gauge fa-lg nav_icon"></i>
            <span class="nav_name">Dashboard</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/account" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/account/') {
                                                                                                    echo 'active';
                                                                                                  } ?>">
            <i class="fa-solid fa-users fa-lg nav_icon"></i>
            <span class="nav_name">Users</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/product" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/product/') {
                                                                                                    echo 'active';
                                                                                                  } ?>">
            <i class='fa-solid fa-box fa-lg nav_icon'></i>
            <span class="nav_name">Service</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/data-product" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/data-product/') {
                                                                                                        echo 'active';
                                                                                                      } ?>">
            <i class="fa-solid fa-boxes-stacked fa-lg nav_icon"></i>
            <span class="nav_name">Data Service</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/transaction" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/transaction/') {
                                                                                                        echo 'active';
                                                                                                      } ?>">
            <i class='fa-solid fa-receipt fa-lg nav_icon'></i>
            <span class="nav_name">Transaction</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/payment" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/payment/') {
                                                                                                    echo 'active';
                                                                                                  } ?>">
            <i class='fa-solid fa-credit-card fa-lg nav_icon'></i>
            <span class="nav_name">Payment</span>
          </a>
          <a href="http://localhost/ZeeShop/admin/administrator/slider" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/slider/') {
                                                                                                    echo 'active';
                                                                                                  } ?>">
            <i class='fa-solid fa-sliders fa-lg nav_icon'></i>
            <span class="nav_name">Slider</span>
          </a>
          <!-- <a href="http://localhost/ZeeShop/admin/administrator/settings" class="nav_link  <?php if ($currentLocation == '/ZeeShop/admin/administrator/settings/') {
                                                                                                      echo 'active';
                                                                                                    } ?>">
            <i class='fa-solid fa-gear fa-lg nav_icon'></i>
            <span class="nav_name">Settings</span>
          </a> -->
        </div>
      </div>
      <form action="http://localhost/ZeeShop/proses/logout.php" method="post">
        <button type="submit" name="logoutAdmin" class="btn btn-default text_danger">
          <i class='fa-solid fa-right-from-bracket fa-lg nav_icon'></i>
          <span class="nav_name">Logout</span>
        </button>
      </form>
    </nav>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
  //sidebar
  document.addEventListener("DOMContentLoaded", function(event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
      const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId);

      if (toggle && nav && bodypd && headerpd) {
        toggle.addEventListener("click", () => {
          nav.classList.toggle("show");
          bodypd.classList.toggle("body-pd");
          headerpd.classList.toggle("body-pd");
        });
      }
    };

    showNavbar("header-toggle", "nav-bar", "body-pd", "header");

    const linkColor = document.querySelectorAll(".nav_link");

    function colorLink() {
      if (linkColor) {
        linkColor.forEach((l) => l.classList.remove("active"));
        this.classList.add("active");
      }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));
    const currentLocation = window.location.href;
    const navLinks = document.querySelectorAll(".nav_link");

    navLinks.forEach((link) => {
      if (link.href === currentLocation) {
        link.classList.add("active");
      }
    });
  });

</script>

</html>