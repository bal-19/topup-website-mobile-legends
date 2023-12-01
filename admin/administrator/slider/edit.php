<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Dashboard</title>

  <?php
  include '../../templates/sider.php';
  ?>

</head>

<?php
include '../../../koneksi/koneksi.php';

$id_slide = $_GET['id'];
$sql = "SELECT * FROM slide WHERE id_slide = '$id_slide'";
$result = koneksi()->query($sql);
koneksi()->close();
if (mysqli_num_rows($result) > 0) {
  $row = $result->fetch_assoc();
  $id_slide = $row['id_slide'];
  $nama = $row['nama'];
  $gambar = $row['gambar'];
} else {
  echo '<br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="alert alert-danger mt-5" role="alert">
        <h2 class="text-center">Data Tidak Ditemukan</h2>
      </div>
    </div> <br><br><br><br><br><br><br>';
    die();
}
?>

<body id="body-pd">
  <div class="height-100">
    <div class="card">
      <div class="card-header">Edit Slider
      </div>
      <div class="card-body">
        <form action="../../../proses/slider.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="inputFile" class="form-label">
              <?php echo '<img class="img-fluid img-small" id="previewImage" src="data:../../image/slide/;base64,' . base64_encode($gambar) . '" />'; ?>
            </label>
            <input class="form-control form-control-sm mb-2" name="gambar" accept="image/*" id="inputFile" type="file" required>
            <span>The image must be in a 16:9 ratio</span>
          </div>
          <div class="mb-3">
            <label for="idProduct" class="form-label">Slider ID</label>
            <input type="text" class="form-control" id="idProduct" name="id_slide" value="<?php echo $id_slide ?>" readonly required>
          </div>
          <div class="mb-3">
            <label for="nameProduct" class="form-label">Name</label>
            <input type="text" class="form-control" id="nameProduct" name="nama" value="<?php echo $nama ?>" placeholder="Slider Name" required>
          </div>
          <div class="mb-1">
            <div class="d-grid gap-2">
              <button class="btn btn-dark" type="submit" name="editSlide">Save</button>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-grid gap-2">
              <a href="../slider" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<script>
  const imageInput = document.getElementById('inputFile');
  const imagePreview = document.getElementById('previewImage');

  imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.src = URL.createObjectURL(file);
      imagePreview.classList.remove('d-none');
    }
  });
</script>

</html>