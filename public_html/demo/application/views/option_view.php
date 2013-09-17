<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>Getting all the users</h2>

	<?php if(isset($records)) : foreach ($records as $row): ?>
	<div><?php echo $row->name ?></div>
	<div><?php echo $row->age ?></div>
	 <?php endforeach; ?>
<?php else: ?>
	No data found 
<?php endif; ?>
	
</body>
</html>