<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}

	$tod=$_POST["tod"];
	$invoice_to=$_POST["invoice_to"];
	$dispatch_to=$_POST["dispatch_to"];
	$mode=$_POST["mode"];
	$sup=$_POST["sup"];
	$notes=$_POST["notes"];
	$taxtype=$_POST["taxtype"];
	$taxtype2=$_POST["taxtype2"];
	$tax=(float) $_POST["tax"];
	$date=date("Y-m-d");
	$uid=uniqid();
	
	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="INSERT INTO purchase_orders (`supplier`, `date`, `tod`, `invoice_to`, `dispatch_to`, `mode`, `tax`, `uid`, `notes`, `taxtype`, `taxtype2`) VALUES ('$sup', '$date', '$tod', '$invoice_to', '$dispatch_to', '$mode', '$tax', '$uid', '$notes', '$taxtype', '$taxtype2')";
	$result=mysqli_query($connection,$q);
	if($result)
	{
		foreach($_POST as $k => $v)
		{
			if(strpos($k, 'item') === 0) {
			$it=strtolower($_POST['item'.str_replace("item", "", $k)]);
			$qt=$_POST['quant'.str_replace("item", "", $k)];
			$rt=$_POST['rate'.str_replace("item", "", $k)];
			$qu=$_POST['qunit'.str_replace("item", "", $k)];
			if(!empty($it))
			{	$qi="SELECT order_id FROM purchase_orders WHERE uid='$uid'";
				$resulti=mysqli_query($connection,$qi);
				$rowi= mysqli_fetch_array($resulti);
			    $q2="INSERT INTO purchase_orders_detailed VALUES ('$rowi[0]', '$it', '$qt', '$rt', '$uid', '$qu')";
				$result2=mysqli_query($connection,$q2);
				if(!$result2)
				{
					$q="DELETE FROM purchase_orders uid='$uid'";
					header("Location: add-purchase.php?err=Unsuccessful");

				}
			}
	    }
		}
		header("Location: add-purchase.php?msg=Successfully%20Added%20".$item.$it);
	}
	else
	{
		header("Location: add-purchase.php?err=Unsuccessful");
	}
?>