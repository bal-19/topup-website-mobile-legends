<!DOCTYPE html>
<html lang="en">
<?php
include "../../koneksi/koneksi.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/ZeeShop/image/logo/zeeshop-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="http://localhost/ZeeShop/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>ZeeShop - Login</title>
    <style>
        * {
            font-family: 'Rubik', sans-serif;
        }

        .bg-darkblue {
            background-color: #2a2d43;
        }
    </style>
</head>

<body>
    <div class="bg-darkblue text-light">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-dark shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                    <div class="featured-image">
                        <img src="../../image/logo/zeeshop-transformed.png" class="d-lg-block d-none" style="width: 300px;">
                    </div>
                </div>

                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <form action="../../proses/login.php" method="post">
                            <div class="header-text mb-4">
                                <h2>Login</h2>
                            </div>
                            <?php
                            if (array_key_exists('error', $_GET)) {
                                echo "
                <div class='alert alert-danger' role='alert'>
                  Salah Password atau Username
                </div>
              ";
                            }
                            ?>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control form-control-lg bg-light fs-6" id="floatingInput" name="no_handphone" placeholder="Masukkan No. WhatsApp" required>
                                <label for="floatingInput" class="text-dark">No. WhatsApp</label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="password" class="form-control form-control-lg bg-light fs-6" id="floatingInput" name="password" placeholder="Masukkan Password" minlength="8" required>
                                <label for="floatingInput" class="text-dark">Password</label>
                            </div>
                            <div class="text-warning"><p>Password minimal memiliki 8 karakter</p></div>

                            <div class="input-group mt-3 mb-3">
                                <button type="submit" name="loginUser" class="btn btn-lg btn-secondary w-100 fs-6">Login</button>
                            </div>
                            <div class="row">
                                <small>Tidak punya akun? <a href="register.php">Daftar</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/5af18ac0fc.js" crossorigin="anonymous"></script>

</html>