<?php

$servername = "localhost";
$username = "root";
$password = "Hannahskurnik";
$db = "thebestgameever";

$playername = $_POST['playerName'];
$playerId = $_POST['playerID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `TheBestGameEver`.`players`
        WHERE name = '$playername' AND idPlayers = '$playerId' ";

if ($playername != "") {
    $result0 = mysqli_query($conn, "SELECT COUNT(*) AS n
                                FROM TheBestGameEver.players
                                WHERE name='$playername' AND idPlayers = '$playerId'");
    $row0 = mysqli_fetch_array($result0);
    if ($row0['n'] == 0) {
        echo "There are no players by the name of " . $playername." with ID ".$playerId;
    } else {
        $result1 = mysqli_query($conn, $sql);
        if (!$result1) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        echo "Deletion Successful";
    }
}
mysqli_close($conn);

?>
