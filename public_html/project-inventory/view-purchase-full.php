<!DOCTYPE html>
<html>
	<head>
	<title>Inventory Manager</title>
		<script type="text/javascript" src="js/lib/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/lib/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/lib/date-range.js"></script>
		<script type="text/javascript" src="js/lib/date.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<link rel="stylesheet/less" type="text/css" href="css/all-styles.less">
		<script type="text/javascript" src="js/lib/less-1.3.3.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() 
			    { 
			        $("#view-incoming").tablesorter(); 
			        $("#date-range").daterangepicker();
			    } 
			);
		</script>
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
				Viewing Purchase Order
			</div>


			<?php

			function convert_number_to_words($number) {
    
			    $hyphen      = '-';
			    $conjunction = ' and ';
			    $separator   = ', ';
			    $negative    = 'negative ';
			    $decimal     = ' point ';
			    $dictionary  = array(
			        0                   => 'zero',
			        1                   => 'one',
			        2                   => 'two',
			        3                   => 'three',
			        4                   => 'four',
			        5                   => 'five',
			        6                   => 'six',
			        7                   => 'seven',
			        8                   => 'eight',
			        9                   => 'nine',
			        10                  => 'ten',
			        11                  => 'eleven',
			        12                  => 'twelve',
			        13                  => 'thirteen',
			        14                  => 'fourteen',
			        15                  => 'fifteen',
			        16                  => 'sixteen',
			        17                  => 'seventeen',
			        18                  => 'eighteen',
			        19                  => 'nineteen',
			        20                  => 'twenty',
			        30                  => 'thirty',
			        40                  => 'fourty',
			        50                  => 'fifty',
			        60                  => 'sixty',
			        70                  => 'seventy',
			        80                  => 'eighty',
			        90                  => 'ninety',
			        100                 => 'hundred',
			        1000                => 'thousand',
			        1000000             => 'million',
			        1000000000          => 'billion',
			        1000000000000       => 'trillion',
			        1000000000000000    => 'quadrillion',
			        1000000000000000000 => 'quintillion'
			    );
			    
			    if (!is_numeric($number)) {
			        return false;
			    }
			    
			    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			        // overflow
			        trigger_error(
			            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			            E_USER_WARNING
			        );
			        return false;
			    }

			    if ($number < 0) {
			        return $negative . convert_number_to_words(abs($number));
			    }
			    
			    $string = $fraction = null;
			    
			    if (strpos($number, '.') !== false) {
			        list($number, $fraction) = explode('.', $number);
			    }
			    
			    switch (true) {
			        case $number < 21:
			            $string = $dictionary[$number];
			            break;
			        case $number < 100:
			            $tens   = ((int) ($number / 10)) * 10;
			            $units  = $number % 10;
			            $string = $dictionary[$tens];
			            if ($units) {
			                $string .= $hyphen . $dictionary[$units];
			            }
			            break;
			        case $number < 1000:
			            $hundreds  = $number / 100;
			            $remainder = $number % 100;
			            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			            if ($remainder) {
			                $string .= $conjunction . convert_number_to_words($remainder);
			            }
			            break;
			        default:
			            $baseUnit = pow(1000, floor(log($number, 1000)));
			            $numBaseUnits = (int) ($number / $baseUnit);
			            $remainder = $number % $baseUnit;
			            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			            if ($remainder) {
			                $string .= $remainder < 100 ? $conjunction : $separator;
			                $string .= convert_number_to_words($remainder);
			            }
			            break;
			    }
			    
			    if (null !== $fraction && is_numeric($fraction)) {
			        $string .= $decimal;
			        $words = array();
			        foreach (str_split((string) $fraction) as $number) {
			            $words[] = $dictionary[$number];
			        }
			        $string .= implode(' ', $words);
			    }
			    
			    return $string;
			}




			$sno=1;
			$uid=$_POST['uid'];

			$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
			$q="SELECT * FROM purchase_orders WHERE uid='$uid'";
			$result=mysqli_query($connection,$q);
			$row= mysqli_fetch_array($result);
			?>
			<div class="row-fluid margin-b flarge center">
				<div class="span11 margin-b">Purchase Order</div> 
			</div>
			<div class="row-fluid margin-b">
				<div class="span5"><div class="bold">Invoice to</div><div class="span11"><?php echo nl2br($row[4])?></div></div>
				<div class="span5">
					<div class="row-fluid margin-b">
						<div class="span5"><div class="bold">Order Number</div><div class="span11"><?php echo $row[0]?></div></div>
						<div class="span5"><div class="bold">Date</div><div class="span11"><?php echo date_format(new DateTime($row[2]), 'd/m/Y' )?></div></div>
					</div>
					<div class="row-fluid margin-b">
						<div class="span11"><div class="bold">Mode of Payment</div><div class="span11"><?php echo $row[6]?></div></div>
					</div>
				</div>
			</div>

			<div class="row-fluid margin-b">
				<div class="span5"><div class="bold">Dispatch to</div><div class="span11"><?php echo nl2br($row[5])?></div></div>
				<div class="span5"><div class="bold">Terms of Delivery</div><div class="span11"><?php echo nl2br($row[3])?></div></div>
			</div>

			<div class="row-fluid margin-b">
				<div class="span5"><div class="bold">Supplier</div><div class="span11"><?php echo nl2br($row[1])?></div></div>
			</div>



    	<table id="view-incoming" class="table table-condensed">
		    <thead>
		        <tr>
					<th class="ptr">S no.</th>
					<th class="ptr">Item</th>
					<th class="ptr">Quantity</th>
		        	<th class="ptr">Rate (Rs.)</th>
					<th class="ptr" style="text-align:right;">Amount (Rs.)</th>
		        </tr>
		    </thead>
		    <tbody>
        
			<?php
			$sno=1;
			$uid=$_POST['uid'];
			$tt=$_POST['tt'];
			$t=$_POST['t'];

			$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
			$q="SELECT * FROM purchase_orders_detailed WHERE uid='$uid'";
			$result=mysqli_query($connection,$q);
			while($rowt= mysqli_fetch_array($result))
			{
			?>
			<tr uid=<?php echo $rowt[4]?>>
		            <td><?php echo $sno++;?></td>
		            <td><?php echo $rowt[1]?></td>
		            <td><?php echo $rowt[2]?>&nbsp;<?php echo $rowt[5]?></td>
		            <td><?php echo $rowt[3]?></td>
		            <td style="text-align:right;"><?php echo round($rowt[2]*$rowt[3],3)?></td>
        	</tr>
			
    	   
			<?php
			}
			?>
			</tbody>
	    	</table>

	    	<div class="row-fluid">
	    	<div class="span12">
			<table class="table">
			<tbody>
			<tr>
				<td style="border-top:none;"></td>
				<td style="border-top:none;"></td>
				<td style="border-top:none;"></td>
				<td style="border-top:none;"></td>
				<td class="flarge"  style="text-align:right; border-top:none;">
					<div>
					<form class="form-horizontal pull-right">
						<div class="control-group">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Sub-Total:</label>
						<div class="controls">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Rs. <?php echo round($t,3);?></label></div></div>
						<div class="control-group">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Taxes <?php if(!empty($row[12])) {echo " - "; echo $row[12];} if($row[11]=='per') {echo " ("; echo round($row[7],3); echo "%)";} ?>:</label>
						<div class="controls">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Rs.<?php if($row[11]=='per'){ echo (round($row[7],3)*$t/100); } else echo round($row[7],3);?></label></div></div>
						<div class="control-group">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Grand Total:</label>
						<div class="controls">
						<label class="control-label" for="inputEmail" style="font-size:24px;">Rs. <?php echo round($tt,3);?></label></div></div>
					</form>
					</div>

					<div style="clear:both;">
					<form class="form-horizontal pull-right">
						<div>
						<input class="inv-inp" for="inputEmail" style="font-size:22px;" value="(Rs. <?php echo convert_number_to_words(round($tt,0)); ?> only)"></div>
					</form>
					</div>
				</td>
			</tr>
			
			<tr>
				<td colspan='5' class="flarge"  style=" border-top:none; "><?php if(!empty($row[9])) {?>Notes<br/><span style="font-size:16px; "><?php } echo nl2br($row[9])?><span></td>
			</tr>

    	    </tbody>
	    	</table>
	    	
			</div>
			</div>

		</div>

	</body>

</html>