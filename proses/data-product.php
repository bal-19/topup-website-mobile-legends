<?php
include '../crud/data-product.php';

if (isset($_POST['tambahData'])) {
  $id_data = $_POST['id_data'];
  $id_produk = $_POST['id_produk'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $hasil = addData($id_data, $id_produk, $nama, $harga);

  if ($hasil == 1) {
    header('Location: ../admin/administrator/data-product/add.php?id=' . $id_produk);
  } else {
    echo "error";
  }
} elseif (isset($_POST['deleteData'])) {
  $id_data = $_POST['deleteData'];
  $id_produk = $_POST['id_produk'];

  $hasil = deleteData($id_data);
  if ($hasil != 0) {
    header('Location: ../admin/administrator/data-product/add.php?id=' . $id_produk);
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Delete');
            window.location='../admin/administrator/data-product/add.php?id=' . $id_produk';  
        </script>";
  }
} elseif (isset($_POST['editData'])) {
  $id_data = $_POST['id_data'];
  $id_produk = $_POST['id_produk'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $hasil = updateData($id_data, $id_produk, $nama, $harga);

  if ($hasil != 0) {
    header('Location: ../admin/administrator/data-product/add.php?id=' . $id_produk);
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Edit');
            window.location='../admin/administrator/data-product/add.php?id=' . $id_produk';  
        </script>";
  }
} elseif(isset($_GET['getdata'])) {
  echo json_encode(selectData());
}