<?php

	include_once('Admin_Functions.php');

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
					city,
					state,
					zip,
					value
				FROM PROPERTIES 
				WHERE 
					UPPER(city) = UPPER('$search')
					OR UPPER(state) = UPPER('$search')
					OR INSTR(zip, '$regionCode') = 1
				ORDER BY value DESC 
				;"	;
	
					
		displayQueryList($sql);
	}
	

?>