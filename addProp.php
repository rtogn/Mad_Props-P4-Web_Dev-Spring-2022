<?php
session_start();
?>
<!Doctype html>
<html>
    <head>
        
    </head>
    <body>
        <?php
        if ($_SESSION["id"] == NULL) {
            alert("Error no user ID!");
        } else {
            $id = $_SESSION["id"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $propname = $_POST["propname"];
            $address1 = $_POST["address1"];
            $address2 = $_POST["address2"];
            $city = $_POST["city"];
            $state = $_POST["state"];
            $zip = $_POST["zip"];
            $date = $_POST["date"];
            $size = $_POST["size"];
            $bedrooms = $_POST["bedrooms"];
            $additions = $_POST["additions"];
            $garden = $_POST["garden"];
            $parking = $_POST["parking"];
            $proximity = $_POST["stuffProximity"];
            $road = $_POST["roadProximity"];
            $value = $_POST["value"];


        $servername = "localhost";
        $username = "bkrokoff1";
        $password = "bkrokoff1";
        $dbname = "bkrokoff1";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO PROPERTIES PROPERTIES (
            ownerID,
            ownerFName,
            ownerLName,
            title,
            address1,
            address2,
            city,
            state,
            zip,
            dateConstruct,
            sqrFt,
            bedrooms,
            garden,
            parking,
            addons,
            nearby,
            roadProximity,
            value
        ) VALUES ('$id', '$fname', '$lname', '$propname', '$address1', '$address2', '$city', '$state', '$zip',
        '$date', '$size', '$bedrooms', '$garden', '$parking', '$additions', '$proximity', '$road', '$value')";
        if ($conn->query($sql) === TRUE) {
            echo "New Property added";
        } else {
            echo "Error: New Property failed to be saved";
        }

        $conn->close();
        }
        ?>
        <a href="seller.php"><input type="button" value="OK"></a>
    </body>
</html>
