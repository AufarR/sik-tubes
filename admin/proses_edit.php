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
// Nama2 variabel input: userid (bukan dokterid/pasienid/dsb.), role, nama, nid (nomor identitas: NIK/STR/SIP), no_telp, email, password
// Klw ada yg dikosongin/ga ada brrt ga diubah tp userid & role wajib yahh

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

switch ($_POST['role']) {
    case 'dokter':

        if (!isset($_POST['userid']) || !empty($_POST['userid'])) {
            http_response_code(400);
            break;
        }

        if (isset($_POST['nama']) && !empty($_POST['nama'])) {
            $sqlUpdate = "UPDATE dokter SET nama = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nama'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['nid']) && !empty($_POST['nid'])) {
            $sqlUpdate = "UPDATE dokter SET sip = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nid'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['no_telp']) && !empty($_POST['no_telp'])) {
            $sqlUpdate = "UPDATE dokter SET no_telp = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['no_telp'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $sqlUpdate = "UPDATE dokter SET email = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            $sqlUpdate = "UPDATE kredensial SET username = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $sqlUpdate = "UPDATE kredensial SET password = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['password'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        break;
    case 'farmasi':
        
        if (!isset($_POST['userid']) || !empty($_POST['userid'])) {
            http_response_code(400);
            break;
        }
        
        if (isset($_POST['nama']) && !empty($_POST['nama'])) {
            $sqlUpdate = "UPDATE farmasi SET nama = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nama'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['nid']) && !empty($_POST['nid'])) {
            $sqlUpdate = "UPDATE farmasi SET str = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nid'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['no_telp']) && !empty($_POST['no_telp'])) {
            $sqlUpdate = "UPDATE farmasi SET no_telp = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['no_telp'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $sqlUpdate = "UPDATE farmasi SET email = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            $sqlUpdate = "UPDATE kredensial SET username = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $sqlUpdate = "UPDATE kredensial SET password = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['password'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        break;
    case 'perawat':
        
        if (!isset($_POST['userid']) || !empty($_POST['userid'])) {
            http_response_code(400);
            break;
        }
        
        if (isset($_POST['nama']) && !empty($_POST['nama'])) {
            $sqlUpdate = "UPDATE perawat SET nama = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nama'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['nid']) && !empty($_POST['nid'])) {
            $sqlUpdate = "UPDATE perawat SET nik = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['nid'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['no_telp']) && !empty($_POST['no_telp'])) {
            $sqlUpdate = "UPDATE perawat SET no_telp = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['no_telp'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $sqlUpdate = "UPDATE perawat SET email = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            $sqlUpdate = "UPDATE kredensial SET username = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['email'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $sqlUpdate = "UPDATE kredensial SET password = ? WHERE userid = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $_POST['password'], $_POST['userid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        break;
    default:
        http_response_code(400);
        break;
}

$conn->close();
header('Location: /admin');
?>