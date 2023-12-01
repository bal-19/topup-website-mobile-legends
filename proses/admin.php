<?php
include '../crud/admin.php';
session_start();

if (isset($_POST['ubahProfileUser'])) {
  $id_admin = $_POST['ubahProfileUser'];
  $user = $_POST['username'];
  $passlama = $_POST['oldpassword'];
  $passbaru = $_POST['password'];
  $konfirmpass = $_POST['konfirmPass'];
  $username = $_SESSION['username']; 
  $dataAdmin = array();
  $dataAdmin = cariAdmin($username);
  $passlamaDb = $dataAdmin['password'];

  if (password_verify($passlama, $passlamaDb)) {
    if ($passbaru == $konfirmpass) {
      $hasil = editPassAdmin($id_admin, $user, $passbaru);
      if ($hasil != 0) {
        echo "<script type='text/javascript'>
                alert('Success to Edit');
                window.location='../admin/administrator/settings';  
            </script>";
      } else {
        echo "<script type='text/javascript'>
                alert('Failed to Edit');
                window.location='../admin/administrator/settings';  
            </script>";
      }
    } else {
      header('Location: ../admin/administrator/settings/index.php?err');
    }
  } else {
    header('Location: ../admin/administrator/settings/index.php?error');
  }
}
