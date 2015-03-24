<?php
$servername = "localhost";
$username = "root";
$password = "DevonEdwards";
$db = "thebestgameever";

$name = $_POST["Name"];
$feature = $_POST["Feature"];
$cost = $_POST["Cost"];


// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

