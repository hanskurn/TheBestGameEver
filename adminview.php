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
        $password = "DevonEdwards";
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
</head>
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

<h1>Create a new character type!</h1>

<form action="php/createNewCharacterType.php" method="post" target='formresponse'>
    <label for="Name"> Name:</label>
    <input type="text" id="Name" name="Name">
    <label for="Feature"> Feature:</label>
    <input type="text" id="Feature" name="Feature">
    <label for="Cost"> Cost:</label>
    <input type="text" id="Cost" name="Cost">
    <input type="submit" value="Submit">
</form>
<br>
<iframe name='formresponse' width='300' height='200'></iframe>
<br>


<h1>Create a new object!</h1>

<form>
    <label for="Name"> Name:</label>
    <input type="text" id="Name">
    <label for="Strength"> Strength:</label>
    <input type="text" id="Strength">
    <label for="Power"> Power:</label>
    <input type="text" id="Power">
    <input type="submit" value="Submit">
</form>
<br>
<?php
    $result = mysqli_query($conn, "SELECT A.name AS adminName, C.name AS charactertypeName, timestamp FROM charactertype C, admin A where adminId=idAdmin");
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
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['adminName'] . "</td>";
        echo "<td>created</td>";
        echo "<td>" . $row['charactertypeName'] . "</td>";
        echo "<td>" . $row['timestamp'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($conn);
?>


</body>
</html>
