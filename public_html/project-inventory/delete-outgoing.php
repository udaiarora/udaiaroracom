<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: signin.php");
	}

	
	$uid=$_POST["uid"];

	

	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$q="DELETE FROM outgoing_inventory WHERE uid='$uid'";
	$result=mysqli_query($connection,$q);

	if($result)
	{
		header("Location: view-outgoing.php?msg=Successfully%20deleted%20");
	}
	else
	{
		header("Location: view-outgoing.php?err=Unsuccessful".$q);
	}