<?php
include "../koneksi/koneksi.php";
$koneksi = koneksi();

function cariAdmin($username)
{
  global $koneksi;
  $sql = "SELECT * FROM admin WHERE username='$username'";
  $hasil = mysqli_query($koneksi, $sql);
  $result = $hasil->fetch_assoc();

  if (mysqli_num_rows($hasil) > 0) {
    return $result;

    $baris = mysqli_fetch_assoc($hasil);
    $data['id'] = $baris['id'];
    $data['username'] = $baris['username'];
    $data['password'] = $baris['password'];
    mysqli_close($koneksi);
    return $data;
  } else {
    mysqli_close($koneksi);
    return null;
  }
}

function otentikasi($username, $password)
{
  $dataUser = array();
    $dataUser = cariAdmin($username);
    if ($dataUser != null) {
        $hashedPassword = $dataUser['password'];
        if (password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function editPassAdmin($id_admin, $username, $password)
{
    global $koneksi;

    $passwordBaruHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE admin SET username='$username', password='$passwordBaruHash' WHERE id='$id_admin'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}