<!DOCTYPE html>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	//start session
	session_start();
	
	include_once('Buyer_Functions.php');
 ?>
 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buyer List</title>
  <link rel="stylesheet" href="card.css">
</head>
<body>

  <h1>Properties to Buy</h1>
  <ul class="fullclick">
    <li>
    <?php
    //Code to pull user properties from database
    //If properties are 0, display no filled cards
    ?>
	
	
	
	<div class="searchBar">
		<form action="" method="post">
			<input name="search" type="text" placeholder="Type a zip code or city here">
			<input class="searchButton" type="submit" value="SUBMIT">
		</form>
	</div>
    
	<?php
		if (isset($_POST["search"]) && strlen($_POST["search"]) > 0) {
			searchProperties($_POST["search"]);
		}
		
	?>
	
	
	<br>
    <a href="addProperty.php" class="">
    <div class="card">
      <img src="./images/AddProperty.jpg">
      <div class="contain">
        <h4>Add Property</h4>
    </div>
    </a>
  </ul>
</body>
</html>
