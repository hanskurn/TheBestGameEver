<?php
    //connect to DB
    $servername = "localhost";
    $username = "root";
    $password = "DevonEdwards";
    $db = "thebestgameever";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //TODO SET POSTED VARIABLES TO SOMETHING, MIN AND MAX
    $selectedOption = $_POST["minmaxform"];
    $sql = "SELECT $selectedOption(A.averageCoins) as avgCoin, A.typeName as name
            FROM (SELECT AVG(P.coins) as averageCoins, T.name as typeName
            FROM thebestgameever.`character` C, thebestgameever.charactertype T, thebestgameever.players P
            WHERE P.idPlayers = C.playerId AND C.characterTypeID = T.id
            GROUP BY T.id) AS A";
    $result = mysqli_query($conn,$sql);
    $tuple = mysqli_fetch_array($result);
    if ($conn->query($sql) == TRUE) {
        echo "The character type that has the ".$selectedOption." average coins of all character types is ".$tuple['name']." with ".$tuple['avgCoin']." coins.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>

