<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
    exit();
}
// Nama2 variabel input: role, nama, nid (nomor identitas: NIK/STR/SIP), email, password
?>