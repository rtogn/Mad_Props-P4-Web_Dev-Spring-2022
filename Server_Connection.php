
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


function verifyUser($username, $password) {
	// Use SQL query to verify username and password.
	// Returns id, uname, password and user type
	
	$conn = getConn();
	// Query is pretty standard but the username and password are compared
	// in the WHERE clause to avoid any bafoonary in PHP. 
	// Note that username is UNIQUE so will only give 1 row. 
	$sqlQ1 = "
			SELECT
				id,
				username,
				usrType,
				password
			FROM
				USERS
			WHERE
				username = '".$username."' 
				AND password = '".$password."'
			;";
	//$sqlQ2 = "SELECT * FROM USERS"; //test query 
	
	// Get the Q results
	$result = $conn->query($sqlQ1);
	
	// Get row into a parsable format. Due to the way the table is designed there will only be one row
	// This is because username is set to unique. 
	$row = $result->fetch_array();
	$_SESSION['userId'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['usrType'] = $row['usrType'];
	
	if(isset($_SESSION['userId'])) {
		echo "User found!";
		selectDashboard($_SESSION['usrType']);
	} else {
		echo "User not found!";
	}
	
}

function selectDashboard($userType) {
	if ($userType == "Admin") {
		header("Location: admin.php"); 
	}
	else if ($userType == "seller") {
		header("Location: seller.php"); 
	}
	else {
		header("Location: buyer.php"); 		
	}
}
?>