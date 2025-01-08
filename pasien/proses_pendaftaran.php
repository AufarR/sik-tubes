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
// Nama variabel yg diperlukan: bookingid, keluhan
if (isset($_POST['bookingid'], $_POST['keluhan']) &&
    !empty($_POST['bookingid']) && !empty($_POST['keluhan'])) {

    $bookingid = $_POST['bookingid'];
    $keluhan = $_POST['keluhan'];

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Fetch pasienid from pasien table
    $stmt = $conn->prepare("SELECT id FROM pasien WHERE userid = ?");
    $stmt->bind_param("i", $_SESSION["userid"]);
    $stmt->execute();
    $stmt->bind_result($pasienid);
    $stmt->fetch();
    $stmt->close();

    // Fetch dokterid from booking table
    $stmt = $conn->prepare("SELECT dokterid FROM booking WHERE id = ?");
    $stmt->bind_param("i", $bookingid);
    $stmt->execute();
    $stmt->bind_result($dokterid);
    $stmt->fetch();
    $stmt->close();

    // Insert to pemeriksaan
    $stmt = $conn->prepare("INSERT INTO pemeriksaan (bookingid, dokterid, pasienid, keluhan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $bookingid, $dokterid, $pasienid, $keluhan);
    $stmt->execute();

    // Update booking status
    $stmt2 = $conn->prepare("UPDATE booking SET status = 1 WHERE id = ?");
    $stmt2->bind_param("i", $bookingid);
    $stmt2->execute();

    // Close connection
    $stmt->close();
    $stmt2->close();
    $conn->close();
}
?>