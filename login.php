<DOCTYPE HTML>
<html>
    <?php
        session_start();
        $_SESSION['error'] = "";
        
        $servername = "localhost";
        $username = "root";
        $password = "DevonEdwards";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>
 <head>
  <title></title>
 </head>
 <body>
  Welcome to The Best Game Ever! <br><br>
    <?php
        echo $_SESSION['error'];
    ?>
<br><br> Please Sign In <br><br>
  <form action="login_state.php" method="post">
      <table border="1" style="width:100%">
          <tr>
              <td>Email: </td>
              <td><input type="text" name="email"></td>
          </tr>
          <tr>
              <td>Password:</td>
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
