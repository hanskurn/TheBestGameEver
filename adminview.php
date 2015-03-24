<!DOCTYPE HTML>
<html>
<head>
    <title>Administrator View</title>
    <?php

    ?>
</head>
<body>
<?php
session_start();
$id = $_SESSION['id'];

//connect to DB
$servername = "127.0.0.1:3306";
$username = "root";
$password = "Asd123890";
$db = "thebestgameever";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$findAdmin = "SELECT A.name AS adminName, A.email AS adminEmail
              FROM Admin A
              WHERE A.idAdmin = '$id'";

$admin = mysqli_query($conn, $findAdmin);
if (!$admin) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
$admin_ = mysqli_fetch_array($admin);
$Aname = $admin_['adminName'];
$Aemail = $admin_['adminEmail'];
?>
<font size="10" color="blue"> <?php echo "Hi " . $Aname . "! Welcome to The Best Game Ever!"; ?> </font>

<?php
echo "<table border='1'>
          <tr>
            <td>Admin Name:</td>
            <td> $Aname </td>
          </tr>
          <tr>
            <td>Email:</td>
            <td>$Aemail</td>
          </tr>
          <tr>
        </table>";
?>

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
echo "<table border='1'>
<tr>
<th>Admin Name</th>
<th>Created</th>
<th>Character</th>
<th>Time</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['adminName'] . "</td>";
    echo "<td>created</td>";
    echo "<td>" . $row['charactertypeName'] . "</td>";
    echo "<td>" . $row['createTime'] . "</td>";
    echo "</tr>";
}
echo "</table>"."<br>";
echo "<br>
<h2>Player Login Activity</h2>";

$result1 = mysqli_query($conn, "SELECT name, tstart, tend, TIMESTAMPDIFF(SECOND,tstart,tend) AS duration 
                               FROM loginstate, players 
                               WHERE id=idPlayers AND tstart >= CURDATE()");
if (!$result1) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
}

echo "<table border='1'>
<tr>
<th>Player Name</th>
<th>Login Time</th>
<th>Logout Time</th>
<th>Duration</th>
</tr>";
while($row1 = mysqli_fetch_array($result1))
{
    echo "<tr>";
    echo "<td>" . $row1['name'] . "</td>";
    echo "<td>" . $row1['tstart'] . "</td>";
    echo "<td>" . $row1['tend'] . "</td>";
    echo "<td>" . $row1['duration'] . "</td>";
    echo "</tr>";
}
echo "</table>";


mysqli_close($conn);
?>
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

</body>
</html>
