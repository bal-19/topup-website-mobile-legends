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
  $id_produk = $_GET['id'];
  function generateIdDataProduct()
  {
    global $koneksi;

    $query = "SELECT id_data_produk FROM data_produk ORDER BY id_data_produk DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);
    $kode = "ZD001";

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $kodeTerakhir = $row['id_data_produk'];

      if ($kodeTerakhir) {
        $angkaTerakhir = substr($kodeTerakhir, 2);
        $angkaBaru = intval($angkaTerakhir) + 1;
        $kode = "ZD" . str_pad($angkaBaru, 3, '0', STR_PAD_LEFT);
      } else {
        $kode = "ZD001";
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
        Add Data Service
      </div>
      <div class="card-body">
        <form action="../../../proses/data-product.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
          <div class="mb-3">
            <label for="idData" class="form-label">Data Service ID</label>
            <input type="text" class="form-control" id="idData" name="id_data" value="<?php echo generateIdDataProduct() ?>" readonly required>
          </div>
          <div class="mb-3">
            <label for="nameProduct" class="form-label">Name</label>
            <input type="text" class="form-control" id="nameProduct" name="nama" placeholder="Data Service Name" required>
          </div>
          <div class="mb-3">
            <label for="descriptionProduct" class="form-label">Price</label>
            <input type="number" class="form-control" name="harga" id="descriptionProduct" placeholder="Data Service Price">
          </div>
          <div class="mb-1">
            <div class="d-grid gap-2">
              <button class="btn btn-dark" type="submit" name="tambahData">Save</button>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-grid gap-2">
              <a href="../data-product" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php
    $sql = "SELECT * FROM data_produk WHERE id_produk='$id_produk'";
    $result = koneksi()->query($sql);
    koneksi()->close();

    if (mysqli_num_rows($result) > 0) {
    ?>

      <div class="mt-4">
        <form action="../../../proses/data-product.php" method="post">
          <div class="table-responsive">
            <table class="table table-light table-striped text-center align-middle table-hover" id="dataTable">
              <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Data Service ID</th>
                  <th class="text-center">Service ID</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['id_data_produk'] ?></td>
                    <td><?php echo $row['id_produk'] ?></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo "Rp " . number_format($row['harga_produk'], 0, ",", "."); ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_data_produk'] ?>">
                        <i class="fa-solid fa-pencil fa-lg"></i>
                      </button>
                      <button class="btn btn-danger" name="deleteData" value="<?php echo $row['id_data_produk'] ?>" onclick="return confirm('Are you sure you want to delete it?')">
                        <i class="fa-solid fa-trash-can fa-lg"></i>
                      </button>
                    </td>
                  </tr>
        </form>

        <div class="modal fade" data-bs-backdrop="static" style="width: 105vw;" id="editModal<?php echo $row['id_data_produk'] ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form untuk mengedit data -->
                <form action="../../../proses/data-product.php" method="post">
                  <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
                  <div class="mb-3">
                    <label for="dataId" class="form-label">Data Service ID</label>
                    <input type="text" class="form-control" id="dataId" name="id_data" placeholder="Data Service ID" value="<?php echo $row['id_data_produk'] ?>" readonly required>
                  </div>
                  <div class="mb-3">
                    <label for="dataName" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="dataName" name="nama" placeholder="Data Service Name" value="<?php echo $row['nama'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="dataPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" id="dataPrice" name="harga" placeholder="Data Service Price" value="<?php echo $row['harga_produk'] ?>" required>
                  </div>
                  <button type="submit" name="editData" class="form-control btn btn-dark">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    <?php
                  $no++;
                }
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
    </tbody>
    </table>
      </div>
      <!-- </form> -->
  </div>
  </div>
</body>
<script>
  setInterval(function() {
    document.querySelectorAll(".modal-backdrop.fade.show").forEach(x => x.style.width = "105vw")
  }, 100)
  new DataTable('#dataTable', {
    initComplete: function() {
      this.api()
        .columns()
        .every(function() {
          let column = this;
          let title = column.footer().textContent;

          let input = document.createElement('input');
          input.placeholder = title;
          column.footer().replaceChildren(input);

          input.addEventListener('keyup', () => {
            if (column.search() !== this.value) {
              column.search(input.value).draw();
            }
          });
        });
    }
  });
</script>

</html>