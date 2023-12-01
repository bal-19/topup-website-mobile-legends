<?php
include '../crud/user.php';
session_start();

if (isset($_POST['ubahPassUser'])) {
  $passLama = $_POST['passLama'];
  $passBaru = $_POST['passBaru'];
  $konfirmasiPass = $_POST['konfirmPass'];
  $id = $_SESSION['id'];
  $no_handphone = $_SESSION['no_handphone'];

  $dataUser = array();
  $dataUser = cariUser($no_handphone);
  $passLamaDb = $dataUser['password'];

  if (password_verify($passLama, $passLamaDb)) {
    if ($passBaru == $konfirmasiPass) {
      $hasil = editPassUser($id, $passBaru);
      if ($hasil != 0) {
        header('Location: ../proses/logout.php');
      } else {
        echo "<script type='text/javascript'>
            alert('Gagal di Edit');
            window.location='../account';  
        </script>";
      }
    } else {
      header('Location: ../account/index.php?err');
    }
  } else {
    header('Location: ../account/index.php?error');
  }
}

if (isset($_POST['editUser'])) {
  $id_user = $_POST['id_user'];
  $nama = $_POST['nama'];
  $no_handphone = $_POST['no_handphone'];

  $hasil = editUserByAdmin($id_user, $nama, $no_handphone);
  if ($hasil != 0) {
    header("Location: ../admin/administrator/account");
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Edit');
            window.location='../admin/administrator/account';  
        </script>";
  }
}

if (isset($_POST['deleteUser'])) {
  $id_user = $_POST['deleteUser'];
  $hasil = deleteUser($id_user);
  if ($hasil != 0) {
    header("Location: ../admin/administrator/account");
  } else {
    echo "<script type='text/javascript'>
            alert('Failed to Delete');
            window.location='../admin/administrator/account';  
        </script>";
  }
}
