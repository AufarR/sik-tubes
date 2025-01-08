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
// Nama2 variabel input: nama, tgl_exp (format string "DDDD-M-Y")
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

if (isset($_POST['nama'], $_POST['tgl_exp']) && 
    !empty($_POST['nama']) && !empty($_POST['tgl_exp'])) {
    
    $sqlInsert = "INSERT INTO obat (nama, tgl_exp) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ss", $_POST['nama'], $_POST['tgl_exp']);
    $stmtInsert->execute();
    $stmtInsert->close();
}

$conn->close();
header('Location: /farmasi');
?>
