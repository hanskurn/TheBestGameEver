<DOCTYPE HTML>
<html>
 <head>
  <title></title>
 </head>
 <body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "DevonEdwards";
        $dbname = "TheBestGameEver";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $getId = "SELECT idAdmin 
                    FROM TheBestGameEver.Admin
                    WHERE email= '$email'
                    AND password = '$password'";
        $result = mysqli_query($conn, $getId);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $id = mysqli_fetch_array($result)['idAdmin'];
        if (empty($id)){
            $getid = "SELECT idPlayers
                    FROM TheBestGameEver.Players
                    WHERE email = '$email'
                    AND password = '$password'";
            $result = mysqli_query($conn, $getid);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            $id = mysqli_fetch_array($result)['idPlayers'];
            if (empty($id)){
                session_start();
                $_SESSION['error'] = "We're sorry, we cannot find your account. Please ensure your email and/or password are spelled correctly";
                header('Location: http://localhost/TheBestGameEver/login.php');
            }
            else {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['error'] = "";
                header('Location: http://localhost/TheBestGameEver/playerView.php');
            }
        }
        else {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['error'] = "";
            header('Location: http://localhost/TheBestGameEver/adminView.php');
        }
    ?>
 </body>
</html>
