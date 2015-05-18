<?php

$servername = "localhost";
$username = "innovative_ekomi";
$password = "ekomi2";
$db = "innovative_ekomi";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
?> 