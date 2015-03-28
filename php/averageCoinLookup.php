<?php
    //connect to DB
    $servername = "localhost";
    $username = "root";
    $password = "Devonedwards";
    $db = "thebestgameever";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $selectedOption = $_POST["minmaxform"];
    $sql = "CREATE VIEW Temp AS SELECT AVG(P.coins) as averageCoins, T.name as typeName
            FROM thebestgameever.`character` C, thebestgameever.charactertype T, thebestgameever.players P
            WHERE P.idPlayers = C.playerId AND C.characterTypeID = T.id GROUP BY T.id";
    $result = mysqli_query($conn,$sql);
    $sql = "SELECT Temp.averageCoins AS avgCoin, Temp.typeName AS name FROM Temp WHERE Temp.averageCoins = (SELECT $selectedOption(Temp.averageCoins) FROM Temp)";
    $result = mysqli_query($conn,$sql);
    $tuple = mysqli_fetch_array($result);
    if ($conn->query($sql) == TRUE) {
        echo "The character type that has the ".$selectedOption." average coins of all character types is ".$tuple['name']." with ".$tuple['avgCoin']." coins.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>

