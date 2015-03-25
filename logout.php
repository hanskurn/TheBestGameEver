<DOCTYPE HTML>
<html>
<?php
    session_start();
    $start = $_SESSION['tstart'];
    $end = date('Y-m-d H:i:s');
    $id = $_SESSION['id'];
    
    $servername = "localhost";
    $username = "root";
    $password = "DevonEdwards";
    $dbname = "TheBestGameEver";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO TheBestGameEver.LoginState (tstart, tend, id)
    VALUES ('$start', '$end', '$id')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: http://localhost/TheBestGameEver/login.php');
    ?>
<head>
<title></title>
</head>
<body>

</body>
</html>
