<DOCTYPE HTML>
	<?php
        $servername = "localhost";
        $username = "root";
        $password = "enthusiam";
        $dbname = "TheBestGame";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        //Check connection
        if (mysqli_connect_errno()){

    		echo "Failed to connect to MySQL: " . mysqli_connect_error();
    		die('Mysql connection error');
		}else{
    		echo "Connection Established";
		}
		
        ?>
 <html>
  <head>
   <title></title>
  </head>
  <body>
  	Please fill out your user information.
   <form action="createuser_s.php" method="post">
   	<table border="1">
   		<tr>
   			<td>Name: </td>
   			<td><input type="text" name="name"></td>
   		</tr>
   		<tr>
   			<td>Email: </td>
   			<td><input type="text" name="email"></td>
   		</tr>
   		<tr>
   			<td>Password: </td>
   			<td><input type="text" name="password"></td>
   		</tr>
   		<tr colspan="2">
   			<td>
   			Your account defaults to 500 coins.
   			</td>
   		</tr>
   		<tr colspan="2">
   			<td>
   			<input type="submit" name="createplayer" value="Create Player">
   			</td>
   		</tr>
   	</table>
   	Now Create your character!
   	<table>
   		<tr>
   			<td>Character Name: </td>
   			<td><text name="charname"></td>
   		</tr>
   		<tr>
   			Character Type:
   		</tr>
   	<?php
   		$query_chartypes = "SELECT name, feature, cost FROM TheBestGame.CharacterType";
   		$result = mysql_query($query_chartypes);
   		if (!$result){
   			print $result;
   			}
   		else {
   			while($row = mysql_fetch_array($result)){
   				print '<tr><td><input type="checkbox" name="chartype" value="' . $row[name] . '" ></td><td> Name:' . $row[name] . '</td></tr>';
   				}
   			}
   	?>	
   	</table>
   	<br>
   </form>
  </body>
</html>