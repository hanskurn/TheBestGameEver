<DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css/main.css" type="text/css">
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
    $selectPlayer = "SELECT P.name AS playerName, P.coins AS Coins, P.email AS email
    FROM TheBestGameEver.Players P
    WHERE P.idPlayers = '$id'";
    $resultPlayer = mysqli_query($conn, $selectPlayer);
    if (!$resultPlayer) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $rowPlayer = mysqli_fetch_array($resultPlayer);
    
    $selectCharacterPlayer = "SELECT C.name AS CharacterName, C.health AS Health, C.age AS Age, P.idPlayers AS playerId, P.name AS playerName, T.name as typeName
    FROM TheBestGameEver.Character C, TheBestGameEver.Players P, TheBestGameEver.CharacterType T
    WHERE P.idPlayers = '$id'
    AND C.playerId = P.idPlayers AND C.characterTypeID = T.id";
    $result = mysqli_query($conn, $selectCharacterPlayer);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $row = mysqli_fetch_array($result);
    
    ?>

<form action="logout.php" method="post">
<table align="right">
<tr>
<td colspan="2"><input type="submit" value="Logout"></td>
</tr>
</table>
</form>
<h1><?php echo "Hi " . $rowPlayer['playerName'] . "! Welcome to The Best Game Ever!"; ?></h1>
<br>
<br>

<h4><?php echo "Character Information:"; ?></h4>
<?php
    echo "<table border='1'>
    <tr>
    <th>Character Name</th>
    <th>Health</th>
    <th>Age</th>
    <th>Character Type</th>
    </tr>";
    
    echo "<tr>";
    echo "<td>" . $row['CharacterName'] . "</td>";
    echo "<td>" . $row['Health'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['typeName'] . "</td>";
    echo "</tr>";
    
    echo "</table>";
    echo "<br>";
    echo "<br>";
    
    $selectObjects = "SELECT O.name AS ObjectName, O.strength AS Strength, O.power AS power
    FROM TheBestGameEver.hasObject H, TheBestGameEver.`Character` C, TheBestGameEver.CreateObject O, TheBestGameEver.Players P
    WHERE H.characterName = C.name
    AND H.objectID = O.objectID
    AND P.idPlayers = '$id'
    AND C.playerId = P.idPlayers";
    $result2 = mysqli_query($conn, $selectObjects);
    if (!$result2) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    ?>

<h4><?php echo "Objects Owned:"; ?></h4>
<?php
    echo "<table>
    <tr>
    <th>Object Name</th>
    <th>Strength</th>
    <th>Power</th>
    </tr>";
    while($row2 = mysqli_fetch_array($result2))
    {
        echo "<tr>";
        echo "<td>" . $row2['ObjectName'] . "</td>";
        echo "<td>" . $row2['Strength'] . "</td>";
        echo "<td>" . $row2['power'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

<br>
<h4><?php echo "See who else owns all your objects!"; ?></h4>
<?php
    $divisionQuery = "SELECT P3.name as playerName, P3.coins as playerCoins
        FROM thebestgameever.players P3, thebestgameever.`character` C3
        WHERE C3.playerId = P3.idPlayers
        AND P3.idPlayers != '$id'
        AND NOT EXISTS (SELECT * FROM thebestgameever.hasObject O2 , thebestgameever.`character` C2
                        WHERE O2.characterName = C2.name AND C2.playerId = '$id'
                        AND NOT EXISTS
                        (SELECT * FROM thebestgameever.hasObject O, thebestgameever.`Character` C
                         WHERE C.playerId = P3.idPlayers AND C.name = O.characterName))";
    
    $divisionresult = mysqli_query($conn, $divisionQuery);
    if (!$divisionresult) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    
    echo "<table>
    <tr>
    <th>Player Name</th>
    <th>Coins</th>
    </tr>";
    while($divisionrow = mysqli_fetch_array($divisionresult))
    {
        echo "<tr>";
        echo "<td>" . $divisionrow['playerName'] . "</td>";
        echo "<td>" . $divisionrow['playerCoins'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

<br>
<br>

<h4><?php echo "Settings:"; ?> </h4>
<?php
    $coins = $rowPlayer['Coins'];
    $email = $rowPlayer['email'];
    
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