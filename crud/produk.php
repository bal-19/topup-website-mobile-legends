<?php
require_once "../koneksi/koneksi.php";
$koneksi = koneksi();

function generateIdProduct()
{
    global $koneksi;

    $query = "SELECT id_produk FROM produk ORDER BY id_produk DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);
  
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $kodeTerakhir = $row['id_produk'];

      if($kodeTerakhir) {
      $angkaTerakhir = substr($kodeTerakhir, 2);
            $angkaBaru = intval($angkaTerakhir) + 1;
            $kode = "ZP" . str_pad($angkaBaru, 4, '0', STR_PAD_LEFT);
        } else {
            $kode = "ZP0001";
        }
  
    mysqli_close($koneksi);
  
    return $kode;

    // $query = "SELECT * FROM user WHERE no_handphone = '$no_handphone'";
    // $result = mysqli_query($koneksi, $query);

    // if (mysqli_num_rows($result) > 0) {
    //     return false;
    // } else {
    //     $query = "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1";
    //     $result = mysqli_query($koneksi, $query);
    //     $row = mysqli_fetch_assoc($result);
    //     $kodeTerakhir = $row['id_user'];

    //     if ($kodeTerakhir) {
    //         $angkaTerakhir = substr($kodeTerakhir, 2);
    //         $angkaBaru = intval($angkaTerakhir) + 1;
    //         $kode = "ZC" . str_pad($angkaBaru, 4, '0', STR_PAD_LEFT);
    //     } else {
    //         $kode = "ZC0001";
    //     }

    //     $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //     $hasil = 0;
    //     $query = "INSERT INTO user VALUES ('$kode', '$nama', '$no_handphone', '$passwordHash')";

    //     if (mysqli_query($koneksi, $query))
    //         $hasil = 1;
    //     mysqli_close($koneksi);
    //     return $hasil;
    }
}

function editProduk($id_produk, $nama, $gambar, $genre, $deskripsi)
{
    global $koneksi;

    $sql = "UPDATE produk SET nama=?, gambar=?, genre=?, deskripsi=? WHERE id_produk=?";
    $hasil = 0;

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $gambar, $genre, $deskripsi, $id_produk);

        if (mysqli_stmt_execute($stmt)) {
            $hasil = 1;
        } else {
            echo "Gagal melakukan pembaruan: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal membuat prepared statement: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
    return $hasil;
}

function deleteProduk($id_produk)
{
    global $koneksi;

    $sql = "DELETE FROM produk WHERE id_produk='$id_produk'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    // mysqli_close($koneksi);
    return $hasil;
}

function deleteDataProdukByProduk($id_produk)
{
    global $koneksi;

    $sql = "DELETE FROM data_produk WHERE id_produk='$id_produk'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

