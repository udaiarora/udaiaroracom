<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}

	$item=strtolower($_POST["item"]);
	$date=$_POST["date"];
	$po=$_POST["po"];
	$sup=$_POST["sup"];
	$supdel=$_POST["supdel"];
	$inv=$_POST["inv"];
	$quant=$_POST["quant"];
	$add_by=$_SESSION['user'];
	$uid=$_POST["uid"];

	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="UPDATE incoming_inventory SET item='$item', date='$date', pon='$po', supplier='$sup', supplier_del='$supdel', invoice_no='$inv', quantity='$quant' WHERE uid='$uid'";
	$result=mysqli_query($connection,$q);

	if($result)
	{
		header("Location: view-incoming.php?msg=Successfully%20edited%20".$item);
	}
	else
	{
		header("Location: view-incoming.php?err=Unsuccessful");
	}