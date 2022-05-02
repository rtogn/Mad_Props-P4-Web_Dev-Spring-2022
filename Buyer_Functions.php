<?php

	include_once('SQL_Functions.php');

	function searchProperties($search) {
		// Returns sql data for houses matching the given zip
		// Checks for zip codes matching first 3 digits to determine a city region
		// It's a bit more complicated in reality but good enuff for now. 
		
		// Gets first 3 digits of zip.
		$regionCode = "_UNDEFINED_";
		if (strlen($search) >= 5) {
			$regionCode = substr($search, 0,3);
		}
		
		//$search = strtoupper($search);
		$sql = "SELECT 
					id,
					title, 
					address1,
					address2,
					city,
					state,
					zip,
					value
				FROM PROPERTIES 
				WHERE 
					UPPER(city) = UPPER('$search')
					OR UPPER(address1) = UPPER('$search')
					OR UPPER(title) = UPPER('$search')
					OR UPPER(state) = UPPER('$search')
					OR INSTR(zip, '$regionCode') = 1
				ORDER BY value DESC 
				;"	;
	
					
		displayPropCards($sql);
	}
	
   /*
    <a href="addProperty.php" class="">
    <div class="card">
      <img src="./images/AddProperty.jpg">
      <div class="contain">
        <h4>Add Property</h4>
    </div>
    </a>
	*/
	function displayPropCards($sql) {
		// This function is maddness
		// I wanted a generic way to print a SQL select query to a HTML table
		// The problem arises when you need to print the headers as fetch_assoc only runs through once without being reset.
		
		$conn = getConn();
		$result = $conn->query($sql);	
			
		if ($result->num_rows > 0) {
			// output data of each row
			//  Run a loop and display the records on screen dynamically
			// lets say the above query returned 20 rows
			// Now display the table on screen with 20 records 
			while($row = $result->fetch_assoc()) {
				echo "\n\t<a href=\"property.php?id=".$row['id']."\" class=\"main\">\n";
				echo "\t\t<div class='card'>\n";
					echo "\t\t\t<img src='./images/AddProperty.jpg'>\n";;
					echo "\t\t\t<div class='contain'>\n";
						echo "\t\t\t<ul>\n";
							echo "\t\t\t\t<li>". $row["title"] . "</li>\n";
							echo "\t\t\t\t<li>". $row["address1"] . " " 
												. $row["address2"]. " " 
												. $row["city"] . ", " 
												. $row["state"] . " "
												. $row["zip"] 
												. "</li>\n";
							echo "\t\t\t\t<li>". $row["value"] . "</li>\n";
						echo "\t\t\t</ul>\n";
					echo "\t\t</div>\n";
				echo "\t\t</div>\n";
				echo "\t</a>\n";				
			}
		} else {
			echo "None found";
		}
		$conn->close();
	}
	
	function setVisitorStatus() {
		// Sets new visitor status to 1 if they havent visited. 
		$usrId = $_SESSION['userId'];
		$conn = getConn();
		$sql = "UPDATE USERS
				SET
					newVisitor = 1
				WHERE
					id = '$usrId'
				;";
				
		echo $sql;
		if (!$conn->query($sql) === TRUE) {
			echo "Error: Failed to update database";
		}
		$conn->close();
	}
	
	function updateWishlist($propId) {
		$usrId = $_SESSION['userId'];
		$conn = getConn();
		$sql = "UPDATE USERS
				SET
					wishList = concat(wishList, ';$propId')
				WHERE
					id = '$usrId'
					AND INSTR(wishList, ';$propId') = 0
				;";
		echo $sql;	
		if ($conn->query($sql) === TRUE) {
			"Success";
		} else {
			echo "Error: Failed to update database";
		}
		$conn->close();
	}
	
	function getWishList() {
		$userId = $_SESSION['userId'];
		$conn = getConn();
		$sql = "SELECT
					wishList
				FROM 
					USERS
				WHERE
					id = '$userId'
				;";

		// Get the Q results
		$result = $conn->query($sql);
		// Get row into a parsable format. Due to the way the table is designed there will only be one row
		// This is because username is set to unique. 
		$row = $result->fetch_array();
		$wishValues = explode(";", $row['wishList']);
		
		//$wishValues = $row['wishList'];
		
		$conn->close();
		return $wishValues;
	}

	function displayWishList($wishList) {
		include_once('Admin_Functions.php');
		if (sizeof($wishList) > 0) {

							//start table
			
			echo "\n<table class='adminTable'>\n\t<tr id='admin_headerRow'>";	
			echo "<tr><th colspan='8'>Your wish list: <th></tr>";
			foreach($wishList as $location){
				$sql = "SELECT
							id,
							title, 
							address1,
							address2,
							city,
							state,
							zip,
							value
						FROM 
							PROPERTIES
						WHERE
							id = $location
						;";
				if ($location > 0) {		

					displayQueryList2($sql); 
					
				}
			}
			echo "\n</table>";
		}
	}
	
	function displayQueryList2($sql) {
		// This function is maddness
		// I wanted a generic way to print a SQL select query to a HTML table
		// The problem arises when you need to print the headers as fetch_assoc only runs through once without being reset.
		
		$conn = getConn();
		$result = $conn->query($sql);	
		
		
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
			
			/*
			//Print out headers once and close the tr
			foreach($titles as $header) {
				echo "\n\t\t<th id='admin_headerCol'>".$header."</th>";
			}
			echo "\n\t<tr>";
			*/
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
			
		}
		else {
			echo "None found";
		}
		$conn->close();
	}	
?>