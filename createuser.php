<DOCTYPE HTML>
 <html>
  <head>
   <title>Create an Account</title>
  </head>
  <body>
  	<br>Please fill out your user information. <br><br>
   <form action="createuser_s.php" method="post">
   	<table border="0">
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
   	</table>
   	<br>
   	Now Create your character!<br><br>
   	<table border = "0">	
   		<tr>
   			<td>Character Name: </td>
   			<td><input type="text" name="charname"></td>
   		</tr>
   		<tr>
   			<td colspan = "4">
   			Select a Character Type:
   			<td>
   		</tr>
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
		}
		
   		$query_chartypes = "SELECT name, feature, cost FROM TheBestGame.CharacterType";
   		$result = mysqli_query($conn, $query_chartypes);
   		if (!$result){
   			echo "No Data Avialible."; 
   			}
   		else {
   			while($row = mysqli_fetch_array($result)){
   				$name = $row['name'];
   				$feature = $row['feature'];
   				$cost = $row['cost'];
   				print '<tr><td align="center"><input type="checkbox" name="chartype" value="' . $name . '" ></td>
   							<td> Name: ' . $name . '</td>
   							<td> Features: ' . $feature . '</td>
   							<td> Cost: ' . $cost .  '</td></tr>';
   				}
   			}
   	?>	
   	</table>
   	<br>
   	<input type="submit" name="createplayer" value="Create Account">
   </form>
  </body>
</html>