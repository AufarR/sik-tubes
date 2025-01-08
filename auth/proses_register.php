<?php
// Nama variabel yg diperlukan: nik, nama, tgl_lahir (format string "DDDD-M-Y"), jenis_kelamin, alamat, no_telp, email, password
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Decode all POST data
    foreach ($_POST as $key => $value) {
        $_POST[$key] = urldecode($value);
    }

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Add to credentials table
    $stmt = $conn->prepare("INSERT INTO kredensial (username, password, role) VALUES (?, ?,'pasien')");
    $stmt->bind_param("ss", $_POST["email"], hash('sha256', $_POST["password"]));
    $stmt->execute();
    $userid = $stmt->insert_id;

    // Add to users table
    $stmt2 = $conn->prepare("INSERT INTO pasien (nik, nama, tgl_lahir, jenis_kelamin, alamat, no_telp, email, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssssssi", $_POST["nik"], $_POST["nama"], $_POST["tgl_lahir"], $_POST["jenis_kelamin"], $_POST["alamat"], $_POST["no_telp"], $_POST["email"], $userid);
    $stmt2->execute();

    $stmt->close();
    $stmt2->close();

    $conn->close();
}
header('Location: /auth/login.php');
?>