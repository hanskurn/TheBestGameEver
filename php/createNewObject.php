<?php
session_start();
$id = $_SESSION['id'];

$servername = "127.0.0.1:3306";
$username = "root";
$password = "Asd123890";
$db = "thebestgameever";

$name = $_POST["Name"];
$strength = $_POST["Strength"];
$power = $_POST["Power"];
$timestamp = date('Y-m-d H:i:s');

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO createobject(`TimeStamp`, adminID, name, strength, power)
        VALUES ('$timestamp', '$id', '$name', '$strength','$power')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>