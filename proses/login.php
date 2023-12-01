<?php
    session_start();

    if (array_key_exists('loginAdmin', $_POST)) {
    include "../crud/admin.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    

    if (otentikasi($username, $password)) {
        $_SESSION['username'] = $username;
        $dataAdmin = array();
        $dataAdmin = cariAdmin($username);
        $id_admin = $dataAdmin['id'];
        $_SESSION['id_admin'] = $id_admin;
        header("Location: ../admin/");
    } else {
        header("Location: ../admin/auth/login.php?error");
    }
}

if (array_key_exists('loginUser', $_POST)) {
    include "../crud/user.php";

    $no_handphone = $_POST['no_handphone'];
    $password = $_POST['password'];

    if (otentikasi($no_handphone, $password)) {
        $_SESSION['no_handphone'] = $no_handphone;
        $dataUser = array();
        $dataUser = cariUser($no_handphone);
        $nama = $dataUser['nama'];
        $id_user = $dataUser['id_user'];
        $_SESSION['id'] = $id_user;
        header("Location: ../");
    } else {
        header("Location: ../account/auth/login.php?error");
    }
}
