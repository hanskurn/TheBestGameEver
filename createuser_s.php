	<?php
        $servername = "localhost";
        $username = "root";
        $password = "enthusiam";
        $dbname = "TheBestGame";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    echo "Connected successfully";
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $sql = "INSERT INTO TheBestGame.Players (name, email, password, coins)
		VALUES ('$name', '$email', '$password', 500)";

		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		?>
		
		<?php
		
		$getid = "SELECT idPlayers 
				  FROM TheBestGame.Players
				  WHERE name = $name
				  AND email = $email
				  AND password = $password";
				   
		$result = mysqli_query($conn, $getid);
		
		echo "Result:<br><br>";
		
		print $result;
				?>