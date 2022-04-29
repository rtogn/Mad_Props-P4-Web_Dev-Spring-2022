<!DOCTYPE html>  
 <!-- DEBUG PAGE USED FOR VIEWING TABLES  -->
<html> 
    <head meta charset="UTF-8"> 
        <title>Index</title>
		<style>
			.infodump {
				font-size:10px;
			}
		</style>
        <link href="./aindex.css" type="text/css" rel="stylesheet"/>
    </head> 
	<body>
		<div class="infodump">
			<?php
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

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
				echo "Connection established<br>";
				$userSqlQ = "SELECT * FROM USERS";
				
				$result = $conn->query($userSqlQ);	
				echo 'Rows in username: ';
				while($row = $result->fetch_assoc()) {
					echo '<br>';
					print_r($row);
					
				}
				echo "<br><br><br>";
				
				$userSqlQ2 = "SELECT * FROM PROPERTIES";
				
				$result2 = $conn->query($userSqlQ2);	
				echo 'Rows in Properties: ';
				while($row2 = $result2->fetch_assoc()) {
					echo '<br>';
					print_r($row2);
					
				}
				
			}
			$conn->close();
			?>
		</div>
	</body>
</html>