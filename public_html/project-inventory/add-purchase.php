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
				Add item(s) to Purchase Order
			</div>
			<div>
				<form id="purchase-form" class="form-horizontal" method="post" action="add-purchase-confirm.php">
					
					<div class="control-group">
					<label class="control-label" for="inputEmail">Invoice to</label>
					<div class="controls">
					<textarea style="height:120px;"type="text" class="span6" placeholder="Invoice to" name="invoice_to" id="invoice_to">
Bharat Dall Oil Industries
8-1305, Humnabad Road, Gulbarga
Email: info@bharatprojects.com
Phone: 08472-255611
VAT TIN: 29670060317
PAN: AABFB4629B</textarea></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Dispatch to</label>
					<div class="controls">
					<textarea style="height:120px;"type="text" class="span6" placeholder="Dispatch to" name="dispatch_to" id="dispatch_to">
Bharat Dall & Oil Industries
8-1305, Humnabad Road, Gulbarga
Email: info@bharatprojects.com</textarea></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Terms of Delivery</label>
					<div class="controls">
					<textarea type="text" class="span6" placeholder="Terms of Delivery" name="tod" id="tod"></textarea></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Mode</label>
					<div class="controls">
					<input type="text" class="span6" placeholder="Mode" name="mode" id="mode" value="Cheque/RTGS"></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Supplier*</label>
					<div class="controls">
					<textarea type="text" class="span6" placeholder="Supplier" name="sup" id="sup" required></textarea></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Notes</label>
					<div class="controls">
					<textarea type="text" class="span6" placeholder="Notes" name="notes" id="notes"></textarea></div></div>
					<div class="control-group">
					<label class="control-label" for="inputEmail">Tax*</label>
					<div class="controls">
					<input type="text" class="span2" placeholder="Tax" name="tax" id="tax" required>
					<select name="taxtype" class="span2">
						<option value="per">%</option>
						<option value="rs">Rs.</option>
					</select>
					<input type="text" class="span2" placeholder="Tax Type" name="taxtype2" id="taxtype2"></div></div>
					<div id="item-added">
						<div class="control-group inline">
						<label class="control-label" for="inputEmail">Item*</label>
						<div class="controls">
						<input class="span3" placeholder="Item" name="item1" id="item1" type="text" required></div></div>
						<div class="control-group inline">
						<label class="control-label" for="inputEmail">Quantity*</label>
						<div class="controls">
						<input class="span2" placeholder="Quantity" name="quant1" id="quant1"  type="number" step="any" min="0" required>&nbsp;&nbsp;&nbsp;<input class="span2" placeholder="Units" name="qunit1" id="qunit1" type="text"></div></div>
						<div class="control-group inline">
						<label class="control-label" for="inputEmail">Rate*</label>
						<div class="controls">
						<input class="span2" placeholder="Rate" name="rate1" id="rate1"  type="number" step="any" min="0" required></div></div>
					</div>
					<div id="button-grp">
						<div class="control-group">
						<div class="controls"><a id="add-more" class="btn btn-large btn-warning">+</a></div></div>
						<div class="control-group">
						<div class="controls"><button class="btn btn-large btn-success" type="submit">Submit</button></div></div>
					</div>
				</form>
			</div>
		</div>

	</body>

</html>