<?php
function connectDB()
{
    $dbhost = "localhost";
    $dbuser = "sik";
    $dbpass = "sik";
    $db = "sik";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
?>