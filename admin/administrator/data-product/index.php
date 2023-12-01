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
    <h4>Table Product</h4>
    <form action="../../../proses/product.php" method="post">
      <div class="table-responsive">
        <table class="table table-light table-striped text-center align-middle table-hover" id="dataTable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Image</th>
              <th class="text-center">Product ID</th>
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
                  <td><?php echo '<img class="img-fluid" width="100" src="data:../../../image/product/;base64,' . base64_encode($row['gambar']) . '" />';?></td>
                  <td><?php echo $row['id_produk'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['genre'] ?></td>
                  <td>
                    <a href="add.php?id=<?php echo $row['id_produk'] ?>" class="btn btn-success" name="addData">
                    <i class="fa-solid fa-plus fa-lg"></i>
                    </a>
                  </td>
                </tr>
            <?php
                $no++;
              }
            }
            ?>
          </tbody>
        </table>
    </form>
  </div>
</body>

<script>
  new DataTable('#dataTable');

</script>
</html>