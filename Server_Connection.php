
<?php
session_start();

function test() {
	return "cats";
}

function getConn() {
	// Return conn object based on login info below. 
	$host = "localhost";
	$user = "rtognoni1";
	$pass = "rtognoni1";
	$dbname = "rtognoni1";
	// Create connectoin
	$conn = new mysqli($host, $user, $pass, $dbname);
	// Check connectoin
	if ($conn->connect_error) {
		echo "Could not connect to server\n";
		die("Connection failed: " . $conn->connect_error);
		return -1;
	}
	else {
		//$_SESSION['conn'] = $conn;
		return $conn;
	}
}

function addUser($conn) {
	// take conn argument to set up user based on querey. Buyers get cc info, others do not. 
	if($_POST['type'] == "buyer") {

		$usrEntry = "INSERT INTO USERS (username, usrType, password, firstName, lastName, email, creditCard, creditType, creditSecurity)
					values('"
					.$_POST['username']."', '"
					.$_POST['type'].".', '"
					.$_POST['password']."', '"
					.$_POST['firstName']."', '"
					.$_POST['lastName']."', '"
					.$_POST['email']."', '"
					.$_POST['creditcard']."', '"
					.$_POST['creditType']."', '"
					.$_POST['securityCode']."');";
					
	} else {
		$usrEntry = "INSERT INTO USERS (username, usrType, password, firstName, lastName, email)
					values('"
					.$_POST['username']."', '"
					.$_POST['type'].".', '"
					.$_POST['password']."', '"
					.$_POST['firstName']."', '"
					.$_POST['lastName']."', '"
					.$_POST['email']."');";
	}
	
	
	$_SESSION['username'] = $_POST['username'];
	
	if($conn->query($usrEntry) === TRUE) {
		echo "row created!";
		header("Location: index.php"); 
	} else {
		echo "Error with creating table: " . $conn->error;
	}
}

?>