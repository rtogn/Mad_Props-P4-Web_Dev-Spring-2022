
<?php
session_start();

function test() {
	return "cats";
}

function getConn() {
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
//, userName, userType, password, creditCard=null, creditType=null, creditSecurity=null
function addUser($conn) {

	// If user is a buyer they have credit info. Otherwise they do not. 
	if($_POST['type'] == "buyer") {
		$usrEntry = "INSERT INTO USERS (username, usrType, password, firstName, LastName, email, creditCard, creditType, creditSecurity)
					values('".$_POST['username']."','".$_POST['type'].".','".$_POST['password']."',".$_POST['firstName']."',".$_POST['lastName']."',".$_POST['email']."',".$_POST['creditcard'].",'".$_POST['creditType']."','".$_POST['securityCode']."')";
	} else {
		$usrEntry = "INSERT INTO USERS (username, usrType, password, firstName, LastName, email)
					values('".$_POST['username']."','".$_POST['type'].".','".$_POST['password']."',".$_POST['firstName']."',".$_POST['lastName']."',".$_POST['email']."')";
	
	
	}
	
	$_SESSION['user'] = $_POST['username'];
	if($conn->query($usrEntry) === TRUE) {
		echo "row created!";
	} else {
		"Error with creating table: " . $conn->error;
	}
}

?>