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

$sql = 'SELECT * FROM admin';
$result = koneksi()->query($sql);
koneksi()->close();

$row = $result->fetch_assoc();
$id = $row['id'];
$user = $row['username'];
$pass = $row['password'];
?>

<body id="body-pd">
  <div class="height-100">
    <h4>Settings</h4>
    <form action="../../../proses/admin.php" method="post">
      <div class="row mt-4">
        <div class="col">
          <div class="card bg-light shadow-sm text-black">
            <div class="card-header">
              <h5 class="card-title mt-2">Edit Profile</h5>
            </div>
            <div class="card-body">
              <div id="userData">
                <div class="row row-cols row-cols-md">
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="userId">Username</label>
                      <input class="form-control" value="<?php echo $user ?>" placeholder="Enter Username" type="text" name="username" id="userId" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="serverid">Old Password</label>
                      <input class="form-control" placeholder="Enter Old Password" type="password" name="oldpassword" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="serverid">New Password</label>
                      <input class="form-control" placeholder="Enter New Password" type="password" name="password" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label for="userId">Confirm Password</label>
                    <input class="form-control" placeholder="Enter New Password" type="password" name="konfirmPass" required>
                  </div>
                </div>
                <div class="form-group mb-1">
                  <button type="submit" value="<?php echo $id ?>" name="ubahProfileUser" class="btn btn-dark btn-block">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
  </div>
</body>

</html>