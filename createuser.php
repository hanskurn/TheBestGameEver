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
<?php
    session_start();
    if(empty($_SESSION['error'])){
        $_SESSION['error'] = "";
    }
    ?>
</head>
<body>
<br><h3>Please fill out your user information </h3><br>
<form name="CreateUser" action="createuser_s.php" method="post" onSubmit="return validateForm();">
<table>
<tr> <h5><?php echo $_SESSION['error'];?> </h5></tr>
<tr>
<th>Name: </th>
<th>Email: </th>
<th>Password: </th>
</tr>
<tr>
<td><input type="text" name="name"></td>
<td><input type="text" name="email"></td>
<td><input type="text" name="password"></td>
</tr>
<tr>
<th>You begin with 500 coins</th>
</tr>
</tr>
<tr>
<th>use them wisely...</th>
</tr>
</table>
<br>
<h4>Now Create your character!</h4>
<table>
<tr>
<th>Character Name: </th>
</tr>
<tr>
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
    $password = "DevonEdwards";
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