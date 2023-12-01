<?php
include "../koneksi/koneksi.php";
$koneksi = koneksi();

function addTopup($id_transaksi, $id_produk, $id_data_produk, $id_user, $user_id, $server_id, $username, $tanggal_transaksi, $status_pembayaran, $status_transaksi, $nomor_handphone, $genre, $jumlah, $total, $keterangan)
{
  global $koneksi;
  
  $query = "INSERT INTO transaksi (id_transaksi, id_produk, id_data_produk, id_user, user_id, server_id, username, tanggal_transaksi, status_pembayaran, status_transaksi, nomor_handphone, genre, jumlah, total, keterangan) VALUES('$id_transaksi', '$id_produk','$id_data_produk', '$id_user', '$user_id', '$server_id', '$username', '$tanggal_transaksi', '$status_pembayaran', '$status_transaksi', '$nomor_handphone', '$genre', $jumlah, $total, '$keterangan')";
  $hasil = 0;
  if (mysqli_query($koneksi, $query)) {
    $hasil = 1;
  }
  mysqli_close($koneksi);
  return $hasil;
} 

function addJoki($id_transaksi, $id_produk, $id_data_produk, $id_user, $tanggal_transaksi, $status_pembayaran, $status_transaksi, $nomor_handphone, $genre, $email, $password, $hero, $catatan, $user_nick, $login_via, $jumlah, $total, $keterangan)
{
  global $koneksi;
  
  $query = "INSERT INTO transaksi (id_transaksi, id_produk, id_data_produk, id_user, tanggal_transaksi, status_pembayaran, status_transaksi, nomor_handphone, genre, email, password, hero, catatan, user_nick, login_via, jumlah, total, keterangan) VALUES('$id_transaksi', '$id_produk', '$id_data_produk', '$id_user', '$tanggal_transaksi', '$status_pembayaran', '$status_transaksi', '$nomor_handphone', '$genre', '$email', '$password', '$hero', '$catatan', '$user_nick', '$login_via', $jumlah, $total, '$keterangan')";
  $hasil = 0;
  if (mysqli_query($koneksi, $query)) {
    $hasil = 1;
  }
  mysqli_close($koneksi);
  return $hasil;
} 