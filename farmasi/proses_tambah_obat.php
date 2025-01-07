<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
    exit();
}
// Nama2 variabel input: nama, tgl_exp (format string "DDDD-M-Y")
?>
