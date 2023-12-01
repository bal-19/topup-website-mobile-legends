<?php
require_once "../koneksi/koneksi.php";
$koneksi = koneksi();

function cariUser($no_handphone)
{
    global $koneksi;
    $sql = "SELECT * FROM user WHERE no_handphone='$no_handphone'";
    $hasil = mysqli_query($koneksi, $sql);
    $result = $hasil->fetch_assoc();

    if (mysqli_num_rows($hasil) > 0) {
        return $result;

        $baris = mysqli_fetch_assoc($hasil);
        $data['id_user'] = $baris['id_user'];
        $data['nama'] = $baris['nama'];
        $data['no_handphone'] = $baris['no_handphone'];
        $data['password'] = $baris['password'];
        mysqli_close($koneksi);
        return $data;
    } else {
        mysqli_close($koneksi);
        return null;
    }
}

function otentikasi($no_handphone, $password)
{
    $dataUser = array();
    $dataUser = cariUser($no_handphone);
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

function register($nama, $no_handphone, $password)
{
    global $koneksi;

    $query = "SELECT * FROM user WHERE no_handphone = '$no_handphone'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        return false;
    } else {
        $query = "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $kodeTerakhir = $row['id_user'];

        if ($kodeTerakhir) {
            $angkaTerakhir = substr($kodeTerakhir, 2);
            $angkaBaru = intval($angkaTerakhir) + 1;
            $kode = "ZC" . str_pad($angkaBaru, 4, '0', STR_PAD_LEFT);
        } else {
            $kode = "ZC0001";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $hasil = 0;
        $query = "INSERT INTO user VALUES ('$kode', '$nama', '$no_handphone', '$passwordHash')";

        if (mysqli_query($koneksi, $query))
            $hasil = 1;
        mysqli_close($koneksi);
        return $hasil;
    }
}

function editUser($id_user, $nama)
{
    global $koneksi;

    $sql = "UPDATE user SET nama='$nama' WHERE id_user='$id_user'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

function editPassUser($id_user, $password)
{
    global $koneksi;

    $passwordBaruHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET password='$passwordBaruHash' WHERE id_user='$id_user'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

function deleteUser($id_user)
{
    global $koneksi;

    $sql = "DELETE FROM user WHERE id_user='$id_user'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

function editUserByAdmin($id_user, $nama, $no_handphone)
{
    global $koneksi;

    $sql = "UPDATE user SET nama='$nama', no_handphone='$no_handphone' WHERE id_user='$id_user'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}