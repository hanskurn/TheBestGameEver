<?php

$servername = "localhost";
$username = "root";
$password = "DevonEdwards";
$db = "thebestgameever";

$ctype = $_POST['Ctype'];
$objname =  $_POST['Objname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($ctype != ""){
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM playesr, charactertype, character
WHERE characterTypeID=id AND playerID=idPlayers AND charactertype.name='$ctype'");
echo $result. " players own this type!";
}

if($objname != ""){
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM playesr, charactertype, character
WHERE characterTypeID=id AND playerID=idPlayers AND charactertype.name='$ctype'");
    echo $result. " players own this type!";
}

