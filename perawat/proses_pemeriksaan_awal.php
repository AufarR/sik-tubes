<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'perawat') {
    header('Location: /auth/login.php');
    exit();
}
// Lempar salah method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header('Location: /perawat');
    exit();
}

// Decode all POST data
foreach ($_POST as $key => $value) {
    $_POST[$key] = urldecode($value);
}
// Nama variabel yg diperlukan: id (ID pemeriksaan), sistol, diastol, heart_rate, tinggi, berat, suhu

if (isset($_POST['id'], $_POST['sistol'], $_POST['diastol'], $_POST['heart_rate'], $_POST['tinggi'], $_POST['berat'], $_POST['suhu']) &&
    !empty($_POST['id']) && !empty($_POST['sistol']) && !empty($_POST['diastol']) && !empty($_POST['heart_rate']) &&
    !empty($_POST['tinggi']) && !empty($_POST['berat']) && !empty($_POST['suhu'])) {

    $id = $_POST['id'];
    $sistol = $_POST['sistol'];
    $diastol = $_POST['diastol'];
    $heart_rate = $_POST['heart_rate'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $suhu = $_POST['suhu'];

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE pemeriksaan SET status = 1, sistol = ?, diastol = ?, heart_rate = ?, tinggi = ?, berat = ?, suhu = ? WHERE id = ?");
    $stmt->bind_param("iiidddi", $sistol, $diastol, $heart_rate, $tinggi, $berat, $suhu, $id);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
} else {
    // Handle missing input
    http_response_code(400);
}

header('Location: /perawat');
?>