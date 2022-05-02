<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./home.css">
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="wrapper">
        <div class="left">
            <img src="./images/houseLogo.png" style="width: 80%" alt="houseLogo">
            <h1 class="welcome"> Welcome<br><span class="company">Admin</span></h1>
            <a href="./buyer.php" class="buyerPage">BUYER PAGE</a>
            <a href="./seller.php" class="sellerPage">SELLER PAGE</a>
            <a href="./index.php" class="logOut">LOG OUT</a>
        </div>

        <div class="right">
		<h1 class="aboutUs">Admin Dashboard</h1>

<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);	
	//Code to pull user properties from database
	//If properties are 0, display no filled card
	include_once("Admin_Functions.php");
 ?>	
	<table class='adminTable'>
		<tr>
			<th>Data</th>
			<th>Info</th>
		</tr>
		<tr>
			<td>Total Homes Sold</td>
			<td><?php echo countSold(); ?></td>
		</tr>
		<tr>
			<td>Total Homes On Market</td>
			<td><?php echo countOnMarket(); ?></td>
		</tr>	
		<tr>
			<td>Total Users</td>
			<td><?php echo countUsers(); ?></td>
		</tr>	
		<tr>
			<td>Total Buyers</td>
			<td><?php echo countAccountType("buyer"); ?></td>
		</tr>
		<tr>
			<td>Total Sellers</td>
			<td><?php echo countOnMarket("seller"); ?></td>
		</tr>				
	</table>
	
		
	<div class="homesSold">
		<h3>Most valuable homes sold</h3>
		<?php listTopSold(5, "DESC"); ?>
	</div>
	<div class="homesSold">
		<h3>Least valuable homes sold</h3>
		<?php listTopSold(5, "ASC"); ?>
	</div>
	
	<div class="topSales">
		<h3>Top selling accounts</h3>
		<?php listTopSellers(5, "DESC"); ?>
	</div>
        </div>
      </div>
</body>
</html>

