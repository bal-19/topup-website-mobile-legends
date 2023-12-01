<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Invoice</title>
  <?php
  include '../templates/header.php';
  if (!isset($_SESSION['id'])) {
    header("Location: auth/login.php");
  }
  date_default_timezone_set('Asia/Jakarta');
  ?>
  <style>
    @page :left {
      margin-left: 7cm;
      margin-right: 15cm;
    }

    @page :right {
      margin-left: 7cm;
      margin-right: 15cm;
    }
  </style>
</head>

<?php
$id_user = $_SESSION['id'];
$id = $_GET['id'];
$kategori = $_GET['ctg'];

$sql = "SELECT transaksi.*, produk.*, data_produk.id_data_produk, data_produk.id_produk, data_produk.nama as item, data_produk.harga_produk FROM `transaksi` INNER JOIN `produk` on transaksi.id_produk=produk.id_produk INNER JOIN data_produk on transaksi.id_data_produk=data_produk.id_data_produk WHERE id_transaksi='$id'";
$result = $koneksi->query($sql);

$query = "SELECT gambar FROM pembayaran";
$hasil = $koneksi->query($query);
$koneksi->close();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
  if ($row['id_user'] == $id_user) {
    if ($kategori == 'Topup') {
      $dateTime = new DateTime($row['tanggal_transaksi']);
      $formattedDateTime = $dateTime->format('l, d F Y \p\u\k\u\l H:i:s');

      $date = new DateTime($row['keterangan']);
      $formattedDate = $date->format('l, d F Y \p\u\k\u\l H:i:s');

      $user_id = $row['user_id'];
      $server_id = $row['server_id'];
      $username = $row['username'];

?>

      <body>
        <div class="container mt-5 pt-5" id="topup" data-bs-theme="dark">
          <div class="col-lg-9 mx-auto">

            <?php
            if ($row['status_pembayaran'] == 'Belum Dibayar') {
              echo '<div class="alert alert-warning" role="alert">
            <h4 class="text-center">HARAP DIBAYAR SEBELUM :</h4>
            <div class="text-center">' . $formattedDate . '</div>
          </div>';
            } elseif ($row['status_pembayaran'] == 'Sudah Dibayar') {
              echo '<div class="alert alert-success" role="alert">
            <h4 class="text-center">TERIMA KASIH SUDAH MEMBELI LAYANAN DI ZEESHOP</h4>
          </div>';
            } elseif ($row['status_pembayaran'] == 'Expired') {
              echo '<div class="alert alert-danger" role="alert">
            <h4 class="text-center">TRANSAKSI GAGAL</h4>
          </div>';
            }
            ?>
            <button type="button" class="btn btn-warning mb-2 mt-4" onclick="window.print()">
              <i class="fa-solid fa-print" style="color: #000000;"></i>
              Cetak Invoice Anda
            </button>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Informasi Pembelian</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <p class="card-text">Tanggal Pembelian: <br> <b><?= $formattedDateTime ?></b></p>
                  </div>
                  <div class="col-4">
                    <p class="card-text">Nomor Pesanan: <br> <b><?= $row['id_transaksi'] ?></b></p>
                  </div>
                  <div class="col-4">
                    <p class="card-text">Metode Pembayaran: <br>
                      <?php
                      while ($row_payment = mysqli_fetch_assoc($hasil)) {
                        $gambar_payment = $row_payment['gambar'];
                        // $biaya_admin = $row_payment['biaya_admin'];

                        echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                      }
                      ?>
                  </div>
                  </p>
                </div>
              </div>
            </div>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Detail Pesanan</h5>
              </div>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Layanan :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['nama'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Item :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['item'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Harga :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= "Rp. " . number_format($row['harga_produk'], 0, ",", ".") ?>,-</b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">User Id :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['user_id'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Server Id :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b>(<?= $row['server_id'] ?>)</b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Status Transaksi :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text">
                      <?php
                      if ($row['status_transaksi'] == "Menunggu Pembayaran") {
                        echo "<b class='badge rounded-pill text-bg-warning'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Belum Diproses") {
                        echo "<b class='badge rounded-pill text-bg-warning'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Sudah Diproses") {
                        echo "<b class='badge rounded-pill text-bg-success'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Expired") {
                        echo "<b class='badge rounded-pill text-bg-danger'>" . $row['status_transaksi'] . "</b>";
                      }
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-4">
                    <strong class="card-text fs-5">Total Pembayaran </strong>
                  </div>
                  <div class="col text-end">
                    <strong class="card-text text-light fs-5"><?= "Rp. " . number_format($row['total'], 0, ",", ".") ?>,-</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion mb-3" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Cara Pembayaran
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ol>
                      <li>
                        Buka Aplikasi e-wallet yang anda miliki (termasuk Gopay, DANA, Shopeepay, OVO)
                      </li>
                      <li>
                        Buka menu atau tab transfer dalam aplikasi E-Wallet Anda. Biasanya tertulis "Transfer", "Kirim Uang", atau yang serupa, lalu masukkan nomor handphone "087856754195"
                      </li>
                      <li>
                        Kemudian pilih nominal yang mau di transfer sesuai dengan harga dari layanan yang dibeli
                      </li>
                      <li>
                        Lihat kembali detail transfer Anda untuk memastikan semuanya benar, termasuk nama penerima dan jumlah uang. Setelah yakin, pilih opsi untuk mengonfirmasi
                      </li>
                      <li>a                        Beberapa aplikasi mungkin meminta Anda untuk memasukkan kata sandi, PIN, atau melakukan verifikasi lainnya untuk menyelesaikan transfer
                      </la>
                      <li>
                        Setelah transfer berhasil, silahkan anda simpan bukti transfer untuk Anda kirim ke nomor Whatsapp "087856754195" agar segera dikonfirmasi oleh Admin dan segera di proses
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Pesanan Belum Masuk?</h5>
              </div>
              <div class="card-body">
                <p class="card-text">Hubungi customer service kami untuk melakukan konfirmasi pesanan</p>
                <a href="https://wa.me/087856754195" class="btn btn-secondary">Kontak Kami</a>
              </div>
            </div>
          </div>
        </div>
      </body>
    <?php
    } elseif ($kategori == 'Joki') {
      $dateTime = new DateTime($row['tanggal_transaksi']);
      $formattedDateTime = $dateTime->format('l, d F Y \p\u\k\u\l H:i:s');

      $date = new DateTime($row['keterangan']);
      $formattedDate = $date->format('l, d F Y \p\u\k\u\l H:i:s');
    ?>

      <body>
        <div class="container mt-5 pt-5" id="joki" data-bs-theme="dark">
          <div class="col-lg-9 mx-auto">
            <?php
            if ($row['status_pembayaran'] == 'Belum Dibayar') {
              echo '<div class="alert alert-warning" role="alert">
            <h4 class="text-center">HARAP DIBAYAR SEBELUM :</h4>
            <div class="text-center">' . $formattedDate . '</div>
          </div>';
            } elseif ($row['status_pembayaran'] == 'Sudah Dibayar') {
              echo '<div class="alert alert-success" role="alert">
            <h4 class="text-center">TERIMA KASIH SUDAH MEMBELI LAYANAN DI ZEESHOP</h4>
          </div>';
            } elseif ($row['status_pembayaran'] == 'Expired') {
              echo '<div class="alert alert-danger" role="alert">
            <h4 class="text-center">TRANSAKSI GAGAL</h4>
          </div>';
            }
            ?>
            <button type="button" class="btn btn-warning mb-2 mt-4" onclick="window.print()">
              <i class="fa-solid fa-print" style="color: #000000;"></i>
              Cetak Invoice Anda
            </button>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Informasi Pembelian</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <p class="card-text">Tanggal Pembelian: <br> <b><?= $formattedDateTime ?></b></p>
                  </div>
                  <div class="col-4">
                    <p class="card-text">Nomor Pesanan: <br> <b><?= $row['id_transaksi'] ?></b></p>
                  </div>
                  <div class="col-4">
                    <p class="card-text">Metode Pembayaran: <br>
                      <?php
                      while ($row_payment = mysqli_fetch_assoc($hasil)) {
                        $gambar_payment = $row_payment['gambar'];
                        // $biaya_admin = $row_payment['biaya_admin'];

                        echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                      }
                      ?>
                  </div>
                  </p>
                </div>
              </div>
            </div>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Detail Pesanan</h5>
              </div>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Layanan :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['nama'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Item :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['item'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Harga :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= "Rp. " . number_format($row['harga_produk'], 0, ",", ".") ?>,-</b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Jumlah Pembelian :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['jumlah'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Email :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['email'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Password :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['password'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Hero :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['hero'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">User Id dan Nickname :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['user_nick'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Login Via :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text"><b><?= $row['login_via'] ?></b></p>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <p class="card-text">Status Transaksi :</p>
                  </div>
                  <div class="col-lg-4">
                    <p class="card-text">
                      <?php
                      if ($row['status_transaksi'] == "Menunggu Pembayaran") {
                        echo "<b class='badge rounded-pill text-bg-warning'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Belum Diproses") {
                        echo "<b class='badge rounded-pill text-bg-warning'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Sudah Diproses") {
                        echo "<b class='badge rounded-pill text-bg-success'>" . $row['status_transaksi'] . "</b>";
                      } elseif ($row['status_transaksi'] == "Expired") {
                        echo "<b class='badge rounded-pill text-bg-danger'>" . $row['status_transaksi'] . "</b>";
                      }
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-4">
                    <strong class="card-text fs-5">Total Pembayaran </strong>
                  </div>
                  <div class="col text-end">
                    <strong class="card-text text-light fs-5"><?= "Rp " . number_format($row['total'], 0, ",", ".") ?>,-</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion mb-3" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Cara Pembayaran
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ol>
                      <li>
                        Buka Aplikasi e-wallet yang anda miliki (termasuk Gopay, DANA, Shopeepay, OVO)
                      </li>
                      <li>
                        Buka menu atau tab transfer dalam aplikasi E-Wallet Anda. Biasanya tertulis "Transfer", "Kirim Uang", atau yang serupa, lalu masukkan nomor handphone "087856754195"
                      </li>
                      <li>
                        Kemudian pilih nominal yang mau di transfer sesuai dengan harga dari layanan yang dibeli
                      </li>
                      <li>
                        Lihat kembali detail transfer anda untuk memastikan semuanya benar, termasuk nama penerima dan jumlah uang. Setelah yakin, pilih opsi untuk mengonfirmasi
                      </li>
                      <li>
                        Beberapa aplikasi mungkin meminta anda untuk memasukkan kata sandi, PIN, atau melakukan verifikasi lainnya untuk menyelesaikan transfer
                      </li>
                      <li>
                        Setelah transfer berhasil, silahkan anda simpan bukti transfer untuk Anda kirim ke nomor Whatsapp "087856754195" agar segera dikonfirmasi oleh Admin dan segera di proses
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <div class="card text-bg-dark mb-3">
              <div class="card-header">
                <h5>Pesanan Belum Masuk?</h5>
              </div>
              <div class="card-body">
                <p class="card-text">Hubungi customer service kami untuk melakukan konfirmasi pesanan</p>
                <a href="https://wa.me/087856754195" class="btn btn-secondary">Kontak Kami</a>
              </div>
            </div>
          </div>
        </div>
      </body>
<?php
    } else {
      echo '<br><br><br><br><br><br><br><br>
      <div class="container">
        <div class="alert alert-danger mt-5" role="alert">
          <h2 class="text-center">Error 404</h2>
        </div>
      </div> <br><br><br><br><br><br>';
    }
  } else {
    echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Error 404</h2>
      </div>
    </div> <br><br><br><br><br><br>';
  }
} else {
  echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Error 404</h2>
      </div>
    </div> <br><br><br><br><br><br>';
}
?>

</html>
<?php
include '../templates/footer.php';
?>