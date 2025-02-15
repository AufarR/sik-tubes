<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
    exit();
}
// Lempar salah method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header('Location: /admin');
    exit();
}

// Decode all POST data
foreach ($_POST as $key => $value) {
    $_POST[$key] = urldecode($value);
}

// Nama2 variabel input: role, nama, nid (nomor identitas: NIK/STR/SIP), no_telp, email, password
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

switch ($_POST['role']) {
    case 'dokter':

        if (isset($_POST['nama'], $_POST['nid'], $_POST['email'], $_POST['password']) && 
            !empty($_POST['nama']) && !empty($_POST['nid']) &&
            !empty($_POST['email']) && !empty($_POST['password'])) {
            
            $hashedPassword = hash('sha256', $_POST['password']);

            $sqlUser = "INSERT INTO kredensial (username, password, role) VALUES (?, ?, 'dokter')";
            $stmtUser = $conn->prepare($sqlUser);
            $stmtUser->bind_param("ss", $_POST['email'], $hashedPassword);
            $stmtUser->execute();
            
            $sqlInsert = "INSERT INTO dokter (nama, sip, no_telp, email, userid) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $userid = $stmtUser->insert_id;
            $stmtInsert->bind_param("ssssi", $_POST['nama'], $_POST['nid'], $_POST['no_telp'], $_POST['email'], $userid);
            $stmtInsert->execute();

            $stmtUser->close();
            $stmtInsert->close();
        }

        break;
    case 'farmasi':
        
        if (isset($_POST['nama'], $_POST['nid'], $_POST['email'], $_POST['password']) && 
            !empty($_POST['nama']) && !empty($_POST['nid']) &&
            !empty($_POST['email']) && !empty($_POST['password'])) {
            
            $hashedPassword = hash('sha256', $_POST['password']);

            $sqlUser = "INSERT INTO kredensial (username, password, role) VALUES (?, ?, 'farmasi')";
            $stmtUser = $conn->prepare($sqlUser);
            $stmtUser->bind_param("ss", $_POST['email'], $hashedPassword);
            $stmtUser->execute();
            
            $sqlInsert = "INSERT INTO farmasi (nama, str, no_telp, email, userid) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $userid = $stmtUser->insert_id;
            $stmtInsert->bind_param("ssssi", $_POST['nama'], $_POST['nid'], $_POST['no_telp'], $_POST['email'], $userid);
            $stmtInsert->execute();

            $stmtUser->close();
            $stmtInsert->close();
        }

        break;
    case 'perawat':
        
        if (isset($_POST['nama'], $_POST['nid'], $_POST['email'], $_POST['password']) && 
            !empty($_POST['nama']) && !empty($_POST['nid']) &&
            !empty($_POST['email']) && !empty($_POST['password'])) {
            
            $hashedPassword = hash('sha256', $_POST['password']);

            $sqlUser = "INSERT INTO kredensial (username, password, role) VALUES (?, ?, 'perawat')";
            $stmtUser = $conn->prepare($sqlUser);
            $stmtUser->bind_param("ss", $_POST['email'], $hashedPassword);
            $stmtUser->execute();
            
            $sqlInsert = "INSERT INTO perawat (nama, nik,  no_telp, email, userid) VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $userid = $stmtUser->insert_id;
            $stmtInsert->bind_param("ssssi", $_POST['nama'], $_POST['nid'], $_POST['no_telp'], $_POST['email'], $userid);
            $stmtInsert->execute();

            $stmtUser->close();
            $stmtInsert->close();
        }

        break;
    default:
        http_response_code(400);
        break;
}

$conn->close();
header('Location: /admin');
?>