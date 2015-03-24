<DOCTYPE HTML>
    <html>
        <head>
            <title>Player View</title>
        </head>
        <body>
    <?php
        session_start();
        $id = $_SESSION['id'];
        
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
        
        $selectCharacterPlayer = "SELECT C.name AS CharacterName, C.health AS Health, C.age AS Age, P.idPlayers AS playerId, P.name AS playerName
                                FROM TheBestGameEver.Character C, TheBestGameEver.Players P
                                WHERE P.idPlayers = '$id'
                                AND C.playerId = P.idPlayers";
        $result = mysqli_query($conn, $selectCharacterPlayer);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $row = mysqli_fetch_array($result);
        
    ?>

    <font size="10" color="blue"> <?php echo "Hi " . $row['playerName'] . "! Welcome to The Best Game Ever!"; ?> </font>
    <br>
    <br>

    <font size="6" color="blue"> <?php echo "Character Information:"; ?> </font>
    <br>

    <?php
        echo "<table border='1'>
        <tr>
        <th>Character Name</th>
        <th>Health</th>
        <th>Age</th>
        </tr>";

        echo "<tr>";
        echo "<td>" . $row['CharacterName'] . "</td>";
        echo "<td>" . $row['Health'] . "</td>";
        echo "<td>" . $row['Age'] . "</td>";
        echo "</tr>";

        echo "</table>";
        echo "<br>";
        echo "<br>";
        
        $selectObjects = "SELECT O.name AS ObjectName, O.strength AS Strength, O.power AS power
                            FROM TheBestGameEver.hasObject H, TheBestGameEver.Character C, TheBestGameEver.CreateObject O, TheBestGameEver.Players P
                            WHERE H.characterName = C.name
                            AND H.objectID = O.objectID
                            AND P.idPlayers = '$id'
                            AND C.playerId = P.idPlayers";
        $result2 = mysqli_query($conn, $selectObjects);
        if (!$result2) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $row2 = mysqli_fetch_array($result2);
    ?>

    <font size="6" color="blue"> <?php echo "Objects Owned:"; ?> </font>
    <br>

    <?php
        echo "<table border='1'>
        <tr>
        <th>Object Name</th>
        <th>Strength</th>
        <th>Power</th>
        </tr>";
        while(mysqli_fetch_array($result2))
        {
            echo "<tr>";
            echo "<td>" . $row2['ObjectName'] . "</td>";
            echo "<td>" . $row2['Strength'] . "</td>";
            echo "<td>" . $row2['Power'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>

    <br>
    <br>

    <font size="6" color="blue"> <?php echo "Settings:"; ?> </font>
    <br>

    <?php
        $selectCoins = "SELECT P.coins AS Coins, P.email AS email
                        FROM TheBestGameEver.Players P
                        WHERE P.idPlayers = '$id'";
        $result3 = mysqli_query($conn, $selectCoins);
        if (!$result3) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $row3 = mysqli_fetch_array($result3);
        $coins = $row3['Coins'];
        $email = $row3['email'];

        echo "<table border='1'>
          <tr>
            <td>Email</td>
            <td> $email </td>
          </tr>
          <tr>
            <td>Coins</td>
            <td>$coins</td>
          </tr>
          <tr>
        </table>";

        mysqli_close($conn);
    ?>

          
        </body>
    </html>