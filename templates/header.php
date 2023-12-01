<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "dbtopup");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="http://localhost/ZeeShop/image/logo/zeeshop-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="http://localhost/ZeeShop/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <title>ZeeShop - Top Up Dan Joki Game Mobile Legends Termurah Dan Tercepat</title>
  <style>
    * {
      font-family: 'Rubik', sans-serif;
    }

    .btn-circle {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      padding: 0;
    }

    .dropdown-menu {
      background-color: #0D0C1D;
    }

    .dropdown-item {
      color: #cbd3da;
    }

    .dropdown-menu a.dropdown-item:hover {
      background-color: #0D0C1D;
      color: #f8f9fa;
    }

    .bg-darkblue {
      background-color: #2a2d43;
    }

    .active:focus {
      background-color: #6c757d;
    }

    .input-group-text {
      background-color: inherit;
    }

    .rounded-circle-img {
      width: 85px;
      height: 85px;
      background-size: cover;
      background-position: center;
      border-radius: 10%;
    }

    .capitalize-text {
      text-transform: capitalize;
    }

    .btn-bulat {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      padding: 0;
    }

    .btn-service {
      position: fixed;
      bottom: 25px;
      right: 15px;
      background-color: #0dc143;
    }

    .btn-service:hover {
      background-color: #0d8a12;
    }
  </style>
</head>

<body class="custom-font bg-darkblue">
  <header>
    <nav class="navbar navbar-expand-sm bg-dark fixed-top shadow-lg" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="http://localhost/ZeeShop/">
          <img src="http://localhost/ZeeShop/image/logo/zeeshop-transformed.png" alt="Logo" width="78" height="50" class="d-inline-block align-text-top img-brand me-4">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-bs-theme="light">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link me-1" aria-current="page" href="http://localhost/ZeeShop/">
                <i class="fa fa-home" aria-hidden="true"></i> Beranda
              </a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <?php
            if (isset($_SESSION['no_handphone'])) {
            ?>
              <a href="http://localhost/ZeeShop/account" class="btn btn-secondary btn-circle d-flex justify-content-center align-items-center">
                <?php
                $id = $_SESSION['id'];
                $hasil = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
                $row = mysqli_fetch_assoc($hasil);
                $nama = $row['nama'];
                $nama_depan = explode(" ", $nama)[0];
                $huruf_depan = substr($nama_depan, 0, 1);
                echo "<div class='fs-4 capitalize-text'>" . $huruf_depan . "</div>";

                ?>
              </a>
            <?php
            } else {
            ?>
              <li class="nav-item">
                <a href="http://localhost/ZeeShop/account/auth/login.php" class="btn btn-light">
                  Login
                </a>
                <a href="http://localhost/ZeeShop/account/auth/register.php" class="btn btn-outline-light">
                  Daftar
                </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>