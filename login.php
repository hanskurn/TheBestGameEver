<DOCTYPE HTML>
<html>
<?php
    session_start();
    if(empty($_SESSION['error'])){
        $_SESSION['error'] = "";
    }
    $servername = "localhost";
    $username = "root";
    $password = "DevonEdwards";
    $dbname = "thebestgameever";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
<head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<title>Login</title>
</head>
<body>
<br>
<header><h1>Welcome to The Best Game Ever!</h1></header> <br>
<?php
    echo $_SESSION['error'];
    ?>
<br><h4> Please Sign In </h4>
<form action="login_state.php" method="post">
<table>
<tr>
<th>Email: </th>
<th>Password:</th>
</tr>
<tr>
<td><input type="text" name="email"></td>
<td><input type="text" name="password"></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Login"></td>
</tr>
</table>
</form>
<a href="createuser.php"> New Account</a>
</body>
</html>
