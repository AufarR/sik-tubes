<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
    exit();
}
// Lempar salah method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header('Location: /farmasi');
    exit();
}
// Nama2 variabel input: id, nama, tgl_exp (format string "DDDD-M-Y")
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

if (isset($_POST['id'], $_POST['nama'], $_POST['tgl_exp']) && 
    !empty($_POST['id']) && !empty($_POST['nama']) && !empty($_POST['tgl_exp'])) {
    
    $sqlUpdate = "UPDATE obat SET nama = ?, tgl_exp = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssi", $_POST['nama'], $_POST['tgl_exp'], $_POST['id']);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

$conn->close();
header('Location: /farmasi');
?>
