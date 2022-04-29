<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("Server_Connection.php");
//start session
session_start();

if (isset($_POST['firstName']) && strlen($_POST['firstName']) > 0)   // it checks whether the user clicked login button or not 
{
	
	$conn = getConn();

	if ($conn) {
		addUser($conn);
	} else {
		echo "Could not establish connectoin to SQL server";
	}
	$conn->close();
	session_destroy();
}

/*
if (isset($_SESSION['user'])) {

    if (empty($_SESSION['user'])) {
        echo "<h2 class='error'> No Username! </h2>";
    } else {
        header("Location:index.html");
    }
}
*/

?>

<!DOCTYPE html>  
 
<html> 
    <head meta charset="UTF-8"> 
        <title>Mad Props Sign Up</title>
        <link href="./index.css" type="text/css" rel="stylesheet"/>
    </head> 
    
    <body>
        <form class="loginBox" action="" method="post">
            <div class="houseLogo">
                <img src="./images/houseLogo.png">
            </div>
            <h1 class="login"> Sign Up </h1>
			
			<label for="type">Select user type:</label>
            <select id="type" name="type" class="option">
				<option value="buyer">Buyer</option>
				<option value="seller">seller</option>
			</select>
			
			<input name="firstName" type="text" placeholder="First Name" required>
            <input name="lastName" type="text" placeholder="Last Name" required>
            <input name="email" type="text" placeholder="Email" required>
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
			<div id="creditInfo">
				<input name="creditcard" type="text" placeholder="creditcard" id="creditcard" required>
				<input name="creditType" type="text" placeholder="creditType" id="creditType" required>
				<input name="securityCode" type="password" placeholder="securityCode" id="securityCode" required>
			</div>
		    <a href="index.html"><input type="submit" name="submit-btn" value="submit" class="signUpButton"></a>
        </form>
		<script src="signUp.js"></script>
    </body> 
</html>
