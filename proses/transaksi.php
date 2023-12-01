<?php
include "../crud/transaksi.php";

if (isset($_POST['confirm_pesanan'])) {
  $confirm_pesanan = mysqli_real_escape_string($koneksi, $_POST['confirm_pesanan']);
  $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
  $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
  $sql = "UPDATE transaksi SET status_transaksi = '$confirm_pesanan' WHERE id_transaksi = '$id_transaksi'";
  $result = mysqli_query($koneksi, $sql);
  if ($result) {
    header("Location: ../admin/administrator/transaction/details.php?id=$id_transaksi&&ctg=$kategori");
  }
} elseif (isset($_POST['confirm_pembayaran'])) {
  $confirm_pembayaran = mysqli_real_escape_string($koneksi, $_POST['confirm_pembayaran']);
  $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
  $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
  $sql = "UPDATE transaksi SET status_pembayaran = '$confirm_pembayaran', status_transaksi = 'Belum Diproses' WHERE id_transaksi = '$id_transaksi'";
  $result = mysqli_query($koneksi, $sql);
  if ($result) {
    header("Location: ../admin/administrator/transaction/details.php?id=$id_transaksi&&ctg=$kategori");
  }
}