<script>
function emailnotavaible()
{
    window.alert("Sorry that email is already taken.");
}
</script>

<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "Devonedwards";
    $dbname = "thebestgameever";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    
    $str_explode = explode(",", $_POST["chartype"]);
    
    $char_type = $str_explode[0];
    $acct_balance = 500 - $str_explode[1];
    
    //echo "ID: $char_type";
    //echo "Balance: $acct_balance";
    
    //exit(["for debugging"]);
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $char_name = $_POST["charname"];
    
    $sql = "INSERT INTO TheBestGameEver.Players (name, email, password, coins)
    VALUES ('$name', '$email', '$password', $acct_balance)";
    
    if ($conn->query($sql) == TRUE) {
        echo "New record created successfully";
        $getid = "SELECT idPlayers
        FROM TheBestGameEver.Players
        WHERE name = '$name'
        AND email = '$email'
        AND password = '$password'";
        
        $result = mysqli_query($conn, $getid);
        
        echo "Result:<br><br>";
        
        $id = mysqli_fetch_array($result)['idPlayers'];
        
        $Update_Character ="INSERT INTO TheBestGameEver.Character (name, health, age, characterTypeID, playerID)
        VALUES ('$char_name', 10, 0, $char_type, $id)";
        
        if ($conn->query($Update_Character) === TRUE) {
            echo "New character created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $_SESSION['error'] = "";
        header('Location: http://localhost/login.php');
    } else {
        $_SESSION['error'] = "Sorry that email is already taken, please choose another";
        echo '<script>emailnotavaible()</script>';
        header('Location: http://localhost/login.php');
    }
    ?>