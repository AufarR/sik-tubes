<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
    exit();
}
// Nama variabel yg diperlukan: userid (bukan pasienid), nik, nama, tgl_lahir (format string "DDDD-M-Y"), jenis_kelamin, alamat, no_telp, email, password
?>