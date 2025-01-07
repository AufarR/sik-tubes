<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
}
// Nama variabel yg diperlukan: bookingid, dokterid, pasienid, keluhan
?>