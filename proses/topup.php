<?php
include "../crud/transaksi.php";
session_start();
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
                    alert('Silahkan Login terlebih dahulu');
                    window.location='../account/auth/login.php';
                </script>";
}
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['topup'])) {
  $user_id = mysqli_real_escape_string($koneksi, $_POST['userid']);
  $server_id = mysqli_real_escape_string($koneksi, $_POST['serverid']);
  $id_data_produk = mysqli_real_escape_string($koneksi, $_POST['nominal']);
  $no_handphone = mysqli_real_escape_string($koneksi, $_POST['handphone']);
  $id_produk = mysqli_real_escape_string($koneksi, $_GET['id']);
  $kategori = mysqli_real_escape_string($koneksi, $_GET['ctg']);
  $id_user = mysqli_real_escape_string($koneksi, $_SESSION['id']);
  $date = mysqli_real_escape_string($koneksi, date('Y-m-d H:i:s'));
  $besok = mysqli_real_escape_string($koneksi, date('Y-m-d H:i:s', strtotime($date . ' + 1 days')));
  $status_pembayaran = mysqli_real_escape_string($koneksi, "Belum Dibayar");
  $status_transaksi = mysqli_real_escape_string($koneksi, "Menunggu Pembayaran");
  $username = "";
  $jumlah = 1;

  $query_total = "SELECT * FROM data_produk WHERE id_data_produk = '$id_data_produk'";
  $result_total = mysqli_query($koneksi, $query_total);
  $row_total = mysqli_fetch_assoc($result_total);
  $total = $row_total['harga_produk'] * $jumlah;

  $query = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
  $result = mysqli_query($koneksi, $query);
  $kode = "ZS03050000001";
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $kodeTerakhir = $row['id_transaksi'];

    if ($kodeTerakhir) {
      $angkaTerakhir = substr($kodeTerakhir, 6);
      $angkaBaru = intval($angkaTerakhir) + 1;
      $kode = "ZS0305" . str_pad($angkaBaru, 7, '0', STR_PAD_LEFT);
    } else {
      $kode = "ZS03050000001";
    }
  }

  $hasil = addTopup($kode, $id_produk, $id_data_produk, $id_user, $user_id, $server_id, $username, $date, $status_pembayaran, $status_transaksi, $no_handphone, $kategori, $jumlah, $total, $besok);
  if ($hasil != 0) {
    echo "<script type='text/javascript'>
                    alert('Berhasil Beli');
                    window.location='../account/invoice.php?id=$kode&&ctg=$kategori';
                </script>";
  } else {
    echo "<script type='text/javascript'>
                    alert('Gagal Beli');
                    window.location='../order/index.php?id=$kode&&c=$kategori';
                </script>";
  }
} elseif (isset($_POST['order'])) {
  $id_data_produk = mysqli_real_escape_string($koneksi, $_POST['nominal']);
  $no_handphone = mysqli_real_escape_string($koneksi, $_POST['handphone']);
  $id_produk = mysqli_real_escape_string($koneksi, $_GET['id']);
  $kategori = mysqli_real_escape_string($koneksi, $_GET['ctg']);
  $id_user = mysqli_real_escape_string($koneksi, $_SESSION['id']);
  $date = date('Y-m-d H:i:s');
  $besok = date('Y-m-d H:i:s', strtotime($date . ' + 1 days'));
  $status_pembayaran = "Belum Dibayar";
  $status_transaksi = "Menunggu Pembayaran";
  $jumlah = mysqli_real_escape_string($koneksi, $_POST['total_pembelian']);
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $password = mysqli_real_escape_string($koneksi, $_POST['password']);
  $hero = mysqli_real_escape_string($koneksi, $_POST['hero']);
  $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
  $user_nick = mysqli_real_escape_string($koneksi, $_POST['userid']);
  $login_via = mysqli_real_escape_string($koneksi, $_POST['login_via']);

  $query_total = "SELECT * FROM data_produk WHERE id_data_produk = '$id_data_produk'";
  $result_total = mysqli_query($koneksi, $query_total);
  $row_total = mysqli_fetch_assoc($result_total);
  $total = $row_total['harga_produk'] * $jumlah;

  $query = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);
  $kodeTerakhir = $row['id_transaksi'];

  if ($kodeTerakhir) {
    $angkaTerakhir = substr($kodeTerakhir, 6);
    $angkaBaru = intval($angkaTerakhir) + 1;
    $kode = "ZS0305" . str_pad($angkaBaru, 7, '0', STR_PAD_LEFT);
  } else {
    $kode = "ZS03050000001";
  }

  $hasil = addJoki($kode, $id_produk, $id_data_produk, $id_user, $date, $status_pembayaran, $status_transaksi, $no_handphone, $kategori, $email, $password, $hero, $catatan, $user_nick, $login_via, $jumlah, $total, $besok);
  if ($hasil != 0) {
    echo "<script type='text/javascript'>
                    alert('Berhasil Beli');
                    window.location='../account/invoice.php?id=$kode&&ctg=$kategori';
                </script>";
  } else {
    echo "<script type='text/javascript'>
                    alert('Gagal Beli');
                    window.location='../order/index.php?id=$kode&&c=$kategori';
                </script>";
  }
}
