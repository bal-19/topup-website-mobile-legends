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
  function generateIdProduct()
  {
    global $koneksi;

    $query = "SELECT id_produk FROM produk ORDER BY id_produk DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);
    $kode = "ZP0001";

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $kodeTerakhir = $row['id_produk'];

      if ($kodeTerakhir) {
        $angkaTerakhir = substr($kodeTerakhir, 2);
        $angkaBaru = intval($angkaTerakhir) + 1;
        $kode = "ZP" . str_pad($angkaBaru, 4, '0', STR_PAD_LEFT);
      } else {
        $kode = "ZP0001";
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
      <div class="card-header">
        Add Service
      </div>
      <div class="card-body">
        <form action="../../../proses/product.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="inputFile" class="form-label">
              <div class="imageContainer">
                <img class="img-fluid img-small d-none" id="previewImage" src="">
              </div>
            </label>
            <input class="form-control form-control-sm mb-2" name="gambar" accept="image/*" id="inputFile" type="file" required>
            <span>The image must be in a 1:1 ratio</span>
          </div>
          <div class="mb-3">
            <label for="idProduct" class="form-label">Service ID</label>
            <input type="text" class="form-control" id="idProduct" name="id_product" value="<?php echo generateIdProduct() ?>" readonly required>
          </div>
          <div class="mb-3">
            <label for="nameProduct" class="form-label">Name</label>
            <input type="text" class="form-control" id="nameProduct" name="nama" placeholder="Service Name" required>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" value="Topup" type="radio" name="category" id="topup" checked>
              <label class="form-check-label" for="topup">
                Topup
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="Joki" type="radio" name="category" id="joki">
              <label class="form-check-label" for="joki">
                Joki
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label for="descriptionProduct" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="descriptionProduct" placeholder="Service Description" rows="3"></textarea>
          </div>
          <div class="mb-1">
            <div class="d-grid gap-2">
              <button class="btn btn-dark" type="submit" name="tambahProduk">Save</button>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-grid gap-2">
              <a href="../product" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<script>
  //preview image
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