<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'dokter') {
    header('Location: /auth/login.php');
    exit();
}
// Lempar salah method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header('Location: /dokter');
    exit();
}
/* Nama2 variabel input:
    - id (id pemeriksaan)
    - diagnosis (string panjang isinya kode2 ICD digabungin jd satu string dipisah titik koma ";". Beda2 spasi dikit gapapa
                 Contoh: "A00.0 Kolera disebabkan Vibrio cholerae 01, biovar cholerae ;A01.0 Demam tifoid")
    - obat (daftar obat dipisah titik koma ";" mirip diagnosis)
    - catatan (string catatan)
*/
if (isset($_POST['id'], $_POST['diagnosis'], $_POST['obat']) &&
    !empty($_POST['id']) && !empty($_POST['diagnosis']) &&
    !empty($_POST['obat'])) {

    $id = $_POST['id'];
    $diagnosis = $_POST['diagnosis'];
    $obat = $_POST['obat'];
    $catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE pemeriksaan SET diagnosis = ?, obat = ?, catatan = ? WHERE id = ?");
    $stmt->bind_param("sssi", $diagnosis, $obat, $catatan, $id);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
} else {
    // Handle missing input
    http_response_code(400);
}

header('Location: /dokter');
?>