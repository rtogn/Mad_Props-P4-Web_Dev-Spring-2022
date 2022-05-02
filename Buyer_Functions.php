<?php
	include('Admin_Functions.php');
	
	function isZip($search) {
		//Takes search query and determines if it is a zip code or city
		return true;
	}
	
	function searchForZip($zip) {
		// Returns sql data for houses matching the given zip
		// Checks for zip codes matching first 3 digits to determine a city region
		// It's a bit more complicated in reality but good enuff for now. 
		
		// Gets first 3 digits of zip.
		$regionCode = substr($zip, 0,3); 
		
		$sql = "SELECT 
					id,
					title, 
					address1, 
					zip,
					value
				FROM PROPERTIES 
				WHERE 
				INSTR(zip, $regionCode) = 1
				ORDER BY value DESC
				;"	;
				
		displayQueryList($sql);
	}
	
	function searchByCity($city) {
		// Returns SQL data for houses within the same city
		
	
	}
	
	function searchProperties($search) {
		// Determines what kind of search to run.
		if (isZip($search)) {
			searchForZip($zip);
		}
		else {
			searchByCity($city);
		}
	}

?>