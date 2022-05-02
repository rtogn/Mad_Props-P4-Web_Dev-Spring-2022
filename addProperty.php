<!Doctype html>
<?php
	include_once('SQL_Functions.php');
	if(isset($_POST['propname'])) {
		echo addProperty();
	}
?>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>New Property Form</title>
</head>

<body>
	<div>
		<form action="addProperty.php" method="POST">
			<h3>New Property</h3>
			<p>Owner First Name: <input name="fname" type="text" maxlength="35" required></p>
			<p>Owner Last Name: <input name="lname" type="text" maxlength="35" required></p>
			<p>Property Name: <input name="propname" type="text" maxlength="25" required></p>
			<p>Address 1: <input name="address1" type="text" maxlength="30" required></p>
			<p>Address 2: <input name="address2" type="text" maxlength="30"></p>
			<p>City: <input name="city" type="text" maxlength="25" required></p>
			<p>State: <input name="city" type="text" maxlength="2" required></p>
			<p>Zip: <input name="city" type="text" maxlength="5" required></p>
			<p>Construction Date: <input name="date" type="date"></p>
			<p>Square Footage: <input name="size" type="number" max="4294967295" required></p>
			<p>Number of Bedrooms: <input name="bedrooms" type="number" required></p>
			<p>Additional Facilities: <input name="additions" type="text" maxlength="50"></p>
			<p>Garden: <input name="garden" type="checkbox" value="1"></p>
			<p>Parking: <input name="parking" type="checkbox" value="1"></p>
			<p>Stuff in Close Proximity: <input name="stuffProximity" type="text" maxlength="50"></p>
			<p>Road in Close Proximity: <input name="roadProximity" type="text" maxlength="50"></p>
			<p>Value: <input name="value" type="number" step="0.01" min="0" max="999999999999999.9999" required></p>
			<input type="submit" id="btn3" value="Submit">
			<!-- Redirect how would you handle user cancel -->
			<a href="seller.php"><input type="button" id="btn1" value="Cancel"></a>
		</form>
	</div>
</body>

</html>