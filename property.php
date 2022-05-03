<!Doctype html>
<html>
    <head>
        <title>Property Details</title>
    </head>
    <body>
		<h1>Property Details</h1>
        <?php		
			include_once("SQL_Functions.php");
			
			$propId = -1;
			if(isset($_GET['id'])) {
				$propId = $_GET['id'];
			}
			
			if(isset($_POST['wishlist'])) {
				echo "Added to wishlist!";
				include_once("Buyer_Functions.php");
				updateWishlist($propId);
			}
			
			
			$conn = getConn();
    
            
            $sql = "SELECT * FROM PROPERTIES WHERE id=$propId;";
		
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				//  Run a loop and display the records on screen dynamically
				// lets say the above query returned 20 rows
				// Now display the table on screen with 20 records
					
				$propElements = array();
				while($row = $result->fetch_assoc()) {
					// Set custom display titles for each field in the property table. 
					// Owner and address are made into single fields 
					// Some fields use custom functions sotred in SQL_Functions.php to make the output user readable. 
					$owner = $row['ownerLName'].','. $row['ownerFName'];
					$address = $row['address1'].' '.$row['address2'].' '.$row['city'].', '.$row['state'].' '.$row['zip'];

					$propElements = array(
										'Title' => $row['title'],
										'Listing Price' => moneyFormat($row['value']),
										'Owner' => $owner,
										'Address' => $address,
										'Date Constructed' => $row['dateConstruct'],
										'Square footage' => $row['sqrFt'],
										'Bedrooms' => $row['bedrooms'],
										// Since bit is 1 or 0 SQLBitToYesNo function makes it Yes Or No.
										'Garden Available?' => SQLBitToYesNo($row['garden']), 
										'Parking Available?' => SQLBitToYesNo($row['parking']),
										'Addons' => $row['addons'],
										'Nearby Interests' => $row['nearby'],
										'Road Proximity' => $row['roadProximity']							
										);		
				}
				
				// Display each field with its specified title and DB value.
				// /t and /n are used to make the html code display nicely.
				echo "\t\t<ul>\n";
				foreach($propElements as $header => $value) {
					// Class for each listing is made to be first word of the title plust detail_ to
					// avoid potential conflicts. Titles are written so each ID is clear to its function. 
					$cssID = "details_".explode(" ", $header)[0];
					echo "\t\t\t<li id='".$cssID."'>". $header . ":  ". $value ."</li>\n";
				}				
				echo "\t\t</ul>\n";		
			}
			$conn->close();
		
			if($_SESSION['usrType'] == 'buyer') {
				echo "<form action='' method='post'>\n";
				echo "<input type='submit' name='wishlist' id='wishlist' value='Add To Wishlist'>\n";
				echo "<a href='buyer.php'><input type='button' id='btn2' value='Return To Buyer Dashboard'></a>\n</form>";
			}
			else if ($_SESSION['usrType'] == 'admin') {
					echo "<a href='admin.php'><input type='button' id='btn2' value='Return To Admin Dashboard'></a>\n";	
			}			
			else {
				echo "<a href='seller.php'><input type='button' id='btn2' value='Return To Seller Dashboard'></a>\n";	
			}
		?>
		
    </body>
</html>