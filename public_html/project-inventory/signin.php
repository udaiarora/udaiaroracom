<!DOCTYPE html>
<html>
	<head>
	<title>Sign In</title>
		<script type="text/javascript" src="js/lib/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<link rel="stylesheet/less" type="text/css" href="css/all-styles.less">
		<script type="text/javascript" src="js/lib/less-1.3.3.min.js"></script>
	</head>
	<body>
		<div class="container">
			<?php
			if (!empty($_GET['error']))
				{
			?>
				<div class="center text-error">
					<?php
					echo $_GET['error'];
					?>
				</div>
			<?php
				}
			?>
			<form class="form-signin" method="post" action="authenticate.php">
				<h2 class="form-signin-heading">Please sign in</h2>
				<input type="text" class="input-block-level" placeholder="Username" name="username" id="username">
				<input type="password" class="input-block-level" placeholder="Password" name="password" id="password">
				<button class="btn btn-large btn-primary" type="submit">Sign in</button>
			</form>
		    </div>
    	</body>

</html>