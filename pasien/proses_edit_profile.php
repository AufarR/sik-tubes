<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
    exit();
}
// Lempar salah method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header('Location: /pasien');
    exit();
}
// Nama variabel yg diperlukan: userid (bukan pasienid), nik, nama, tgl_lahir (format string "DDDD-M-Y"), jenis_kelamin, alamat, no_telp, email, password

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

if (!isset($_POST['userid']) || !empty($_POST['userid'])) {
    http_response_code(400);
    break;
}

if (isset($_POST['nama']) && !empty($_POST['nama'])) {
    $sqlUpdate = "UPDATE pasien SET nama = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['nama'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['nik']) && !empty($_POST['nik'])) {
    $sqlUpdate = "UPDATE pasien SET nik = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['nik'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['tgl_lahir']) && !empty($_POST['tgl_lahir'])) {
    $sqlUpdate = "UPDATE pasien SET tgl_lahir = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['tgl_lahir'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['jenis_kelamin']) && !empty($_POST['jenis_kelamin'])) {
    $sqlUpdate = "UPDATE pasien SET jenis_kelamin = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['jenis_kelamin'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['alamat']) && !empty($_POST['alamat'])) {
    $sqlUpdate = "UPDATE pasien SET alamat = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['alamat'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['no_telp']) && !empty($_POST['no_telp'])) {
    $sqlUpdate = "UPDATE pasien SET no_telp = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['no_telp'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $sqlUpdate = "UPDATE pasien SET email = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $sqlUpdate = "UPDATE kredensial SET username = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $sqlUpdate = "UPDATE kredensial SET password = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $_POST['password'], $_POST['userid']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

break;

header('Location: /pasien');
?>