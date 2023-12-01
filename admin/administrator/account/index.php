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

$sql = "SELECT * FROM user";
$result = koneksi()->query($sql);
koneksi()->close();
?>

<body id="body-pd">
  <div class="height-100">
    <h4>Table User</h4>
    <form action="../../../proses/edit-user.php" method="post">
      <div class="table-responsive">
        <table class="table table-light table-striped text-center align-middle table-hover" id="dataTable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">User ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">No Handphone</th>
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
                  <td><?php echo $row['id_user'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['no_handphone'] ?></td>
                  <td>
                    <a href="edit.php?id=<?php echo $row['id_user'] ?>" class="btn btn-warning" name="editUser">
                      <i class="fa-solid fa-pencil fa-lg"></i>
                    </a>
                    <button class="btn btn-danger" name="deleteUser" value="<?php echo $row['id_user'] ?>" onclick="return confirm('Are you sure you want to delete it?')">
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
      </div>
    </form>
  </div>
</body>

<script>
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