<?php
include "../koneksi/koneksi.php";
$koneksi = koneksi();

function deleteSlider($id_slider){
    global $koneksi;

    $sql = "DELETE FROM slide WHERE id_slide='$id_slider'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

function editSlider($id_slider, $nama, $gambar)
{
    global $koneksi;

    $sql = "UPDATE slide SET nama=?, gambar=? WHERE id_slide=?";
    $hasil = 0;

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $nama, $gambar, $id_slider);

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
