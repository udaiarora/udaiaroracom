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
				Viewing item(s) in the incoming inventory by running total and balance<a href="view-incoming.php">(Click here to view all details)</a>
			</div>
			<form class="form-inline" method="get" action="incoming-running.php">Filter By Date:
				<input id="date-range" type="text" class="input-large" placeholder="Date Range Select" name="date-range">
				<input id="msg-text" name="msg" style="display:none;"  value="Filtered RUNNING TOTAL by date ( <a href='incoming-running.php'>Remove</a> )"/>
				<button type="submit" class="btn">Filter</button>
			</form>


		<table id="view-incoming" class="table">
		    <thead>
		        <tr>
		        	<th class="ptr">S. No.</th>
					<th class="ptr">Item</th>
					<th class="ptr">Running Total</th>
					<th class="ptr">Balance</th>
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
			$q="SELECT DISTINCT item FROM incoming_inventory WHERE date >= '".$sdate."' AND date <= '".$edate."'";
			$result=mysqli_query($connection,$q);
			while($row= mysqli_fetch_array($result))
			{
				$q2="SELECT sum(quantity) FROM incoming_inventory where item='".$row[0]."' AND date >= '".$sdate."' AND date <= '".$edate."'";
				$result2=mysqli_query($connection,$q2);
				$runtotin=mysqli_fetch_array($result2);

				$q3="SELECT sum(quantity_used) FROM outgoing_inventory where item='".$row[0]."' AND date >= '".$sdate."' AND date <= '".$edate."'";
				$result3=mysqli_query($connection,$q3);
				$runtotout=mysqli_fetch_array($result3);
			?>
				<tr>
					<td><?php echo $sno++?></td>
		            <td><?php echo $row[0]?></td>
		            <td><?php echo round($runtotin[0],3)?></td>
		            <td><?php echo round($runtotin[0]-$runtotout[0],3)?></td>
        		</tr>
			<?php
			}
			?>

    </tbody>
</table>

		</div>

	</body>

</html>