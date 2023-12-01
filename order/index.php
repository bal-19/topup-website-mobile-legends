<!DOCTYPE html>
<html lang="en">
<?php
$kategori = $_GET['c'];
$id_produk = $_GET['id'];
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - <?php echo $kategori ?></title>

  <?php
  include '../templates/header.php';
  ?>

  <style>
    .image-container {
      position: relative;
      display: inline-block;
      overflow: hidden;
    }

    .image-container::after {
      content: url('http://www.w3.org/2000/svg');
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 50%;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
    }

    .btn-check:checked+.btn-light::before,
    .btn-light:checked::before {
      content: '\2022';
      color: green;
      position: absolute;
      top: 10px;
      right: 2px;
      font-size: 50px;
      line-height: 0;
    }
  </style>
</head>
<?php
$sql_payment = "SELECT * FROM pembayaran";
$cek_payment = mysqli_query($koneksi, $sql_payment);
$jml_payment = mysqli_num_rows($cek_payment);

$sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
$cek = mysqli_query($koneksi, $sql);
$jml = mysqli_num_rows($cek);

$sql_data = "SELECT * FROM data_produk WHERE id_produk='$id_produk'";
$cek_data = mysqli_query($koneksi, $sql_data);
$jml_data = mysqli_num_rows($cek_data);
?>

<?php
if ($kategori == 'Topup') {
  if ($jml > 0) {
    $result = mysqli_query($koneksi, $sql);
    $hasil = 0;
    $row = mysqli_fetch_assoc($result);
    $id_produk = $row['id_produk'];
    $nama_produk = $row['nama'];
    $gambar_produk = $row['gambar'];
    $kategori = $row['genre'];
    $desc_produk = $row['deskripsi'];
?>

    <body class="custom-font">
      <div class="container mt-5 pt-5">
        <div class="image-container">
        </div>
        <form action="../proses/topup.php?id=<?= $id_produk ?>&&ctg=<?= $kategori ?>" method="post">
          <div class="row">
            <div class="col-lg-4 mt-2 mb-2">
              <div class="row">
                <div class="col-12">
                  <div class="card bg-dark shadow-lg">
                    <div class="card-body">
                      <img src="data:../image/product/;base64,<?php echo base64_encode($gambar_produk) ?>" alt="<?php echo $nama_produk ?>" class="shadow rounded bg-dark mx-auto mt-3 mb-2 d-lg-block d-none" width="200" />
                      <div class="row">
                        <div class="col text-light mt-3">
                          <h3><?php echo $nama_produk ?></h3>
                          <p><?php echo $desc_produk ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 mt-2 mb-2">
              <div class="row">
                <div class="col">
                  <div class="card bg-dark shadow-lg text-light">
                    <div class="card-header border-bottom border-secondary">
                      <h4 class="card-title mt-2"><span class="badge bg-secondary">1</span> Masukkan User ID</h4>
                    </div>
                    <div class="card-body">
                      <div id="userData">
                        <div class="row row-cols row-cols-md">
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="userId">User ID</label>
                              <input class="form-control" placeholder="Masukkan User ID" type="text" name="userid" id="userId" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Server ID</label>
                              <input class="form-control" placeholder="Masukkan Server ID" type="text" name="serverid" id="serverid" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">2</span>
                            Pilih Nominal Top Up
                          </h4>
                        </div>
                        <div class="card-body">
                          <select class="form-select form-select mb-3" name="nominal" onchange="getData()" aria-label="Large select example" id="waktuSelect">
                            <option selected>Silahkan memilih diamond yang anda inginkan</option>
                            <?php
                            if ($jml_data > 0) {
                              $result_data = mysqli_query($koneksi, $sql_data);
                              while ($row_data = mysqli_fetch_assoc($result_data)) {
                                $id_data_produk = $row_data['id_data_produk'];
                                $id_produk = $row_data['id_produk'];
                                $nama_data = $row_data['nama'];
                                $harga_data = $row_data['harga_produk'];

                                echo '<option value="' . $id_data_produk . '">' . $nama_data . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">3</span>
                            Pilih Metode Pembayaran
                          </h4>
                        </div>
                        <div class="card-body">
                          <div class="list-group">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" name="pembayaran" value="" id="btnradio1" autocomplete="off" required>
                              <label class="btn btn-light text-start" for="btnradio1">
                                <div class="fw-bold">E-Wallet</div>
                                <div id="harga"></div>

                                <?php
                                if ($jml_payment > 0) {
                                  $result_payment = mysqli_query($koneksi, $sql_payment);
                                  while ($row_payment = mysqli_fetch_assoc($result_payment)) {
                                    $id_payment = $row_payment['id_pembayaran'];
                                    $nama_payment = $row_payment['nama_pembayaran'];
                                    $gambar_payment = $row_payment['gambar'];
                                    // $biaya_admin = $row_payment['biaya_admin'];

                                    echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                                  }
                                }
                                ?>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">4</span>
                            Beli
                          </h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group mb-3">
                            <label for="userId">Masukkan Nomor WhatsApp</label>
                            <?php
                            if(isset($_SESSION['no_handphone'])) {
                            ?>
                            <input class="form-control" placeholder="08xxxxxxxx" type="text" name="handphone" value="<?= $_SESSION['no_handphone'] ?>" required>
                            <?php
                            } else {
                            ?>
                            <input class="form-control" placeholder="08xxxxxxxx" type="text" name="handphone" required>
                            <?php
                            }
                            ?>
                            <small class="text-warning mt-4">Pastikan data milik anda sudah terisi dengan benar</small><br>
                            <input type="submit" value="Topup" name="topup" class="mt-3 btn btn-secondary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </body>
  <?php
  } else {
    echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Error 404</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
  }
} elseif ($kategori == 'Joki') {
  if ($jml > 0) {
    $result = mysqli_query($koneksi, $sql);
    $hasil = 0;
    $row = mysqli_fetch_assoc($result);
    $id_produk = $row['id_produk'];
    $nama_produk = $row['nama'];
    $gambar_produk = $row['gambar'];
    $kategori = $row['genre'];
    $desc_produk = $row['deskripsi'];

  ?>

    <body class="custom-font">
      <div class="container mt-5 pt-5">
        <div class="image-container">
        </div>
        <form action="../proses/topup.php?id=<?= $id_produk ?>&&ctg=<?= $kategori ?>" method="post">
          <div class="row">
            <div class="col-lg-4 mt-2 mb-2">
              <div class="row">
                <div class="col-12">
                  <div class="card bg-dark shadow-lg">
                    <div class="card-body">
                      <img src="data:../image/product/;base64,<?php echo base64_encode($gambar_produk) ?>" alt="<?php echo $nama_produk ?>" class="shadow rounded bg-dark mx-auto mt-3 mb-2 d-lg-block d-none" width="200" />
                      <img src="../image/wp/wp_ling.jpg" alt class="shadow rounded bg-dark mx-auto mt-3 mb-2 d-lg-block d-none" width="150">
                      <div class="row">
                        <div class="col text-light mt-3">
                          <h3><?php echo $nama_produk ?></h3>
                          <p><?php echo $desc_produk ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 mt-2 mb-2">
              <div class="row">
                <div class="col">
                  <div class="card text-light bg-dark shadow-lg">
                    <div class="card-header border-bottom border-secondary">
                      <h4 class="card-title mt-2">
                        <span class="badge bg-secondary">1</span>
                        Masukkan Data
                      </h4>
                    </div>
                    <div class="card-body">
                      <div id="userData">
                        <div class="row row-cols row-cols-md">
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="userId">Email / No HP</label>
                              <input class="form-control" placeholder="Masukkan Email / No HP dari akun Mobile Legends" type="text" name="email" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Password</label>
                              <input class="form-control" placeholder="Masukkan Password dari akun Mobile Legends" type="password" name="password" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Hero</label>
                              <input class="form-control" placeholder="Request hero max 3. ex: Chou, Hanzo, Akai" type="text" name="hero" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Catatan</label>
                              <textarea class="form-control" placeholder="Catatan untuk penjoki" type="text" name="catatan" rows="1"></textarea>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">User Id Dan Nickname</label>
                              <input class="form-control" placeholder="ex: 12345678, Lemonaru" type="text" name="userid" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Total Pembelian</label>
                              <input class="form-control" placeholder="Masukkan total pembelian. ex: 1, 2, 10" type="number" name="total_pembelian" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mb-3">
                              <label for="serverid">Login Via</label>
                              <select class="form-select mb-3" name="login_via" aria-label="Default select example">
                              <option selected>Pilih metode login</option>
                                <option value="Moonton">Moonton</option>
                                <option value="Google">Google Play</option>
                                <option value="Facebook">Facebook</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">2</span>
                            Pilih Nominal
                          </h4>
                        </div>
                        <div class="card-body">
                          <select class="form-select form-select mb-3" name="nominal" onchange="getData()" aria-label="Large select example" id="waktuSelect">
                            <option selected>Silahkan memilih nominal yang anda inginkan</option>
                            <?php
                            if ($jml_data > 0) {
                              $result_data = mysqli_query($koneksi, $sql_data);
                              while ($row_data = mysqli_fetch_assoc($result_data)) {
                                $id_data_produk = $row_data['id_data_produk'];
                                $id_produk = $row_data['id_produk'];
                                $nama_data = $row_data['nama'];
                                $harga_data = $row_data['harga_produk'];

                                echo '<option value="' . $id_data_produk . '">' . $nama_data . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">3</span>
                            Pilih Metode Pembayaran
                          </h4>
                        </div>
                        <div class="card-body">
                          <div class="list-group">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" name="pembayaran" value="" id="btnradio1" autocomplete="off" required>
                              <label class="btn btn-light text-start" for="btnradio1">
                                <div class="fw-bold">E-Wallet</div>
                                <div id="harga"></div>

                                <?php
                                if ($jml_payment > 0) {
                                  $result_payment = mysqli_query($koneksi, $sql_payment);
                                  while ($row_payment = mysqli_fetch_assoc($result_payment)) {
                                    $id_payment = $row_payment['id_pembayaran'];
                                    $nama_payment = $row_payment['nama_pembayaran'];
                                    $gambar_payment = $row_payment['gambar'];
                                    // $biaya_admin = $row_payment['biaya_admin'];

                                    echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                                  }
                                }
                                ?>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="card text-light bg-dark shadow-lg">
                        <div class="card-header border-bottom border-secondary">
                          <h4 class="card-title mt-2">
                            <span class="badge bg-secondary">4</span>
                            Beli
                          </h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group mb-3">
                            <label for="userId">Masukkan Nomor WhatsApp</label>
                            <?php
                            if(isset($_SESSION['no_handphone'])) {
                            ?>
                            <input class="form-control" placeholder="08xxxxxxxx" type="text" name="handphone" value="<?= $_SESSION['no_handphone'] ?>" required>
                            <?php
                            } else {
                            ?>
                            <input class="form-control" placeholder="08xxxxxxxx" type="text" name="handphone" required>
                            <?php
                            }
                            ?>
                            <small class="text-warning mt-4">Pastikan data milik anda sudah terisi dengan benar</small><br>
                            <input type="submit" value="Order" name="order" class="mt-3 btn btn-secondary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </body>
<?php
  } else {
    echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Error 404</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
  }
} else {
  echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Error 404</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
}
include '../templates/footer.php';
?>

<script>
  function getData() {
    fetch("../proses/data-product.php?getdata").then(res => {
      res.json().then(tes => {
        hasil = tes.filter(a => a[0] == document.getElementById("waktuSelect").value)
        const formattedCurrency = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR'
        }).format(hasil[0][3]);
        document.getElementById('harga').innerText = formattedCurrency
      })
    })
  }
</script>
</html>