<?php
function connectDB()
{
    $dbhost = "localhost";
    $dbuser = "sik";
    $dbpass = "sik";
    $db = "sik";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
?>