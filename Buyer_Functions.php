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
	
?>