<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Create connection
    include_once("../lib/connection.php");
    $conn = connectDB();

    // Get data from user table
    $stmt = $conn->prepare("SELECT * FROM kredensial where username = ? ");
    $stmt->bind_param('s', $_POST["email"]);
    $stmt->execute();

    // Bind result 
    $stmt->bind_result($dbid, $dbusername, $dbpassword, $dbrole);

    // Fetch data
    $stmt->fetch();
    if (hash('sha256', $_POST["password"]) == $dbpassword) {
        session_start();
        $_SESSION["userid"] = $dbid;
        $_SESSION["username"] = $_POST["email"];
        $_SESSION["role"] = $dbrole;
    };

    $stmt->close();
    $conn->close();
}
header('Location: /auth/login.php');
?>