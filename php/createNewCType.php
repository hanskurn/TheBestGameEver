<?php

$servername = "localhost";
$username = "root";
$password = "Hannahskurnik";
$db = "thebestgameever";

$name = $_POST["Name"];
$feature = $_POST["Feature"];
$cost = $_POST["Cost"];
$adminID = 12345;
$id = 30987;
$timestamp =00000000;


// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO charactertype(id, name, feature, cost, adminID, timestamp)
        VALUES ('$name', '$feature', '$cost', '$adminID', '$timestamp')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
