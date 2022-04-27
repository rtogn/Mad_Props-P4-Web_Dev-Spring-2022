<!Doctype html>

<html>

<head lang="en">
	<meta charset="UTF-8">
	<title>New Property Form</title>
</head>

<body>
	<div>
		<form action="addArtToDB.php" method="post">
			<h3>New Property</h3>
			<p>Name: <input name="propname" type="text"></p>
            <p>Location: <input name="propname" type="text"></p>
            <p>Age: <input name="propname" type="text"></p>
            <p>Number of Bedrooms: <input name="propname" type="text"></p>
            <p>Additional Facilities: <input name="propname" type="text"></p>
            <p>Garden: <input name="propname" type="text"></p>
            <p>Parking: <input name="propname" type="text"></p>
            <p>Property tax records: <input name="propname" type="text"></p>
			<input type="submit" id="btn3" value="Submit">
			<!-- Redirect how would you handle user cancel -->
			<a href="seller.html"><input type="button" id="btn1"  value="Cancel"></a>
		</form>
	</div>
</body>

</html>