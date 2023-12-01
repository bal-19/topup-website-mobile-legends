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

$id_user = $_GET['id'];
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$result = koneksi()->query($sql);
koneksi()->close();

$row = $result->fetch_assoc();
$id_user = $row['id_user'];
$nama = $row['nama'];
$no_handphone = $row['no_handphone'];
?>

<body id="body-pd">
  <div class="height-100">
    <div class="card">
      <div class="card-header">Edit Account
      </div>
      <div class="card-body">
        <form action="../../../proses/edit-user.php" method="post">
          <div class="mb-3">
            <label for="idUser" class="form-label">User ID</label>
            <input type="text" class="form-control" id="idUser" name="id_user" value="<?php echo $id_user ?>" readonly required>
          </div>
          <div class="mb-3">
            <label for="nameUser" class="form-label">Name</label>
            <input type="text" class="form-control" id="nameUser" name="nama" value="<?php echo $nama ?>" placeholder="" required>
          </div>
          <div class="mb-3">
            <label for="handphoneUser" class="form-label">No Handphone</label>
            <input type="text" class="form-control" id="handphoneUser" name="no_handphone" value="<?php echo $no_handphone ?>" minlength="12" maxlength="12" placeholder="08xxxxxxxx" required>
          </div>
          <div class="mb-1">
            <div class="d-grid gap-2">
              <button class="btn btn-dark" type="submit" name="editUser">Save</button>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-grid gap-2">
              <a href="../account" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>