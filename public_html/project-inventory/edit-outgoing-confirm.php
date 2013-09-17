<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}

	$item=strtolower($_POST["item"]);
	$date=$_POST["date"];
	$auth=$_POST["auth"];
	$pur=$_POST["pur"];
	$mrf=$_POST["mrf"];
	$quant=$_POST["quant"];
	$add_by=$_SESSION['user'];
	$uid=$_POST["uid"];

	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="UPDATE outgoing_inventory SET item='$item', date='$date', mrf_no='$mrf', purpose='$pur', authorised_by='$auth', quantity_used='$quant' WHERE uid='$uid'";
	$result=mysqli_query($connection,$q);

	if($result)
	{
		header("Location: view-outgoing.php?msg=Successfully%20edited%20".$item);
	}
	else
	{
		header("Location: view-outgoing.php?err=Unsuccessful".$q);
	}