<?php
include "../koneksi/koneksi.php";
$koneksi = koneksi();

function deletePayment($id_payment){
    global $koneksi;

    $sql = "DELETE FROM pembayaran WHERE id_pembayaran='$id_payment'";
    $hasil = 0;
    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
    }
    mysqli_close($koneksi);
    return $hasil;
}

function editPayment($id_pembayaran, $nama, $gambar)
{
    global $koneksi;

    $sql = "UPDATE pembayaran SET nama_pembayaran=?, gambar=? WHERE id_pembayaran=?";
    $hasil = 0;

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $nama, $gambar, $id_pembayaran);

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
