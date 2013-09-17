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
			
				<?php
			if (!empty($_GET['msg']))
				{
			?>  <div class="msg-area">
					<i class="icon-info-sign icon-white"></i>
					<div class="inline text-success">
						<?php
						echo $_GET['msg'];
						?>
					</div>
				</div>
			<?php
				}
			?>

							<?php
			if (!empty($_GET['err']))
				{
			?>  <div class="msg-area">
					<i class="icon-info-sign icon-white"></i>
					<div class="inline text-error">
						<?php
						echo $_GET['err'];
						?>
					</div>
				</div>
			<?php
				}
			?>
			
			<div class="heading">
				Add item(s) to the incoming inventory
			</div>
			<div>
				<form class="form-horizontal" method="post" action="add-incoming-confirm.php">
					<div class="control-group">
					<label class="control-label" for="inputEmail">Item Name*</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="Item Name" name="item" id="item" required></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">P.O. Number</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="P.O. Number" name="po" id="po"></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Supplier*</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="Supplier" name="sup" id="sup" required></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Supplier Del Note</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="Supplier Del Note" name="supdel" id="supdel"></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Invoice Number</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="Invoice Number" name="inv" id="inv"></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Quantity*</label>
					<div class="controls">
					<input class="span6" placeholder="Quantity" name="quant" id="quant"  type="number" step="any" min="0" required></div></div>
					<div class="control-group">
					<div class="controls"><button class="btn btn-large btn-success" type="submit">Submit</button></div></div>
				</form>
			</div>
		</div>

	</body>

</html>