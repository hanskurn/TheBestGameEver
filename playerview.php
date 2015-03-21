<DOCTYPE HTML>
    <html>
        <head>
            <title>Player View</title>
        </head>
        <body>
<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "Asd123890";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
 

<?php
$email = $_POST["email"];

$result = mysqli_query($conn, "SELECT C.name AS CharaterName, C.health AS Health, C.age AS Age 
	                         FROM character C, Plaryer P 
	                         WHERE P.email = '$email' AND C.playerId = P.idPlayers");

$row = mysqli_fetch_array($result);
?>

<font size="10" color="blue"> <?php echo "Hi " . $row['CharacterName'] . "! Welcome to TheBestGameEver!"; ?> </font> 
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

$result2 = mysqli_query($conn, "SELECT O.name AS ObjectName, O.strengh AS Strength, O.power AS power 
	                            FROM hasObject H, Character C, CreateObject O, Player P 
	                            WHERE H.charaterName = C.name AND H.objectID = O.objectID AND P.email = '$email' 
                                      AND C.playerId = P.idPlayers");
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
while($row2 = mysqli_fetch_array($result2))
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
$result3 = mysqli_query($conn, "SELECT P.coins AS Coins 
                             FROM Plaryer P 
                             WHERE P.email = '$email'");
$row3 = mysqli_fetch_array($result3);
$coins = $row3['Coins'];

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