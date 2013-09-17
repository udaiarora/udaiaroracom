<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}


	$oid=$_GET["oid"];
	$chk=$_GET['chk'];

	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="UPDATE purchase_orders SET status='$chk' WHERE order_id='$oid'";
	$result=mysqli_query($connection,$q);
	header("Location: view-purchase.php")

?>