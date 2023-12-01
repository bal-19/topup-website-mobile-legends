<?php
function koneksi()
{
  $koneksi = mysqli_connect("localhost", "root", "", "dbtopup");

  if (!$koneksi) {
    die("Koneksi Gagal : " . mysqli_connect_error());
  }
  return $koneksi;
}
