<!Doctype html>
<html>
    <head>
        
    </head>
    <body>
        <?php
        //Form verification, needs Location, sqr foottage, and value
        $servername = "localhost";
        $username = "bkrokoff1";
        $password = "bkrokoff1";
        $dbname = "bkrokoff1";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
        } 
        ?>
    </body>
</html>
