<!DOCTYPE html>  
 
 <?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include_once("SQL_Functions.php");
	//start session
	session_destroy();
	session_start();
	
	$currentUser = -1;
	if (isset($_SESSION['username'])) {
		$currentUser = $_SESSION['username'];
	}
	
	if (isset($_POST["password"]) && strlen($_POST["password"]) > 0) {
		verifyUser($_POST["username"], $_POST["password"]);
	}
 ?>
 

 
<html> 
    <head meta charset="UTF-8"> 
        <title>Log In To Mad Props!</title>
        <link href="./index.css" type="text/css" rel="stylesheet"/>
		<script src="index.js"></script>
    </head> 
    
    <body>
        <form class="loginBox" action="" method="post">
            <div class="houseLogo">
                <img src="./images/houseLogo.png">
            </div>
            <h1 class="login"> Login </h1>
            <input name="username" type="text" placeholder="Username" id="username" required>
            <input name="password" type="password" placeholder="Password" required>
            <input class="loginButton" type="submit" value="LOGIN">
            <a href="./signUp.php" class="signUpButton">SIGN UP</a>
        </form>
			
    </body> 
</html>
