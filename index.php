<!DOCTYPE html>  
 
 <?php
	include("Server_Connection.php");
	//start session
	session_start();
	$currentUser = -1;
	if (isset($_SESSION['username'])) {
		$currentUser = $_SESSION['username'];
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
            <input name="username" type="text" placeholder="Username" id="username">
            <input name="password" type="password" placeholder="Password">
            <input class="loginButton" type="submit" value="LOGIN">
            <a href="./signUp.php" class="signUpButton">SIGN UP</a>
        </form>
		
	 <script>
		// This is so hackey crap to fill out the user name field if its already in the session. 
		var fill_usr = <?php echo $currentUser;?>;
		if (fill_usr != -1) {
			document.getElementById('username').value = fill_usr;
		}
	 </script>		
    </body> 
</html>
