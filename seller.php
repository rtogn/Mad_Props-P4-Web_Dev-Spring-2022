
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller List</title>
  <link rel="stylesheet" href="./card.css">
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
			// output data of each row
			//  Run a loop and display the records on screen dynamically
			// lets say the above query returned 20 rows
			// Now display the table on screen with 20 records 
			while($row = $result->fetch_assoc()) {
				echo "\t\t<div class='card'>\n";
				echo "\t\t\t<div class='contain'>\n";
				echo "<li><p>" . $row["title"] . "</p><p>" . $row["address1"] . "</p><p>" . moneyFormat($row['value']). "</p>\n";
				echo "<form class=\"main\">\n";
				echo "</form>\n";
				
				echo "<a href=\"property.php?id=".$row['id']."\" class=\"main\"></a>\n";
				
				
				echo "</li>\n";	
				echo "</div></div>";
				//echo "<button onclick=\"gotoPropPage(".$row['id'].")\">Beep</button>";				
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
