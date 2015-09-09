<?php session_start(); 
require_once 'connection.php';

$errors = array();
$errorsLogin = array();

if (isset($_POST['action']) && $_POST['action'] == 'login') {
	if (isset($_POST['user_name'], $_POST['password']) && $_POST['user_name']!= null && $_POST['password'] != null) {
		
		$query = "SELECT * FROM users
					WHERE username = '{$_POST['user_name']}' AND password = '{$_POST['password']}';";
		$checkUser = fetch($query);
		
		if (count($checkUser) == 1) {
			$_SESSION['user_name'] = $_POST['user_name'];
			$_SESSION['password'] = $_POST['password'];

			$query3 = "SELECT name FROM users 
				WHERE username = '{$_POST['user_name']}';";
			$getName = mysqli_fetch_assoc(mysqli_query($connection, $query3));
			$_SESSION['name'] = $getName['name'];
		} else {
			$errorsLogin[] = "Incorrect login";
		}
	} else {
		$errorsLogin[] = "Enter Username and Password";
	}

	
}

if (!empty($errorsLogin)) {
	$_SESSION['errorsLogin'] = $errorsLogin;
	header('Location: index.php');
} else {
	header('Location: success.php');
}



if (isset($_POST['action']) && $_POST['action'] == 'register') {
	if (isset($_POST['name']) && $_POST['name'] != null ) {
		$_SESSION['name'] = $_POST['name'];
	} else {
		$errors[] = "Enter valid name";
	}

	if (isset($_POST['user_name']) && $_POST['user_name'] != null) {
		$query = "SELECT * FROM users
					WHERE username = '{$_POST['user_name']}';";
		$checkUser = fetch($query);
		
		if (count($checkUser) == 0) {
			$_SESSION['user_name'] = $_POST['user_name'];
		} else {
			$errors[] = "Username taken";
		}
	} else {
		$errors[] = "Enter Username";
	}

	if (isset($_POST['password']) && $_POST['password'] != null) {
		$_SESSION['password'] = $_POST['password'];
	} else {
		$errors[] = "Enter valid password";
	}

	if (isset($_POST['conPassword']) && $_POST['conPassword']!= null) {
		if ($_POST['conPassword'] === $_POST['password']) {
			$_SESSION['conPassword'] = $_POST['conPassword'];
		} else {
			$errors[] = "Passwords do not match";
		}
	} else {
		$errors[] = "Confirm password";
	}

	if (isset($_POST['email']) && $_POST['email']!= null) {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Enter valid email address";
		} else {
			$_SESSION['email'] = $_POST['email'];
		}
	} else {
		$errors[] = "Enter email address";
	}

	if (!empty($errors)) {
		$_SESSION['errors'] = $errors;
		header('Location: index.php');
	} else {
		$query = "INSERT INTO users(name, username, password, email, created_at, updated_at)
					VALUES('{$_SESSION['name']}', '{$_SESSION['user_name']}', '{$_SESSION['password']}', '{$_SESSION['email']}', NOW(), NOW())";
		$registerUser = run_mysql_query($query);
		header('Location: success.php');
	}

}



if (isset($_POST['action']) && $_POST['action'] == 'logout') {
	unset($_SESSION);
	session_destroy();
	session_write_close();
	header('Location: index.php');
	die;
}

	



die();

?>