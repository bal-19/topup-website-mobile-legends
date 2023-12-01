<?php
include "../crud/payment.php";

if (isset($_POST['tambahPayment'])) {
  $id_payment = mysqli_real_escape_string($koneksi, $_POST['id-payment']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/payment';
  $uploaded_image_path = $upload_directory . '/' . $gambarNama;
  move_uploaded_file($gambarTmp, $uploaded_image_path);

  $stmt = $koneksi->prepare("INSERT INTO pembayaran (id_pembayaran, nama_pembayaran, gambar) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $id_payment, $nama, $imageData);

  try {
    if ($stmt->execute()) {
      header("Location: ../admin/administrator/payment");
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $koneksi->close();
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/payment';
      </script>";
    } else {
      throw $e;
    }
  }
} elseif (isset($_POST['deletePayment'])) {
  $id_payment = $_POST['deletePayment'];

  $hasil = deletePayment($id_payment);
  if ($hasil != 0) {
    header("Location: ../admin/administrator/payment");
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Delete');
            window.location='../admin/administrator/payment';  
        </script>";
  }
} elseif (isset($_POST['editPayment'])) {  
  $id_payment = mysqli_real_escape_string($koneksi, $_POST['id-payment']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  try {
    $hasil = editPayment($id_payment, $nama, $imageData);
    if ($hasil != 0) {
      $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/payment';
      $uploaded_image_path = $upload_directory . '/' . $gambarNama;
      move_uploaded_file($gambarTmp, $uploaded_image_path);
      header("Location: ../admin/administrator/payment");
    } else {
      echo "<script type='text/javascript'>
              alert('Failed to Edit');
              window.location='../admin/administrator/payment';  
          </script>";
    }
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/payment';
      </script>";
    } else {
      throw $e;
    }
  }
}
