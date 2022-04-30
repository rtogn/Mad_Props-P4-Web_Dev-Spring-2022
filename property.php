<!Doctype html>
<html>
    <head>
        <title>Property</title>
    </head>
    <body>
        <ul>
        <?php
            $servername = "localhost";
            $username = "bkrokoff1";
            $password = "bkrokoff1";
            $dbname = "bkrokoff1";
            $conn = new mysqli($servername, $username, $password, $dbname);
        
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM PROPERTIES WHERE id='$_POST["propID"]'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
              while($row = $result->fetch_assoc()) {
               echo "<li><p>" . $row["title"] . "</p><p>" . $row["address1"] . "</p><p>" . $row["value"] . "</p>";
               ?>
               <a href="property.php" class="main"></a>
               <?php
               echo "</li>"
              }
             //  Run a loop and display the records on screen dynamically
             // lets say the above query returned 20 rows
             // Now display the table on screen with 20 records
          
            }
            $conn->close();
        ?>
        </li>
    </body>
</html>