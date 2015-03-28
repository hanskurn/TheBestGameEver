<?php
    session_start();
    $id = $_SESSION['id'];

    $servername = "localhost";
    $username = "root";
    $password = "Devonedwards";
    $dbname = "thebestgameever";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    $objectid = $_POST["objtype"];


    $sql1 = "SELECT name FROM TheBestGameEver.Character WHERE playerId = '$id'";

$result = mysqli_query($conn, $sql1);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$charactername = mysqli_fetch_array($result);



    $sql = "INSERT INTO TheBestGameEver.hasObject (objectID, characterName)
    VALUES ('$objectid', '$charactername[0]')";

    if ($conn->query($sql) == TRUE) {
        echo "You got a new object!";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>