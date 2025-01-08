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
// Nama2 variabel input: userid (bukan dokterid/pasienid/dsb.), role
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
switch ($_POST['role']) {
    case 'dokter':

        if (isset($_POST['userid']) && !empty($_POST['userid'])) {
            
            $sqlDelete = "DELETE FROM dokter WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

            $sqlDelete = "DELETE FROM kredensial WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

        } else {
            http_response_code(400);
        }

        break;
    case 'farmasi':
        
        if (isset($_POST['userid']) && !empty($_POST['userid'])) {
            
            $sqlDelete = "DELETE FROM farmasi WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

            $sqlDelete = "DELETE FROM kredensial WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

        } else {
            http_response_code(400);
        }

        break;
    case 'perawat':
        
        if (isset($_POST['userid']) && !empty($_POST['userid'])) {
            
            $sqlDelete = "DELETE FROM perawat WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

            $sqlDelete = "DELETE FROM kredensial WHERE userid = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $_POST['userid']);
            $stmtDelete->execute();
            $stmtDelete->close();

        } else {
            http_response_code(400);
        }

        break;
    default:
        http_response_code(400);
        break;
}

$conn->close();
header('Location: /admin');
?>