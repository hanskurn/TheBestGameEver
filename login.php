<DOCTYPE HTML>
<html>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "enthusiam";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    echo "Connected successfully";
        ?>
 <head>
  <title></title>
 </head>
 <body>
  This is the login page.
  <form action="login_state.html" method="post">
      <table border="1" style="width:100%">
          <tr>
              <td>Username: </td>
              <td><input type="text" name="uname"></td>
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
