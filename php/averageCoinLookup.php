<?php

$servername = "localhost";
$username = "root";
$password = "Hannahskurnik";
$dbname = "thebestgameever";

//TODO SET POSTED VARIABLES TO SOMETHING, MIN AND MAX
$selectedOption = $_POST["minmaxform"];

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**$sql=" SELECT T.id typeID, T.name name, ".$selectedOption."(avgCoin) averageCoin
FROM TheBestGameEver.character C, TheBestGameEver.charactertype T, TheBestGameEver.players P
            WHERE P.idPlayers = C.playerId AND C.characterTypeID = T.id AND
            avgCoin = (SELECT AVG(P2.coins)
                        FROM TheBestGameEver.character C2, TheBestGameEver.players P2
                        WHERE P2.idPlayers = C2.playerId AND C2.characterTypeID = T.id
                        GROUP BY T.characterTypeID)";**/

$sql = "SELECT ".$selectedOption."(A.averageCoins)
FROM (SELECT AVG(P.coins) as averageCoins
FROM TheBestGameEver.character C, TheBestGameEver.charactertype T, TheBestGameEver.players P
WHERE P.idPlayers = C.playerId AND C.characterTypeID = T.id
GROUP BY T.id) AS A";



$result = mysqli_query($conn,$sql);

$tuple = mysqli_fetch_array($result);

if ($conn->query($sql) === TRUE) {
    echo "The character type that has the ".$selectedOption." average coins of all character types is ".$tuple['name']." with ".$tuple['avgCoin']." coins.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);


