<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Get data from user table
    $stmt = $conn->prepare("SELECT * FROM login where username = ? ");
    $stmt->bind_param('s',$_POST["username"]);
    $stmt->execute();

    // Bind result 
    $stmt->bind_result($db_hash);

    // Fetch data
    $stmt->fetch();
    if (hash('sha256', $_POST["password"]) == $db_hash['password']) {
        session_start();
        $_SESSION["userid"] = $db_hash['userid'];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["role"] = $db_hash['role'];
    };

    $stmt->close();
    $conn->close();
}
header('Location: /auth/login.php');
?>