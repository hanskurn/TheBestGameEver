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
        $char_name = $_POST["charname"];
        $char_type = $_POST["chartype"];
        
        $sql = "INSERT INTO TheBestGame.Players (name, email, password, coins)
		VALUES ('$name', '$email', '$password', 500)";

		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$getid = "SELECT idPlayers 
				  FROM TheBestGame.Players
				  WHERE name = '$name'
				  AND email = '$email'
				  AND password = '$password'";
				   
		$result = mysqli_query($conn, $getid);
		
		echo "Result:<br><br>";
		
		$id = mysqli_fetch_array($result)['idPlayers'];
		
		$Update_Character ="INSERT INTO TheBestGame.Character (name, health, age, characterTypeID, playerID)
		VALUES ('$char_name', 10, 0, $char_type, $id)";
		
		if ($conn->query($Update_Character) === TRUE) {
    		echo "New character created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		header('Location: http://localhost/TheBestGameEver/login.php');
		?>