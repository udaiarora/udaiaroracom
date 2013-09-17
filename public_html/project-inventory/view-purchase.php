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
		<script type="text/javascript" src="js/view-purchase.js"></script>
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
				Viewing Purchase Orders
			</div>
			<form class="form-inline" method="get" action="view-purchase.php">Filter By Date:
				<input id="date-range" type="text" class="input-large" placeholder="Date Range Select" name="date-range">
				<input id="msg-text" name="msg" style="display:none;"  value="Filtered by date ( <a href='view-purchase.php'>Remove</a> )"/>
				<button type="submit" class="btn">Filter</button>
			</form>


		<table id="view-incoming" class="table">
		    <thead>
		        <tr>
		        	<th class="ptr">S. No.</th>
					<th class="ptr">Received</th>
					<th class="ptr">Purchase Order ID</th>
					<th class="ptr">Supplier</th>
					<th class="ptr">Date</th>
					<th class="ptr">Total Amount</th>
		        </tr>
		    </thead>
		    <tbody>
        
			<?php
			$sdate= date("0000-01-01");
			$edate= date("9999-12-31");
			$sno=1;

			if(isset($_GET['date-range'])){
				$sm= substr($_GET['date-range'],0,2);
				$sd= substr($_GET['date-range'],3,2);
				$sy= substr($_GET['date-range'],6,4);
				$em= substr($_GET['date-range'],13,2);
				$ed= substr($_GET['date-range'],16,2);
				$ey= substr($_GET['date-range'],19,4);

				if(checkdate($sm, $sd, $sy) && checkdate($em, $ed, $ey))
				{
					$sdate= date($sy."-".$sm."-".$sd);
					$edate= date($ey."-".$em."-".$ed);
				}
			}
			

			$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
			$q="SELECT * FROM purchase_orders WHERE date >= '".$sdate."' AND date <= '".$edate."'";
			$result=mysqli_query($connection,$q);
			while($row= mysqli_fetch_array($result))
			{	$oid=$row[0];
				$q2="SELECT SUM(quantity*rate) FROM purchase_orders_detailed WHERE order_id='$oid'";
				$result2=mysqli_query($connection,$q2);
				$row2= mysqli_fetch_array($result2)
			?>
				<tr uid='<?php echo $row[8]?>' tt='<?php echo round(($row[11]=='per'?($row2[0]*(1+($row[7]/100))):($row2[0]+($row[7]))),3)?>' t='<?php echo round($row2[0],3)?>' >
					<td><?php echo $sno++?></td>
					<td><input name="chk" type="checkbox" id="chk<?php echo $oid; ?>" value="<?php echo $oid; ?>" onclick=" event.stopPropagation(); window.location='purchase-status.php?oid='+<?php echo $oid?>+'&chk='+(this.checked?'checked':'')" <?php echo $row[10]?>/></td>
		            <td><?php echo $row[0]?></td>
		            <td><?php echo $row[1]?></td>
		            <td><?php echo date_format(new DateTime($row[2]), 'd/m/Y' )?></td>
		            <td><?php echo round(($row[11]=='per'?($row2[0]*(1+($row[7]/100))):($row2[0]+($row[7]))),3)?></td>
        		</tr>
			<?php
			}
			?>

    </tbody>
</table>

		</div>

	</body>

</html>