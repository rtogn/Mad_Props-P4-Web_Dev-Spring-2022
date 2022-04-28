
<!DOCTYPE html>  
 
<html> 
    <head meta charset="UTF-8"> 
        <title>Index</title>
        <link href="./aindex.css" type="text/css" rel="stylesheet"/>
    </head> 
	<body>

		<?php
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
		}
		else {
			echo "Connection established\n";
			

			// table for user info
			$userTable = "CREATE TABLE USERS (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				username VARCHAR(20) NOT NULL UNIQUE,
				usrType VARCHAR(6) NOT NULL,
				password VARCHAR(20) NOT NULL,
				firstName VARCHAR(35) NOT NULL,
				lastName VARCHAR(35) NOT NULL,
				email VARCHAR(45),				
				creditCard INT(20),
				creditType VARCHAR(20),
				creditSecurity INT(4)
			)";
			
			/*
			// table for property info 
			$propTable  = "CREATE TABLE USERS (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				ownerID(6) USINGED,
				location
			
			)";
			*/
			
			//$testEntry = "INSERT INTO USERS (username, usrType, password, creditCard, creditType, creditSecurity) values('beeeeeelogus123','buyer','bb123',12345,'visa','123')";
			
			if($conn->query($userTable) === TRUE) {
				echo "User table created!";
			} else {
				"Error with creating table: " . $conn->error;
			}
		}
		echo mysql_get_server_info() . "\n";
		$conn->close();

		?>
	</body>
</html>