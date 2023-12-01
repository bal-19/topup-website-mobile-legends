<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Riwayat Transaksi</title>
  <?php
  include '../templates/header.php';

  if (!isset($_SESSION['id'])) {
    header("Location: auth/login.php");
  }
  date_default_timezone_set('Asia/Jakarta');
  ?>
</head>

<body>
  <div class="container-fluid mt-5 pt-5">
    <div class="row">
      <nav id="sidebar" class="bg-dark col-md-3 col-lg-2 d-md-block border border-start-0 border-2 border-secondary shadow-lg sidebar">
        <div class="position-sticky">
          <ul class="nav flex-column">
            <li class="nav-item mt-4">
              <a class="nav-link text-light" href="../account">
                <div>
                  <i class="fa-solid fa-user"></i> Profile
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light active" href="transaction.php">
                <div>
                  <i class="fa-solid fa-money-bill"></i> Transaksi
                </div>
              </a>
            </li>
            <li class="nav-item border-top border-secondary border-2 mt-3">
              <a class="nav-link text-danger" href="../proses/logout.php">
                <div>
                  <i class="fa-solid fa-right-from-bracket"></i> Logout
                </div>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-lg-12 ms-1 mt-2 mb-2">
          <h1 class="mb-4 text-light">Riwayat Transaksi</h1>
          <ul class="list-group">
            <?php
            $id_user = $_SESSION['id'];
            $sql = "SELECT transaksi.*, produk.*, data_produk.id_data_produk, data_produk.id_produk, data_produk.nama as item, data_produk.harga_produk FROM `transaksi` INNER JOIN `produk` on transaksi.id_produk=produk.id_produk INNER JOIN data_produk on transaksi.id_data_produk=data_produk.id_data_produk WHERE id_user='$id_user'";
            $result = $koneksi->query($sql);

            $query = "SELECT * FROM pembayaran";
            $hasil = $koneksi->query($query);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $dateTime = new DateTime($row['tanggal_transaksi']);
                $batasPembayaran = new DateTime($row['keterangan']);
                $id_transaksi = $row['id_transaksi'];
                $today = new DateTime();
                $formattedDateTime = $dateTime->format('l, d F Y \p\u\k\u\l H:i');

                if ($row['status_pembayaran'] == 'Belum Dibayar') {
                  if ($today > $batasPembayaran) {
                    $updateSql = "UPDATE transaksi SET status_pembayaran = 'Expired', status_transaksi = 'Expired' WHERE id_transaksi = '$id_transaksi'" ;
                    $koneksi->query($updateSql);
                  }
                  }
            ?>
                <a href="invoice.php?id=<?= $row['id_transaksi'] ?>&&ctg=<?= $row['genre'] ?>" class="list-group-item list-group-item-dark list-group-item-action">
                  <img src="data:../image;base64,<?= base64_encode($row['gambar']) ?>" alt="logo" class="me-3 img-thumbnail float-start rounded-circle-img">
                  <h6 class="mb-1"><?= $row['nama'] ?></h6>
                  <?php
                    if ($row['status_pembayaran'] == "Belum Dibayar") {
                      echo '<p class="mb-1 float-end badge rounded-pill text-bg-warning" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
                    } elseif ($row['status_pembayaran'] == "Sudah Dibayar") {
                      echo '<p class="mb-1 float-end badge rounded-pill text-bg-success" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
                    } elseif ($row['status_pembayaran'] == "Expired") {
                      echo '<p class="mb-1 float-end badge rounded-pill text-bg-danger" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
                    }
                  ?>
                    <small class="mb-1" style="margin-top: 1px;"><b><?= $row['item'] ?></b></small><br>
                    <small class="mb-1" style="margin-top: -20px; font-size: 12px;">
                      <?= $formattedDateTime ?>
                    </small>
                </a>

            <?php
              }
            } else {
              echo "<div class='alert alert-warning' role='alert'><div class='text-center'>Belum ada riwayat transaksi</div></div>";
            }
            ?>

          </ul>
        </div>
      </main>
    </div>
  </div>
</body>
<br><br><br><br><br><br><br><br>
<?php
include '../templates/footer.php';
?>

</html>