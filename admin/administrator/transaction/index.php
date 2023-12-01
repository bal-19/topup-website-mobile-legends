<!DOCTYPE html>
<html lang="en">

<head>git
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Dashboard</title>

  <?php
  include '../../templates/sider.php';
  include '../../../koneksi/koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  ?>

</head>

<?php
  $sql = "SELECT transaksi.*, produk.*, user.nama as buyer, data_produk.id_data_produk, data_produk.id_produk, data_produk.nama as item, data_produk.harga_produk FROM `transaksi` INNER JOIN `user` on transaksi.id_user=user.id_user INNER JOIN `produk` on transaksi.id_produk=produk.id_produk INNER JOIN data_produk on transaksi.id_data_produk=data_produk.id_data_produk";
  $result = koneksi()->query($sql);
?>

<body id="body-pd">
  <div class="height-100">
    <h4 class="mb-4">Transaction</h4>
    <input type="text" class="mb-2 form-control" id="searchInput" placeholder="Search...">
      <div class="col-lg-12 ms-1 mb-2">
        <ul class="list-group">
          <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $dateTime = new DateTime($row['tanggal_transaksi']);
                $id_transaksi = $row['id_transaksi'];
                $batasPembayaran = new DateTime($row['keterangan']);
                $today = new DateTime();
                $formattedDateTime = $dateTime->format('l, d F Y \p\u\k\u\l H:i');
                
                if ($row['status_pembayaran'] == 'Belum Dibayar') {
                  if ($today > $batasPembayaran) {
                    $updateSql = "UPDATE transaksi SET status_pembayaran='Expired', status_transaksi='Expired' WHERE id_transaksi = '$id_transaksi'";
                    koneksi()->query($updateSql);
                  }
                }
          ?>
          <a href="details.php?id=<?= $row['id_transaksi'] ?>&&ctg=<?= $row['genre'] ?>" class="list-group-item list-group-item-dark list-group-item-action">
            <img src="data:../image;base64,<?= base64_encode($row['gambar']) ?>" alt="logo" class="me-3 img-thumbnail float-start rounded-circle-img" width="120px" height="120px">
            <h4 id="serviceName" class="mb-1"><?= $row['nama'] ?></h4>
            <?php
              if ($row['status_pembayaran'] == "Belum Dibayar") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-warning text-dark" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
              } elseif ($row['status_pembayaran'] == "Sudah Dibayar") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-success" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
              } elseif ($row['status_pembayaran'] == "Expired") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-danger" style="margin-top: -25px;">'.$row["status_pembayaran"].'</p>';
              }
            ?>
              <p id="itemLayanan" class="mb-1"><?= $row['item'] ?></p>
              <?php
              if ($row['status_transaksi'] == "Menunggu Pembayaran") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-warning text-dark" style="margin-top: -25px;">'.$row["status_transaksi"].'</p>';
              } elseif ($row['status_transaksi'] == "Belum Diproses") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-warning text-dark" style="margin-top: -25px;">'.$row["status_transaksi"].'</p>';
              } elseif ($row['status_transaksi'] == "Sudah Diproses") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-success" style="margin-top: -25px;">'.$row["status_transaksi"].'</p>';
              } elseif ($row['status_transaksi'] == "Expired") {
                echo '<p class="mb-1 float-end badge rounded-pill bg-danger" style="margin-top: -25px;">'.$row["status_transaksi"].'</p>';
              }
            ?>
              <p id="noHandphone" class="mb-1"><?= $row['nomor_handphone'] ?></p>
              <p id="transactionId" class="mb-1 float-end" style="margin-top: -25px;"><?= $row['id_transaksi'] ?></p>
              <p id="namaPembeli" class="mb-1"><?= $row['buyer'] ?></p>
              <small class="mb-1 float-end" style="margin-top: -25px;" id="tanggal"><?= $formattedDateTime ?></small>
          </a>
          <?php
              }
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const listItems = document.querySelectorAll(".list-group-item");

    searchInput.addEventListener("input", function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      listItems.forEach(function(item) {
        const noHandphone = item.querySelector("#noHandphone").textContent.toLowerCase();
        const transactionId = item.querySelector("#transactionId").textContent.toLowerCase();
        const serviceName = item.querySelector("#serviceName").textContent.toLowerCase();
        const tanggal = item.querySelector("#tanggal").textContent.toLowerCase();

        if (transactionId.includes(searchTerm) || noHandphone.includes(searchTerm) || serviceName.includes(searchTerm) || tanggal.includes(searchTerm)) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    });
  });
</script>


</html>