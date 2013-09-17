<!DOCTYPE html>
<html>
	<head>
	<title>Inventory Manager</title>
		<script type="text/javascript" src="js/lib/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<link rel="stylesheet/less" type="text/css" href="css/all-styles.less">
		<script type="text/javascript" src="js/lib/less-1.3.3.min.js"></script>
	</head>
	<body>
		<?php
		session_start();
		if(!isset($_SESSION['user']))
		{
			header("Location: signin.php");
		}
		include 'leftpane.php';
		?>
		<div class="main-content">
			<div class="heading">
				Welcome. Get started by chosing an option from below:
			</div>
			<a class="tiles" href="add-incoming.php">Add Incoming Inventory</a>
			<a class="tiles" href="view-incoming.php">View Incoming Inventory</a>	
			<a class="tiles" href="add-outgoing.php">Add Outgoing Inventory</a>	
			<a class="tiles" href="view-outgoing.php">View Outgoing Inventory</a>
			<a class="tiles" href="add-purchase.php">Add Purchase Orders</a>
			<a class="tiles" href="view-purchase.php">View Purchase Orders</a>

		</div>
		

	</body>

</html>