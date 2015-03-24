<?php
    session_start();
    $id = $_SESSION['id'];
    
    $servername = "localhost";
    $username = "root";
    $password = "DevonEdwards";
    $db = "thebestgameever";

    $name = $_POST["Name"];
    $strength = $_POST["Strength"];
    $power = $_POST["Power"];
    $adminid = $id;
    $objectid = 30987;
    $timestamp =00000000;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO createobject(TimeStamp  , adminID, objectID, name, strength, power)
            VALUES ('$timestamp', '$adminid', '$objectid', '$name', '$strength','$power')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>