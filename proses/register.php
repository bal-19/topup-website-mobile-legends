<?php
    include "../crud/user.php";

    $nama = $_POST['nama'];
    $no_handphone = $_POST['no_handphone'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($password == $konfirmasi) {
        $hasil = register($nama, $no_handphone, $password);
        if($hasil != 0) {
            echo "<script type='text/javascript'>
                    alert('Berhasil Daftar');
                    window.location='../account/auth/login.php';
                </script>";
        } else {
            header("Location: ../account/auth/register.php?error");
        }
    } else {
        header("Location: ../account/auth/register.php?notsame");
    }