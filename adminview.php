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
    $password = "Devonedwards";
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
<form action="adminLogout.php" method="post">
<table align="right">
<tr>
<td colspan="2"><input type="submit" value="Logout"></td>
</tr>
</table>
</form>
<br>
<h1><?php echo "Welcome back " . $row['name'] . "!"; ?> </h1>
<h3><?php echo "Email: " . $row['email']; ?></h3>
<br><br>
<h4>Create a new character type!</h4>

<form action="php/createNewCType.php" method="post" target='ctformresponse'>
<table>
<tr>
<th> Character Name:</th>
<th> Feature:</th>
<th> Cost:</th>
</tr>
<tr>
<td> <input type="text" id="Name" name="Name"></td>
<td> <input type="text" id="Feature" name="Feature"></td>
<td> <input type="text" id="Cost" name="Cost"></td>
</tr>
<tr>
<td> <input type="submit" value="Submit"></td>
</tr>
</table>
</form>
<br>
<iframe name='ctformresponse' width='300' height='25'></iframe>
<br>


<h4>Create a new object!</h4>

<form action="php/createNewObject.php" method="post" target='obformresponse'>
<table>
<tr>
<th> Object Name:</th>
<th> Strength:</th>
<th> Power:</th>
</tr>
<tr>
<td> <input type="text" id="Name" name="Name"></td>
<td> <input type="text" id="Strength" name="Strength"></td>
<td> <input type="text" id="Power" name="Power"></td>
</tr>
<tr>
<td> <input type="submit" value="Submit"></td>
</tr>
</table>
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

<h4>Player Login Activity</h4>";

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
<h4>Players</h4>";
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

    echo "</tr>";
}
echo"</table>";



mysqli_close($conn);
?>

<h4>Delete Player</h4>
<form action="php/deletePlayer.php" method="post" target='deleteplayerfr'>
<table>
<tr>
<th> Name:</th>
<th> ID:</th>
</tr>
<tr>
<td> <input type="text" id="playerName" name="playerName"></td>
<td> <input type="text" id="playerID" name="playerID"></td>
</tr>
<tr>
<td> <input type="submit" value="Submit"></td>
</tr>
</table>
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

<h4>Find the average coins of players who have the max/min average coins per character type</h4>

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
