
<?php
session_start();

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
		
function SQLBitToYesNo($value) {
	// Returns Yes Or No String based on bit value. 
		if ($value == 1)
			return "Yes";
		return "No";	
}

function moneyFormat($value) {
	//Convert SQL DECIMAL to formatted dollar value string with commas and decimal.
	return '$'.number_format($value, 2);

}


function addUser() {
	// take conn argument to set up user based on querey. Buyers get cc info, others do not. 
	$conn = getConn();
	if($_POST['type'] == "buyer") {

		$usrEntry = "INSERT INTO USERS (username, usrType, password, firstName, lastName, email, creditCard, creditType, creditSecurity)
					values('"
					.$_POST['username']."', '"
					.$_POST['type']."', '"
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
					.$_POST['type']."', '"
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
	
	$conn->close();
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
				password,
				newVisitor
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
	// Set up session varaibles. Used at various points.  
	$_SESSION['userId'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['usrType'] = $row['usrType'];
	$_SESSION['newVisitor'] = $row['newVisitor'];
	
	if(isset($_SESSION['userId'])) {
		echo "User found!";
		selectDashboard($_SESSION['usrType']);
	} else {
		echo "User not found!";
	}
	
	$conn->close();
	
}

function selectDashboard($userType) {
	if ($userType == "admin") {
		header("Location: admin.php"); 
	}
	else if ($userType == "seller") {
		header("Location: seller.php"); 
	}
	else {
		header("Location: buyer.php"); 		
	}
}

function addProperty() {
	// Takes info from _POST and adds it to the PROPERTIES table.
	// Called from the addProperty.php page.
	if ($_SESSION["userId"] == NULL) {
		alert("Error no user ID!");
	} else {
		$id = $_SESSION["userId"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$propname = $_POST["propname"];
		$address1 = $_POST["address1"];
		$address2 = $_POST["address2"];
		$city = strtoupper($_POST["city"]); //Cities to Proper Case. 
		$state = strtoupper($_POST["state"]);
		$zip = $_POST["zip"];
		$date = $_POST["date"];
		$size = $_POST["size"];
		$bedrooms = $_POST["bedrooms"];
		$additions = $_POST["additions"];
		$garden = $_POST["garden"];
		$parking = $_POST["parking"];
		$proximity = $_POST["stuffProximity"];
		$road = $_POST["roadProximity"];
		$value = $_POST["value"];


		$conn = getConn();

		$sql = "INSERT INTO
				  PROPERTIES (
					ownerID,
					ownerFName,
					ownerLName,
					title,
					address1,
					address2,
					city,
					state,
					zip,
					dateConstruct,
					sqrFt,
					bedrooms,
					garden,
					parking,
					addons,
					nearby,
					roadProximity,
					value
				  )
				VALUES
				  (
					'$id',
					'$fname',
					'$lname',
					'$propname',
					'$address1',
					'$address2',
					'$city',
					'$state',
					'$zip',
					'$date',
					'$size',
					'$bedrooms',
					'$garden',
					'$parking',
					'$additions',
					'$proximity',
					'$road',
					'$value'
				  );";
		if ($conn->query($sql) === TRUE) {
			echo "New Property added";
		} else {
			echo "Error: New Property failed to be saved";
		}

		$conn->close();
	}
	
}
?>
