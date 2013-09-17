<?php
	session_start();
	echo "Redirecting...";
	$connection=mysqli_connect("127.0.0.1","root","","inventory_manager") or die("Failed to connect to the server");
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$user=stripslashes($user);
	$pass=stripslashes($pass);
	$user=mysql_real_escape_string($user);
	$pass=mysql_real_escape_string($pass);

	$q="SELECT type FROM users where username='$user' AND password='$pass'";
	$result=mysqli_query($connection,$q);

	$count=mysqli_num_rows($result);
	$typearr=mysqli_fetch_array($result);
	if($count==1)
	{
		$_SESSION['user']=$user;
		$_SESSION['pass']=$pass;
		$_SESSION['type']=$typearr[0];
		header('Location: index.php');
	}
	else
	{	
		header('Location: signin.php?error=Invalid%20Username%20or%20Password');
	}
?>