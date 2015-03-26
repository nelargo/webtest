<?php
$servername = "mysql.madgoatstd.com";
$username = "rootgoat";
$password = "123pichula";
$dbname = "madgoatdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>