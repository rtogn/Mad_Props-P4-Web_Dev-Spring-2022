<!DOCTYPE html>
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
