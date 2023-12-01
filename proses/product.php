<?php
include '../crud/produk.php';

if (isset($_POST['editProduk'])) {
  $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_product']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $kategori = mysqli_real_escape_string($koneksi, $_POST['category']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['description']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  try { 
    $hasil = editProduk($id_produk, $nama, $imageData, $kategori, $deskripsi);
    if ($hasil != 0) {
      $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/product';
      $uploaded_image_path = $upload_directory . '/' . $gambarNama;
      move_uploaded_file($gambarTmp, $uploaded_image_path);
      header("Location: ../admin/administrator/product");
    } else {
      echo "<script type='text/javascript'>
              alert('Failed to Edit');
              window.location='../admin/administrator/product';  
          </script>";
    }
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/product';
      </script>";
    } else {
      throw $e;
    }
  }
}

if (isset($_POST['tambahProduk'])) {
  $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_product']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $kategori = mysqli_real_escape_string($koneksi, $_POST['category']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['description']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/product';
  $uploaded_image_path = $upload_directory . '/' . $gambarNama;
  move_uploaded_file($gambarTmp, $uploaded_image_path);

  $stmt = $koneksi->prepare("INSERT INTO produk (id_produk, nama, gambar, genre, deskripsi) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $id_produk, $nama, $imageData, $kategori, $deskripsi);

  try {
    if ($stmt->execute()) {
      header("Location: ../admin/administrator/product");
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $koneksi->close();
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/product';
      </script>";
    } else {
      throw $e;
    }
  }
}

if (isset($_POST['deleteProduct'])) {
  $id_produk = $_POST['deleteProduct'];

  $hasil = deleteProduk($id_produk);
  if ($hasil != 0) {
    header("Location: ../admin/administrator/product");
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Delete');
            window.location='../admin/administrator/product';  
        </script>";
  }
}
