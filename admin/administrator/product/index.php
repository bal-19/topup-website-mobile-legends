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

$sql = "SELECT * FROM produk";
$result = koneksi()->query($sql);
koneksi()->close();
?>

<body id="body-pd">
  <div class="height-100">
    <h4>Table Service</h4>
    <form action="../../../proses/product.php" method="post">
      <div class="table-responsive">
        <table class="table table-light table-striped text-center align-middle table-hover" id="dataTable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Image</th>
              <th class="text-center">Service ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">Category</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $no = 1;

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>

                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo '<img class="img-fluid" width="100" src="data:../../image/product/;base64,' . base64_encode($row['gambar']) . '" />';?></td>
                  <td><?php echo $row['id_produk'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['genre'] ?></td>
                  <td>
                    <a href="edit.php?id=<?php echo $row['id_produk'] ?>" class="btn btn-warning" name="editProduct">
                      <i class="fa-solid fa-pencil fa-lg"></i>
                    </a>
                    <button class="btn btn-danger" name="deleteProduct" value="<?php echo $row['id_produk'] ?>" onclick="return confirm('Are you sure you want to delete it?')">
                      <i class="fa-solid fa-trash-can fa-lg"></i>
                    </button>
                  </td>
                </tr>
            <?php
                $no++;
              }
            }
            ?>
          </tbody>
        </table>
        <a href="add.php" class="mt-1 btn btn-success" type="submit">Add Service</a>
      </div>
    </form>
  </div>
</body>

<script>
  new DataTable('#dataTable');

</script>
</html>