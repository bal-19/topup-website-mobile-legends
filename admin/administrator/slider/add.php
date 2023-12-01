<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZeeShop - Dashboard</title>

  <?php
  include '../../templates/sider.php';
  require_once '../../../koneksi/koneksi.php';
  $koneksi = koneksi();
  function generateIdSlider()
  {
    global $koneksi;

    $query = "SELECT id_slide FROM slide ORDER BY id_slide DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);
    $kode = "ZS001";

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $kodeTerakhir = $row['id_slide'];

      if ($kodeTerakhir) {
        $angkaTerakhir = substr($kodeTerakhir, 3);
        $angkaBaru = intval($angkaTerakhir) + 1;
        $kode = "ZS" . str_pad($angkaBaru, 3, '0', STR_PAD_LEFT);
      } else {
        $kode = "ZS001";
      }

      mysqli_close($koneksi);

    }
    return $kode;
  }
  ?>

</head>

<body id="body-pd">
  <div class="height-100">
    <div class="card">
      <div class="card-header">Add Slider
      </div>
      <div class="card-body">
        <form action="../../../proses/slider.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="inputFile" class="form-label">
              <img class="d-none img-fluid img-small" id="previewImage" src="">
            </label>
            <input class="form-control form-control-sm mb-2" name="gambar" accept="image/*" id="inputFile" type="file" required>
            <span>The image must be in a 16:9 ratio</span>
          </div>
          <div class="mb-3">
            <label for="idProduct" class="form-label">Slide ID</label>
            <input type="text" class="form-control" name="id-slide" value="<?php echo generateIdSlider() ?>" readonly required>
          </div>
          <div class="mb-3">
            <label for="nameProduct" class="form-label">Name</label>
            <input type="text" class="form-control" name="nama" placeholder="Slide Name" required>
          </div>
      </div>
      <div class="mb-1">
        <div class="d-grid gap-2">
          <button class="btn btn-dark" type="submit" name="addSlide">Save</button>
        </div>
      </div>
      <div class="mb-1">
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