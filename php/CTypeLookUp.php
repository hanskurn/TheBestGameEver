<?php

$servername = "localhost";
$username = "root";
$password = "Devonedwards";
$db = "thebestgameever";

$ctype = $_POST['Ctype'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($ctype != "") {
    $result0 = mysqli_query($conn, "SELECT COUNT(*) AS n
                                FROM TheBestGameEver.CharacterType
                                WHERE charactertype.name='$ctype'");

    $row0 = mysqli_fetch_array($result0);
    if ($row0['n'] == 0) {
        echo "Character type '" . $ctype . "' does not exist.";
    } else {
        $result1 = mysqli_query($conn, "SELECT COUNT(*) AS k
                                                        FROM TheBestGameEver.Players P, TheBestGameEver.CharacterType T, TheBestGameEver.Character C
                                                        WHERE C.characterTypeID=T.id AND C.playerId=P.idPlayers
                                                        AND T.name='$ctype'");
        if (!$result1) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }

        $row1 = mysqli_fetch_array($result1);
        echo $row1['k'] . " player(s) own this type!";
    }
}
mysqli_close($conn);

?>

