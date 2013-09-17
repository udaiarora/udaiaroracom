<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}

	$item=strtolower($_POST["item"]);
	$po=$_POST["po"];
	$sup=$_POST["sup"];
	$supdel=$_POST["supdel"];
	$inv=$_POST["inv"];
	$quant=$_POST["quant"];
	$date=date("Y-m-d");
	$add_by=$_SESSION['user'];
	$uid=uniqid();
	
	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="INSERT INTO incoming_inventory VALUES ('$item', '$date', '$po', '$sup', '$supdel', '$inv', '$quant', '$add_by', '$uid')";
	$result=mysqli_query($connection,$q);

	if($result)
	{
		header("Location: add-incoming.php?msg=Successfully%20Added%20".$item);
	}
	else
	{
		header("Location: add-incoming.php?err=Unsuccessful");
	}
?>