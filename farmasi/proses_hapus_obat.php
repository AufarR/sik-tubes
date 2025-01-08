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
// Nama2 variabel input: id
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

if (isset($_POST['id']) && !empty($_POST['id'])) {
    
    $sqlDelete = "DELETE FROM obat WHERE id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $_POST['id']);
    $stmtDelete->execute();
    $stmtDelete->close();

} else {
    http_response_code(400);
}

$conn->close();
header('Location: /farmasi');
?>
