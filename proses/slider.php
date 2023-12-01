<?php
include "../crud/slide.php";

if (isset($_POST['addSlide'])) {
  $id_slide = mysqli_real_escape_string($koneksi, $_POST['id-slide']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/slide';
  $uploaded_image_path = $upload_directory . '/' . $gambarNama;
  move_uploaded_file($gambarTmp, $uploaded_image_path);

  $stmt = $koneksi->prepare("INSERT INTO slide (id_slide, nama, gambar) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $id_slide, $nama, $imageData);

  try {
    if ($stmt->execute()) {
      header("Location: ../admin/administrator/slider");
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $koneksi->close(); 
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/slider';
      </script>";
    } else {
      throw $e;
    }
  }
} elseif (isset($_POST['deleteSlider'])) {
  $id_slide = $_POST['deleteSlider'];

  $hasil = deleteSlider($id_slide);
  if ($hasil != 0) {
    header("Location: ../admin/administrator/slider");
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Delete');
            window.location='../admin/administrator/slider';  
        </script>";
  }
} elseif (isset($_POST['editSlide'])) {
  $id_slide = mysqli_real_escape_string($koneksi, $_POST['id_slide']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $gambarTmp = $_FILES['gambar']['tmp_name'];
  $gambarNama = $_FILES['gambar']['name'];

  $imageData = file_get_contents($gambarTmp);

  try {
    $hasil = editSlider($id_slide, $nama, $imageData);
    if ($hasil != 0) {
      $upload_directory = 'f:/xampp/htdocs/ZeeShop/image/slide';
      $uploaded_image_path = $upload_directory . '/' . $gambarNama;
      move_uploaded_file($gambarTmp, $uploaded_image_path);
      header("Location: ../admin/administrator/slider");
    } else {
      echo "<script type='text/javascript'>
              alert('Failed to Edit');
              window.location='../admin/administrator/slider';  
          </script>";
    }
  } catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'max_allowed_packet') !== false) {
      echo "<script>
      alert('Ukuran file Anda terlalu besar');
      window.location='../admin/administrator/slider';
      </script>";
    } else {
      throw $e;
    }
  }
}
