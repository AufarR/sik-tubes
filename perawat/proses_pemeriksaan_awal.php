<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'perawat') {
    header('Location: /auth/login.php');
}
?>