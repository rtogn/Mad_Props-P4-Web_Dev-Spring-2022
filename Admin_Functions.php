<?php
	include_once('SQL_Functions.php');
	
	function displayQueryList($sql) {
		// This function is maddness
		// I wanted a generic way to print a SQL select query to a HTML table
		// The problem arises when you need to print the headers as fetch_assoc only runs through once without being reset.
		
		$conn = getConn();
		$result = $conn->query($sql);	
		
		//start table
		echo "\n<table class='adminTable'>\n\t<tr id='admin_headerRow'>";
		
		// set up data arrays for headers and actual data
		$titles = array();
		$values = array();
		// Get headers and print as tr row
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$colCount = sizeof($row);
				foreach($row as $header=>$value) {
					array_push($titles, $header);
					array_push($values, $value);
				}
			}	
		

			// Titles ends up with copies of the headers for each 'row' of data
			$titles = array_chunk($titles,$colCount)[0];
			// Convert single dim data array to multi dimensional for each row we need
			$values = array_chunk($values, $colCount);

			// Print out headers once and close the tr
			foreach($titles as $header) {
				echo "\n\t\t<th id='admin_headerCol'>".$header."</th>";
			}
			echo "\n\t<tr>";
			
			// Print out all the data per row. 
			foreach($values as $row) {
				
				echo "\n\t<tr id='admin_dataRow' onclick=\"window.location='property.php?id=".$row[0]."'\">";
				foreach($row as $item) {
					//echo "\n\t<a href=\"property.php?id=".$row[0]."\" class=\"main\">\n";
					echo "\n\t\t<td id='admin_dataRow'>".$item."</td>";
					//echo "\t</a>\n";
				}
				echo "\n\t</tr>";
				
			}
				
			// Close table. 
			echo "\n</table>";
		}
		else {
			echo "None found";
		}
		$conn->close();
	}
			
	function listTopSold($number=5, $order="DESC") {
		// List properties sold for top value
		// Will return number of rows supplied to function in high to low order
		// $order can be DESC or ASC for oder
		
		// Bit of an error check for function use.
		// Not strictly needed since this will be termined buy a two-option switch of some kind. 
		if($number < 1) {
			$number = 1;
		}
		if($number > 25) {
			$number = 25;
		}
		if ($order != "ASC" or $order != "DESC") {
			$order = "DESC";
		} 
		
		$sql = "SELECT
					PROPERTIES.id,
					PROPERTIES.title, 
					PROPERTIES.state, 
					PROPERTIES.value,
					USERS.username
				FROM PROPERTIES 
				LEFT JOIN USERS
				ON USERS.id = PROPERTIES.ownerID
				ORDER BY value $order
				LIMIT $number
				;";
	
		displayQueryList($sql);
	}
	
	
	function listTopSellers($number=5, $order="DESC") {
		// List properties sold for top value
		// Will return number of rows supplied to function in high to low order
		// $order can be DESC or ASC for oder
		
		
		// Bit of an error check for function use.
		// Not strictly needed since this will be termined buy a two-option switch of some kind. 
		if($number < 1) {
			$number = 1;
		}
		if($number > 25) {
			$number = 25;
		}
		if ($order != "ASC" or $order != "DESC") {
			$order = "DESC";
		}
		$sql = "SELECT 
					USERS.username,
					COUNT(*) as total
				FROM PROPERTIES 
				
				LEFT JOIN USERS
				ON USERS.id = PROPERTIES.ownerID
				
				WHERE
				  PROPERTIES.soldFor > 0
				  OR PROPERTIES.soldFor IS NOT NULL
				  
				GROUP BY USERS.username
				ORDER BY total $order
				LIMIT $number
				;";
	
		displayQueryList($sql);

	}
	
	
	function returnCount($query) {
		// Returns count from COUNT sql request
		$conn = getConn();
		$result = $conn->query($query);	
		$count = 0;
		while($row = $result->fetch_assoc()) {
			$count += $row['total'];
			
		}
		
		$conn->close();
		return $count;
	}
	
	function countOnMarket() {
		// Return number of properties still on market.
		$sql = "SELECT
				  COUNT(*) as total
				FROM
				  PROPERTIES
				WHERE
				  soldFor = ' '
				  OR soldFor IS NULL;";
	
		return returnCount($sql);
	}
	
	function countSold() {
		// Return number of properties sold in DB.
		$sql = "SELECT
				  COUNT(*) as total
				FROM
				  PROPERTIES
				WHERE
				  soldFor > 0
				  OR soldFor IS NOT NULL;";
		
		return returnCount($sql);
	}
	
	function countUsers() {
		// Return number of properties sold in DB.
		$sql = "SELECT
				  COUNT(*) as total
				FROM
				  USERS;";
		
		return returnCount($sql);
	}
	
	function countAccountType($type) {
		// Return number of properties sold in DB.
		$sql = "SELECT
				  COUNT(*) as total
				FROM
				  USERS
				 WHERE
					usrType = '$type';";
		
		return returnCount($sql);
	}
	

?>