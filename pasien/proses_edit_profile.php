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
// Nama variabel yg diperlukan: id (bukan pasienid), nik, nama, tgl_lahir (format string "DDDD-M-Y"), jenis_kelamin, alamat, no_telp, email, password

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

if (!isset($_POST['id']) || empty($_POST['id'])) {
    http_response_code(400);
    header('Location: /pasien');
    die();
}

$id = urldecode($_POST['id']);
$nik = isset($_POST['nik']) ? urldecode($_POST['nik']) : null;
$nama = isset($_POST['nama']) ? urldecode($_POST['nama']) : null;
$tgl_lahir = isset($_POST['tgl_lahir']) ? urldecode($_POST['tgl_lahir']) : null;
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? urldecode($_POST['jenis_kelamin']) : null;
$alamat = isset($_POST['alamat']) ? urldecode($_POST['alamat']) : null;
$no_telp = isset($_POST['no_telp']) ? urldecode($_POST['no_telp']) : null;
$email = isset($_POST['email']) ? urldecode($_POST['email']) : null;
$password = isset($_POST['password']) ? urldecode($_POST['password']) : null;

$sqlSelect = "SELECT userid FROM pasien WHERE id = ?";
$stmtSelect = $conn->prepare($sqlSelect);
$stmtSelect->bind_param("i", $id);
$stmtSelect->execute();
$stmtSelect->bind_result($userid);
$stmtSelect->fetch();
$stmtSelect->close();

if ($nama) {
    $sqlUpdate = "UPDATE pasien SET nama = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $nama, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($nik) {
    $sqlUpdate = "UPDATE pasien SET nik = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $nik, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($tgl_lahir) {
    $sqlUpdate = "UPDATE pasien SET tgl_lahir = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $tgl_lahir, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($jenis_kelamin) {
    $sqlUpdate = "UPDATE pasien SET jenis_kelamin = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $jenis_kelamin, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($alamat) {
    $sqlUpdate = "UPDATE pasien SET alamat = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $alamat, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($no_telp) {
    $sqlUpdate = "UPDATE pasien SET no_telp = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $no_telp, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

if ($email) {
    $sqlUpdate = "UPDATE pasien SET email = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $email, $id);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $sqlUpdate = "UPDATE kredensial SET username = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $email, $userid);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $_SESSION['username'] = $email;
}

if ($password) {
    $sqlUpdate = "UPDATE kredensial SET password = ? WHERE userid = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $hashed_password = hash('sha256', $password);
    $stmtUpdate->bind_param("si", $hashed_password, $userid);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

header('Location: /pasien');
?>