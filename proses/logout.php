<?php

if (array_key_exists('logoutAdmin', $_POST)) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../admin/");
} else {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../account/auth/login.php");
}
