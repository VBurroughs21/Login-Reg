<?php session_start(); ?>

<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login & Registration</title>
		<style type="text/css">
			div {
				border: 1px dashed darkblue;
				display: inline-block;
				margin: 25px 100px;
				text-align: center;
				width: 300px;
				vertical-align: middle;
			}
			input {
				display: block;
				width: 250px;
				margin: 10px auto;
			}
			.error {
				color: red;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id="login">
			<h2>Login</h2>
<?php 		if (isset($_SESSION['errorsLogin'])) {
				foreach ($_SESSION['errorsLogin'] as $error) {
					echo "<p class='error'>". $error. "</p>";
					unset($_SESSION['errorsLogin']); 
				}
			}
?>
			<form method="post" action="process.php">
				<input type="hidden" name="action" value="login">
				Username:<input type="text" name="user_name">
				Password:<input type="password" name="password">
				<input type="submit" name="login" value="Login">
			</form>
		</div>
		<div id="register">
			<h2>Register</h2>
<?php 		if (isset($_SESSION['errors'])) {
				foreach ($_SESSION['errors'] as $error) {
					echo "<p class='error'>". $error. "</p>";
					unset($_SESSION['errors']); 
				}
			}
?>
			<form method="post" action="process.php">
				<input type="hidden" name="action" value="register">
				Name:<input type="text" name="name">
				Username:<input type="text" name="user_name">
				Password:<input type="password" name="password">
				Confirm Password:<input type="password" name="conPassword">
				Email:<input type="text" name="email">
				<input type="submit" name="register" value="Register">
			</form>
		</div>
	</body>
</html>







