<!DOCTYPE HTML>

<script language="Javascript">

function validateForm(){
    var uname = document.forms["CreateUser"]["name"].value;
    
    if(uname == null || uname == "") {
        window.alert("Please fill in a valid username");
        return false;
    }
    
    var uemail = document.forms["CreateUser"]["email"].value;
    var at = uemail.indexOf("@");
    var dot = uemail.indexOf(".");
    
    if(uemail == null || uemail == "" || at < 1 || dot < 3 || at > dot) {
        window.alert("Please fill in a valid email");
        return false;
    }
    
    var upassword = document.forms["CreateUser"]["password"].value;
    
    if(upassword == null || upassword == "") {
        window.alert("Please fill in a valid password");
        return false;
    }
    
    var charname = document.forms["CreateUser"]["charname"].value;
    
    if(charname == null || charname == "") {
        window.alert("Please give your character a name");
        return false;
    }
    
    var chartype = document.forms["CreateUser"]["chartype"].value;
    
    if(chartype == null || chartype == "") {
        window.alert("Please fill in a valid chartype");
        return false;
    }
}

</script>

<html>
<head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<title>Create an Account</title>
</head>
<body>
<br>Please fill out your user information. <br><br>
<form name="CreateUser" action="createuser_s.php" method="post" onSubmit="return validateForm();">
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
    $password = "Hannahskurnik";
    $dbname = "thebestgameever";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    //Check connection
    if (mysqli_connect_errno()){
        
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die('Mysql connection error');
    }
    
    $query_chartypes = "SELECT id, name, feature, cost FROM TheBestGameEver.CharacterType";
    $result = mysqli_query($conn, $query_chartypes);
    if (!$result){
        echo "No Data Avialible.";
    }
    else {
        while($row = mysqli_fetch_array($result)){
            $name = $row['name'];
            $feature = $row['feature'];
            $id[0] = $row['id'];
            $id[1] = $row['cost'];
            $id_string = implode(",", $id);
            print '<tr><td align="center"><input type="radio" name="chartype" value="' . $id_string . '" ></td>
            <td> Name: ' . $name . '</td>
            <td> Features: ' . $feature . '</td>
            <td> Cost: ' . $id[1] .  '</td></tr>';
        }
    }
   	?>
</table>
<br>
<input type="submit" name="createplayer" value="Create Account">
</form>
</body>
</html>