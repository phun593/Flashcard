<!DOCTYPE html>
<html>
	<head>
		<title>classes</title>
	</head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<body>
		
		<form  method="post"action="index.php">
			
			
			<input type="text" name="search" required>
			<button  type = "submit">Seach</button>
		
		</form>
			<a href="/index.edit.php">Edit</a>
		<h3>Top Search</h3>
		<?php foreach ($search as $user) : ?>
		<li ><a href=""><?= $user->searchWord; ?></a></li>
		<?php endforeach; ?>
		
	
	</body>
</html>