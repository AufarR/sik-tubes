<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
}
// Nama2 variabel input: userid (bukan dokterid/pasienid/dsb.), role
?>