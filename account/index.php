<?php
include '../templates/header.php';
if (!isset($_SESSION['id'])) {
  header("Location: auth/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Profil</title>
  <?php
  require '../koneksi/koneksi.php';
  $result = mysqli_query(koneksi(), "SELECT * FROM user WHERE id_user = '" . $_SESSION['id'] . "'");
  $row = mysqli_fetch_assoc($result);
  $nama = $row['nama'];
  $no_handphone = $row['no_handphone'];
  ?>

<body>
  <div class="container-fluid mt-5 pt-5">
    <div class="row">
      <nav id="sidebar" class="bg-dark col-md-3 col-lg-2 d-md-block border border-start-0 border-2 border-secondary shadow-lg sidebar">
        <div class="position-sticky">
          <ul class="nav flex-column">
            <li class="nav-item mt-4">
              <a class="nav-link active text-light" href="../account">
                <div>
                  <i class="fa-solid fa-user"></i> Profile
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="transaction.php">
                <div>
                  <i class="fa-solid fa-money-bill"></i> Transaksi
                </div>
              </a>
            </li>
            <li class="nav-item border-top border-secondary border-2 mt-3">
              <a class="nav-link text-danger" href="../proses/logout.php">
                <div class="mt-1">
                  <i class="fa-solid fa-right-from-bracket"></i> Logout
                </div>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-lg-12 ms-1 mt-2 mb-2">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row">
              <div class="col">
                <div class="card bg-dark border border-secondary border-2 shadow-lg text-light">
                  <div class="card-header border-bottom border-secondary">
                    <h4 class="card-title mt-2">Edit Profile</h4>
                  </div>
                  <div class="card-body">
                    <div id="userData">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group mb-3">
                            <label for="userId">Nama</label>
                            <input class="form-control" value="<?php echo $nama ?>" placeholder="Masukkan Nama" type="text" name="nama" id="userId">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group mb-3">
                            <label for="serverid">No. Handphone</label>
                            <input class="form-control" value="<?php echo $no_handphone ?>" placeholder="Masukkan No. Handphone" type="text" minlength="12" maxlength="12" name="no_handphone" id="serverid" disabled><small class="text-warning">Hubungi Admin jika anda ingin mengubah No. Handphone anda</small>
                          </div>
                        </div>
                        <div class="form-group mb-1">
                          <input type="submit" value="Ubah Profile" name="ubahProfileUser" class="btn btn-secondary btn-block">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </form>
          <form action="../proses/edit-user.php" method="post">
            <div class="row mt-3">
              <div class="col">
                <div class="card bg-dark border border-secondary border-2 shadow-lg text-light">
                  <div class="card-header border-bottom border-secondary">
                    <h4 class="card-title mt-2"> Edit Password</h4>
                  </div>
                  <div class="card-body">
                    <div class="row row-cols row-cols-md">
                      <div class="form-group mb-3">
                        <?php
                        if (array_key_exists('error', $_GET)) {
                          echo "<div class='alert alert-danger' role='alert'>
                                      Password lama tidak sama
                                    </div>";
                        } else if (array_key_exists('err', $_GET)) {
                          echo "<div class='alert alert-danger' role='alert'>
                                      Password tidak sama
                                    </div>";
                        }
                        ?>
                        <label for="userId">Password Lama</label>
                        <input class="form-control" placeholder="Masukkan Password Lama" type="password" name="passLama">
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group mb-1">
                          <label for="userId">Password Baru</label>
                          <input class="form-control" placeholder="Masukkan Password Baru" type="password" name="passBaru" minlength="8" maxlength="12">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <label for="userId">Konfirmasi Password Baru</label>
                        <input class="form-control" placeholder="Masukkan Konfirmasi Password Baru" type="password" name="konfirmPass" minlength="8" maxlength="12">
                      </div>
                      <small class="text-warning">Password minimal memilki 8 karakter</small>
                      <div class="form-group mt-2 mb-3">
                        <input type="submit" value="Ubah Password" name="ubahPassUser" class="btn btn-secondary btn-block">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  </main>
  </div>
  </div>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../crud/user.php';
  if (isset($_POST['ubahProfileUser'])) {
    $id_user = $_SESSION['id'];
    $nama = $_POST['nama'];

    $hasil = editUser($id_user, $nama);
    if ($hasil != 0) {
      echo "<script type='text/javascript'>
            alert('Berhasil di Edit');
            window.location='../account';  
        </script>";
    } else {
      echo "<script type='text/javascript'>
            alert('Gagal di Edit');
            window.location='../account';  
        </script>";
    }
  }
}
include '../templates/footer.php';
?>

</html>