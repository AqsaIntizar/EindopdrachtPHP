<?php
//require_once("classes/User.class.php");
require_once("bootstrap.php");

if(!empty($_POST)){
	$user = new User();
	$user->setEmail($_POST['email']);
	$user->setFirstname($_POST['firstname']);
	$user->setLastname($_POST['lastname']);
	$user->setUsername($_POST['username']);
	$user->setPassword($_POST['password']);
	$user->setPasswordConfirmation($_POST['password_confirmation']);

	if($user->register()){
		session_start();
		$_SESSION['User'] = true;
		$_SESSION['UserName'] = $user->getUsername();
		header('Location: index.php');
	}
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>includeFood - Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post">
		<h2>Sign up for an account</h2>
				
		<label for="firstanme">Firstname</label>
		<input type="text" id="firstname" name="firstname">
			
		<label for="lastname">Lastname</label>
		<input type="text" id="lastname" name="lastname">

		<label for="username">Username</label>
		<input type="text" id="username" name="username">

		<label for="email">Email</label>
		<input type="text" id="email" name="email">

		<label for="password">Password</label>
		<input type="password" id="password" name="password">

		<label for="password_confirmation">Confirm your password</label>
		<input type="password" id="password_confirmation" name="password_confirmation">

		<input type="submit" value="Sign me up!" class="btn btn--primary">
	</form>
</body>
</html>
