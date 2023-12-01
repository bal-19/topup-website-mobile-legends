<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  $id = $_GET['id'];
  $kategori = $_GET['ctg'];
  ?>
  <title>Transaction - <?= $id ?></title>
  <?php
  include '../../templates/sider.php';
  include '../../../koneksi/koneksi.php';
  ?>

</head>

<?php
$sql = "SELECT transaksi.*, produk.*, user.nama as pembeli, data_produk.id_data_produk, data_produk.id_produk, data_produk.nama as item, data_produk.harga_produk FROM `transaksi` INNER JOIN `produk` on transaksi.id_produk=produk.id_produk INNER JOIN data_produk on transaksi.id_data_produk=data_produk.id_data_produk INNER JOIN `user` on transaksi.id_user=user.id_user WHERE id_transaksi='$id'";
$result = koneksi()->query($sql);

$query = "SELECT gambar FROM pembayaran";
$hasil = koneksi()->query($query);
koneksi()->close();
?>


<?php
if (mysqli_num_rows($result) > 0) {
  $row = $result->fetch_assoc();
  $dateTime = new DateTime($row['tanggal_transaksi']);
  $formattedDateTime = $dateTime->format('l, d F Y \p\u\k\u\l H:i:s');
  if ($kategori == "Topup") {
?>

  <body id="body-pd">
    <h1>Details Transaction</h1>
    <div class="mt-4 row">
      <div class="col-md-6">
        <form action="../../../proses/transaksi.php" method="post">
          <div class="card mb-3">
            <div class="card-body">
              <h2 class="card-title">Buyer Information</h2>
              <p class="card-text">Nomor Pesanan: <b><?= $row['id_transaksi'] ?></b></p>
              <p class="card-text">Nama Pembeli: <b><?= $row['pembeli'] ?></b></p>
              <p class="card-text">Nomor Telepon: <b><?= $row['nomor_handphone'] ?></b></p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Product Information</h2>
              <p class="card-text">Nama Layanan: <b><?= $row['nama'] ?></b></p>
              <p class="card-text">Item: <b><?= $row['item'] ?></b></p>
              <p class="card-text">User Id: <b><?= $row['user_id'] ?></b></p>
              <p class="card-text">Server Id: <b><?= $row['server_id'] ?></b></p>
              <p class="card-text">Jumlah: <b><?= $row['jumlah'] ?></b></p>
              <p class="card-text">Status Pesanan: 
                <?php
                  if ($row['status_transaksi'] == "Menunggu Pembayaran") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Belum Diproses") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Sudah Diproses") {
                    echo '<span class="mb-1 badge rounded-pill bg-success">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Expired") {
                    echo '<span class="mb-1 badge rounded-pill bg-danger">'.$row["status_transaksi"].'</span>';
                  }
                ?>
              </p>
              <?php
              if ($row['status_transaksi'] == "Sudah Diproses" || $row['status_transaksi'] == "Expired") {
                echo "<button class='btn btn-dark' name='confirm_pesanan' value='Sudah Diproses' disabled>Konfirmasi Pesanan</button>";
              } else {
                echo "<button class='btn btn-dark' name='confirm_pesanan' value='Sudah Diproses'>Konfirmasi Pesanan</button>";
              }
              ?>
              <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
              <input type="hidden" name="kategori" value="<?= $kategori ?>">
            </div>
          </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <h2 class="card-title">Payment Details</h2>
            <p class="card-text">Tanggal Transaksi: <b><?= $formattedDateTime ?></b></p>
            <p class="card-text">Total Pembelian: <b><?= "Rp. " . number_format($row['total'], 0, ",", ".") ?>,-</b></p>
            <p class="card-text">Metode Pembayaran: <?php
                                                    while ($row_payment = mysqli_fetch_assoc($hasil)) {
                                                      $gambar_payment = $row_payment['gambar'];

                                                      echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                                                    }
                                                    ?></p>
            <p class="card-text">Status Pembayaran: 
              <?php
                  if ($row['status_pembayaran'] == "Belum Dibayar") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_pembayaran"].'</span>';
                  } elseif ($row['status_pembayaran'] == "Sudah Dibayar") {
                    echo '<span class="mb-1 badge rounded-pill bg-success">'.$row["status_pembayaran"].'</span>';
                  } elseif ($row['status_pembayaran'] == "Expired") {
                    echo '<span class="mb-1 badge rounded-pill bg-danger">'.$row["status_pembayaran"].'</span>';
                  }
                ?>
            </p>
            <?php
            if ($row['status_pembayaran'] == "Sudah Dibayar" || $row['status_pembayaran'] == "Expired") {
              echo "<button class='btn btn-dark' name='confirm_pembayaran' value='Sudah Dibayar' disabled>Konfirmasi Pembayaran</button>";
            } else {
              echo "<button class='btn btn-dark' name='confirm_pembayaran' value='Sudah Dibayar'>Konfirmasi Pembayaran</button>";
            }
            ?>
          </div>
        </div>
      </div>
      </form>
    </div>
  </body>
<?php
} elseif ($kategori == "Joki") {
?>

  <body id="body-pd">
    <h1>Details Transaction</h1>
    <div class="mt-4 row">
      <div class="col-md-6">
        <form action="../../../proses/transaksi.php" method="post">
          <div class="card mb-3">
            <div class="card-body">
              <h2 class="card-title">Buyer Information</h2>
              <p class="card-text">Nomor Pesanan: <b><?= $row['id_transaksi'] ?></b></p>
              <p class="card-text">Nama Pembeli: <b><?= $row['pembeli'] ?></b></p>
              <p class="card-text">Nomor Telepon: <b><?= $row['nomor_handphone'] ?></b></p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Product Information</h2>
              <p class="card-text">Nama Layanan: <b><?= $row['nama'] ?></b></p>
              <p class="card-text">Item: <b><?= $row['item'] ?></b></p>
              <p class="card-text">Email: <b><?= $row['email'] ?></b></p>
              <p class="card-text">Password: <b><?= $row['password'] ?></b></p>
              <p class="card-text">Hero: <b><?= $row['hero'] ?></b></p>
              <p class="card-text">Catatan: <b><?= $row['catatan'] ?></b></p>
              <p class="card-text">Login Via: <b><?= $row['login_via'] ?></b></p>
              <p class="card-text">Jumlah: <b><?= $row['jumlah'] ?></b></p>
              <p class="card-text">Status Pesanan: 
              <?php
                  if ($row['status_transaksi'] == "Menunggu Pembayaran") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Belum Diproses") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Sudah Diproses") {
                    echo '<span class="mb-1 badge rounded-pill bg-success">'.$row["status_transaksi"].'</span>';
                  } elseif ($row['status_transaksi'] == "Expired") {
                    echo '<span class="mb-1 badge rounded-pill bg-danger">'.$row["status_transaksi"].'</span>';
                  }
                ?>
              </p>
              <?php
              if ($row['status_transaksi'] == "Sudah Diproses" || $row['status_transaksi'] == "Expired") {
                echo "<button class='btn btn-dark' name='confirm_pesanan' value='Sudah Diproses' disabled>Konfirmasi Pesanan</button>";
              } else {
                echo "<button class='btn btn-dark' name='confirm_pesanan' value='Sudah Diproses'>Konfirmasi Pesanan</button>";
              }
              ?>
              <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
              <input type="hidden" name="kategori" value="<?= $kategori ?>">
            </div>
          </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <h2 class="card-title">Payment Details</h2>
            <p class="card-text">Tanggal Transaksi: <b><?= $formattedDateTime ?></b></p>
            <p class="card-text">Total Pembelian: <b><?= "Rp. " . number_format($row['total'], 0, ",", ".") ?>,-</b></p>
            <p class="card-text">Metode Pembayaran: <?php
                                                    while ($row_payment = mysqli_fetch_assoc($hasil)) {
                                                      $gambar_payment = $row_payment['gambar'];

                                                      echo '<img class="img-fluid me-1" width="50" src="data:../image/payment/;base64,' . base64_encode($gambar_payment) . '"/>';
                                                    }
                                                    ?></p>
            <p class="card-text">Status Pembayaran: 
            <?php
                  if ($row['status_pembayaran'] == "Belum Dibayar") {
                    echo '<span class="mb-1 badge rounded-pill bg-warning text-dark">'.$row["status_pembayaran"].'</span>';
                  } elseif ($row['status_pembayaran'] == "Sudah Dibayar") {
                    echo '<span class="mb-1 badge rounded-pill bg-success">'.$row["status_pembayaran"].'</span>';
                  } elseif ($row['status_pembayaran'] == "Expired") {
                    echo '<span class="mb-1 badge rounded-pill bg-danger">'.$row["status_pembayaran"].'</span>';
                  }
                ?>
            </p>
            <?php
            if ($row['status_pembayaran'] == "Sudah Dibayar" || $row['status_pembayaran'] == "Expired") {
              echo "<button class='btn btn-dark' name='confirm_pembayaran' value='Sudah Dibayar' disabled>Konfirmasi Pembayaran</button>";
            } else {
              echo "<button class='btn btn-dark' name='confirm_pembayaran' value='Sudah Dibayar'>Konfirmasi Pembayaran</button>";
            }
            ?>
          </div>
        </div>
      </div>
      </form>
    </div>
  </body>
<?php
  } else {
    echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Data Tidak Ditemukan</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
  }
} else {
  echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Data Tidak Ditemukan</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
}
?>

</html>