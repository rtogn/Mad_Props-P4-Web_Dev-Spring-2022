
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller List</title>
  <link rel="stylesheet" href="./card.css">
  <style>
<?php include './card.css'; ?>
</style>
</head>
<body>

  <h1>Properties to Sell</h1>
  <ul class="fullclick">
  <?php
  
		session_start();
		include_once("SQL_Functions.php");
		$conn = getConn();
	   
		$sql = "SELECT 
					id,
					title, 
					address1, 
					value
				FROM PROPERTIES 
				WHERE 
				ownerID = '".$_SESSION['userId']."'
				ORDER BY value DESC
				;";
				
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {

			$counter = 1;
			// output data of each row
			//  Run a loop and display the records on screen dynamically
			// lets say the above query returned 20 rows
			// Now display the table on screen with 20 records 
			while($row = $result->fetch_assoc()) {
				echo "\t\t<div class='card'>\n";
				echoImage($counter);
				echo "\t\t\t<div class='contain'>\n";
				echo "<li><p>" . $row["title"] . "</p><p>" . $row["address1"] . "</p><p>" . moneyFormat($row['value']). "</p>\n";
				echo "<form class=\"main\">\n";
				echo "</form>\n";
				
				echo "<a href=\"property.php?id=".$row['id']."\" class=\"main\"></a>\n";
				
				
				echo "</li>\n";	
				echo "</div></div>";
				$counter++;
				//echo "<button onclick=\"gotoPropPage(".$row['id'].")\">Beep</button>";				
			}
		}

		function echoImage($counter) {
			if($counter == 1) {
				echo "\t\t\t<img src='./images/Houses/house1.jpeg'>\n";
			}
	
			if($counter == 2) {
				echo "\t\t\t<img src='./images/Houses/house2.jpeg'>\n";
			}
	
			if($counter == 3) {
				echo "\t\t\t<img src='./images/Houses/house3.jpeg'>\n";
			}
	
			if($counter == 4) {
				echo "\t\t\t<img src='./images/Houses/house4.jpeg'>\n";
			}
	
			if($counter == 5) {
				echo "\t\t\t<img src='./images/Houses/house5.jpg'>\n";
			}
	
			if($counter == 6) {
				echo "\t\t\t<img src='./images/Houses/house6.jpeg'>\n";
			}
	
			if($counter == 7) {
				echo "\t\t\t<img src='./images/Houses/house7.jpeg'>\n";
			}
	
			if($counter == 8) {
				echo "\t\t\t<img src='./images/Houses/house8.jpeg'>\n";
			}
	
			if($counter == 9) {
				echo "\t\t\t<img src='./images/Houses/house9.jpeg'>\n";
			}
	
			if($counter == 10) {
				echo "\t\t\t<img src='./images/Houses/house10.jpeg'>\n";
			}
	
			if($counter == 11) {
				echo "\t\t\t<img src='./images/Houses/house11.jpeg'>\n";
			}
	
			if($counter == 12) {
				echo "\t\t\t<img src='./images/Houses/house12.jpeg'>\n";
			}
	
			if($counter == 13) {
				echo "\t\t\t<img src='./images/Houses/house13.jpeg'>\n";
			}
	
			if($counter == 14) {
				echo "\t\t\t<img src='./images/Houses/house14.jpeg'>\n";
			}
	
			if($counter == 15) {
				echo "\t\t\t<img src='./images/Houses/house15.jpeg'>\n";
			}
		}


		$conn->close();
    ?>
<div class="card">
	<img src="./images/AddProperty.jpg">
	<div class="contain">
    <li>
      <h2>Add Property</h2>
      <a href="addProperty.php" class="main"></a>
      <button id="new">+</button>
    </li>
  </ul>
	</div>
	</div>
</body>
</html>
