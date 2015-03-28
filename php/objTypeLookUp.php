<?php

$servername = "localhost";
$username = "root";
$password = "Devonedwards";
$db = "thebestgameever";

$objname = $_POST['Objname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($objname != "") {
    $result0 = mysqli_query($conn, "SELECT COUNT(*) AS n
                                FROM TheBestGameEver.CreateObject
                                WHERE name='$objname'");
    $row0 = mysqli_fetch_array($result0);
    if ($row0['n'] == 0) {
        echo "Object type '" . $objname . "' dose not exist.";
    } else {
        $result1 = mysqli_query($conn, "SELECT O.name, COUNT(C.name) AS pNum
                                                        FROM TheBestGameEver.HasObject H, TheBestGameEver.CreateObject O, TheBestGameEver.Character C
                                                        WHERE O.name='$objname' AND H.objectID=O.objectID AND H.characterName=C.name");
        if (!$result1) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }

        $result2 = mysqli_query($conn, "SELECT O.name, COUNT(*) AS objNum
                                                                                FROM TheBestGameEver.CreateObject O
                                                                                WHERE O.name='$objname'");

        $row1 = mysqli_fetch_array($result1);
        $row2 = mysqli_fetch_array($result2);
        echo $row1['pNum'] . " characters(s) own this type!" . "<br>";
        echo "There are " . $row2['objNum'] . " objects of this type!" . "<br>";
    }
}
mysqli_close($conn);

?>
