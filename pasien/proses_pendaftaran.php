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
// Nama variabel yg diperlukan: bookingid, dokterid, pasienid, keluhan
if (isset($_POST['bookingid'], $_POST['dokterid'], $_POST['pasienid'], $_POST['keluhan']) &&
    !empty($_POST['bookingid']) && !empty($_POST['dokterid']) && !empty($_POST['pasienid']) && !empty($_POST['keluhan'])) {

    $bookingid = $_POST['bookingid'];
    $dokterid = $_POST['dokterid'];
    $pasienid = $_POST['pasienid'];
    $keluhan = $_POST['keluhan'];

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Insert to pemeriksaan
    $stmt = $conn->prepare("INSERT INTO pemeriksaan (bookingid, dokterid, pasienid, keluhan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $bookingid, $dokterid, $pasienid, $keluhan);
    $stmt->execute();

    // Update booking status
    $stmt2 = $conn->prepare("UPDATE booking SET status = 1 WHERE id = ?");
    $stmt2->bind_param("i", $bookingid);
    $stmt2->execute();

    // Close the statement and connection
    $stmt->close();
    $stmt2->close();
    $conn->close();
    
} else {
    // Handle missing input
    http_response_code(400);
}

header('Location: /pasien');
?>