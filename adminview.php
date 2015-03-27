<!DOCTYPE HTML>
<html>
<head>
    <title>Administrator View</title>
    <?php
    session_start();
    $id = $_SESSION['id'];

    //connect to DB
    $servername = "localhost";
    $username = "root";

    $password = "Hannahskurnik";

    $db = "thebestgameever";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectAdmin = "SELECT A.name AS name, A.email as email
    FROM TheBestGameEver.Admin A
    WHERE A.idAdmin = '$id'";
    $result = mysqli_query($conn, $selectAdmin);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $row = mysqli_fetch_array($result);

    ?>
    <script>
        function removePlayer(event){

        }
    </script>
</head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
<table>
    <tr>
        <td>
            <?php echo "Welcome back " . $row['name'] . "!"; ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo "Email: " . $row['email']; ?>
        </td>
    </tr>
</table>

<h2>Create a new character type!</h2>

<form action="php/createNewCType.php" method="post" target='ctformresponse'>
    <label for="Name">Character Name:</label>
    <input type="text" id="Name" name="Name">
    <label for="Feature"> Feature:</label>
    <input type="text" id="Feature" name="Feature">
    <label for="Cost"> Cost:</label>
    <input type="text" id="Cost" name="Cost">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='ctformresponse' width='300' height='25'></iframe>
<br>


<h2>Create a new object!</h2>

<form action="php/createNewObject.php" method="post" target='obformresponse'>
    <label for="Name"> Object Name:</label>
    <input type="text" id="Name" name="Name">
    <label for="Strength"> Strength:</label>
    <input type="text" id="Strength" name="Strength">
    <label for="Power"> Power:</label>
    <input type="text" id="Power" name="Power">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='obformresponse' width='300' height='25'></iframe>
<br>

<h2>Admin Recent Activity</h2>

<?php
$result = mysqli_query($conn, "SELECT A.name AS adminName, C.name AS charactertypeName, C.timestamp AS createTime
                                   FROM charactertype C, admin A 
                                   WHERE adminId=idAdmin AND C.timestamp >= CURDATE()");
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

echo "<table border='1'>
    <tr>
    <th>Admin Name</th>
    <th>Created</th>
    <th>Character</th>
    <th>Time</th>
    </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['adminName'] . "</td>";
    echo "<td>created</td>";
    echo "<td>" . $row['charactertypeName'] . "</td>";
    echo "<td>" . $row['createTime'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>
    <h2>Player Login Activity</h2>";

$result = mysqli_query($conn, "SELECT name, tstart, tend, TIMESTAMPDIFF(SECOND,tstart,tend) AS duration
                                   FROM loginstate, players 
                                   WHERE id=idPlayers AND tstart >= CURDATE()");
echo "<table border='1'>
    <tr>
    <th>Player Name</th>
    <th>Login Time</th>
    <th>Logout Time</th>
    <th>Duration</th>
    </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['tstart'] . "</td>";
    echo "<td>" . $row['tend'] . "</td>";
    echo "<td>" . $row['duration'] . "</td>";
    echo "</tr>";
}
echo "</table>

<br>
<br>
<h1>Players</h1>";
$result0 = mysqli_query($conn, "SELECT idplayers AS id, name, coins FROM TheBestGameEver.players");

echo "<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Coins</th>
</tr>";
while($row = mysqli_fetch_array($result0)){
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['coins'] . "</td>";
    echo "<td><button type='button' id='deleteButton' onClick='removePlayer(event)'>Remove</button></td>";
    echo "</tr>";
}
echo"</table>";


mysqli_close($conn);
?>

<h2>Delete Player</h2>
<form action="php/deletePlayer.php" method="post" target='deleteplayerfr'>
    <label for="playerName">Name</label>
    <input type="text" id="playerName" name="playerName">
    <label for="playerID">ID</label>
    <input type="text" id="playerID" name="playerID">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='deleteplayerfr' width='300' height='100'></iframe>
<br>

<br>

<form action="php/CTypeLookUp.php" method="post" target='ctypelookupfr'>
    <label for="Ctype"> Look up character type:</label>
    <input type="text" id="Ctype" name="Ctype">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='ctypelookupfr' width='300' height='100'></iframe>
<br>

<br>

<form action="php/objTypeLookUp.php" method="post" target='objlookupfr'>
    <label for="Objname"> Find number of object types:</label>
    <input type="text" id="Objname" name="Objname">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='objlookupfr' width='300' height='100'></iframe>
<br>

<h1>Find the Average coins per character type!</h1>

        <form id="minmaxform" action="php/averageCoinLookup.php" method="post" target='coinfr'>
            <select name="minmaxform">
                <option value="MIN" id="min">Minimum</option>
                <option value="MAX" id="max">Maximum</option>

            </select>
            <input type="submit" value="Find">
        </form>
        <br>

        <iframe name='coinfr' width='300' height='300'></iframe>

        <br>
        <br>
        <br>

</body>
</html>
