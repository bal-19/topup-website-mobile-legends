<?php
include '../koneksi/koneksi.php';
$koneksi = koneksi();

function addData($id_data, $id_produk, $nama, $harga)
{
  global $koneksi;
  $query = "INSERT INTO data_produk VALUES('$id_data', '$id_produk', '$nama', $harga)";
  $hasil = 0;
  if (mysqli_query($koneksi, $query)) {
    $hasil = 1;
  }
  mysqli_close($koneksi);
  return $hasil;
}

function deleteData($id_data){
  global $koneksi;

  $sql = "DELETE FROM data_produk WHERE id_data_produk='$id_data'";
  $hasil = 0;
  if (mysqli_query($koneksi, $sql)) {
      $hasil = 1;
  }
  mysqli_close($koneksi);
  return $hasil;
}

function updateData($id_data, $id_produk, $nama, $harga)
{
  global $koneksi;
  $query = "UPDATE `data_produk` SET `id_produk`='$id_produk',`nama`='$nama',`harga_produk`='$harga' WHERE `id_data_produk`='$id_data'";
  $hasil = 0;
  if (mysqli_query($koneksi, $query)) {
    $hasil = 1;
  }
  mysqli_close($koneksi);
  return $hasil;
}

function selectData() {
  global $koneksi;
  return $koneksi->query("SELECT * FROM data_produk")->fetch_all();
}