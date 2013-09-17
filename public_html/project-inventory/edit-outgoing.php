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

		if($_SESSION['type']=="user")
		{
			header("Location: view-outgoing.php?err=You%20Dont%20Have%20Access%20Rights");
		}

		else
		{
		include 'leftpane.php';
		?>
		<div class="main-content">
			<div class="heading">Edit item from outgoing inventory</div>
		
		
		<?php
		$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to MySQL");
		$q="SELECT * FROM outgoing_inventory WHERE uid='".$_POST['uid']."'";
		$result=mysqli_query($connection,$q);
		$row= mysqli_fetch_array($result);
		?>
			<form id="edit-form" class="form-horizontal" method="post" action="edit-outgoing-confirm.php">
				<div class="control-group">
				<label class="control-label" for="inputEmail">Item Name*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Item Name" name="item" id="item" value="<?php echo $row[0];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Date(YYYY-MM-DD)*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Date" name="date" id="date" value="<?php echo $row[1];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">MRF Number*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="MRF Number" name="mrf" id="mrf" value="<?php echo $row[2];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Purpose*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Purpose" name="pur" id="pur"  value="<?php echo $row[3];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Authorised by*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Authorised by" name="auth" id="auth" value="<?php echo $row[4];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Quantity Used*</label>
				<div class="controls">
				<input class="span6" placeholder="Quantity" name="quant" id="quant"  type="number" step="any" min="0"  value="<?php echo $row[5];?>" required></div></div>
				<div class="control-group hidden">
				<label class="control-label" for="inputEmail">UID*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="UID" name="uid" id="uid"  value="<?php echo $row[7];?>"></div></div>
				<div class="control-group">
				<div class="controls"><button class="btn btn-large btn-success" type="submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-large btn-danger" type="submit" onClick="return confirmOutgoingDelete();">Delete</button></div></div>
			</form>
			</div>
		<?php
		}
		?>
	</body>

</html>