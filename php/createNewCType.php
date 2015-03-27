<?php
    session_start();
    $adminId = $_SESSION['id'];
    
    $servername = "localhost";
    $username = "root";
    $password = "DevonEdwards";
    $db = "thebestgameever";
    
    $name = $_POST["Name"];
    $feature = $_POST["Feature"];
    $cost = $_POST["Cost"];
    $timestamp = date('Y-m-d H:i:s');
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if($cost < 501){// check constraint (check not supported in our version of sql)
        $sql = "INSERT INTO TheBestGameEver.CharacterType(name, feature, cost, adminId, `timestamp`)
        VALUES ('$name', '$feature', '$cost', '$adminId', '$timestamp')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Please choose a value for cost that is less than 500";
    }
    
    ?>
