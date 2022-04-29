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
      <h2>New Property</h2>
      <p>
        Add Property
      </p>
      <a href="addProperty.php" class="main"></a>
      <button id="new">+</button>
    </li>
  </ul>
</body>
</html>
