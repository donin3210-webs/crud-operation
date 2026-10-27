<?php

$locahost = "localhost";
$user = "root";
$pass = "";
$db = "crud_db";

$conn = new mysqli($locahost, $user, $pass, $db);

// Stop and show the reason if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>