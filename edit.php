<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
</head>
<body>
<h3>Top  20 Search</h3>


<?php foreach ($search2 as $user) : ?>
		<form method = "post" action = "index.edit.php">
			
			<input name = "delete" type = "submit"
			id = "delete" value = "<?= $user->searchWord; ?>">
			
			
		</form>
<?php endforeach; ?>
</body>
</html>