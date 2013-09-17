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
			header("Location: view-incoming.php?err=You%20Dont%20Have%20Access%20Rights");
		}

		else
		{
		include 'leftpane.php';
		?>
		<div class="main-content">
			<div class="heading">Edit item from incoming inventory</div>
		
		
		<?php
		$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to MySQL");
		$q="SELECT * FROM incoming_inventory WHERE uid='".$_POST['uid']."'";
		$result=mysqli_query($connection,$q);
		$row= mysqli_fetch_array($result);
		?>
			<form id="edit-form" class="form-horizontal" method="post" action="edit-incoming-confirm.php">
				<div class="control-group">
				<label class="control-label" for="inputEmail">Item Name*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Item Name" name="item" id="item" value="<?php echo $row[0];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Date(YYYY-MM-DD)*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Date" name="date" id="date" value="<?php echo $row[1];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">P.O. Number</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="P.O. Number" name="po" id="po" value="<?php echo $row[2];?>" ></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Supplier*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Supplier" name="sup" id="sup"  value="<?php echo $row[3];?>" required></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Supplier Del Note</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Supplier Del Note" name="supdel" id="supdel" value="<?php echo $row[4];?>" ></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Invoice Number</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="Invoice Number" name="inv" id="inv" value="<?php echo $row[5];?>" ></div></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Quantity*</label>
				<div class="controls">
				<input class="span6" placeholder="Quantity" name="quant" id="quant"  type="number" step="any" min="0"  value="<?php echo $row[6];?>" required></div></div>
				<div class="control-group hidden">
				<label class="control-label" for="inputEmail">UID*</label>
				<div class="controls">
				<input type="text" class="span6" placeholder="UID" name="uid" id="uid"  value="<?php echo $row[8];?>"></div></div>
				<div class="control-group">
				<div class="controls"><button class="btn btn-large btn-success" type="submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-large btn-danger" type="submit" onClick="return confirmIncomingDelete();">Delete</button></div></div>
			</form>
			</div>
		<?php
		}
		?>
	</body>

</html>