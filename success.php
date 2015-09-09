<?php session_start(); ?>

<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login & Registration</title>
		<style type="text/css">
		</style>
	</head>
	<body>
		<h2>Welcome <?php echo $_SESSION['name']; ?></h2>
		<form method="post" action="process.php">
			<input type="hidden" name="action" value="logout">
			<input type="submit"value="Logout">
		</form>
	</body>
</html>