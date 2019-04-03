<?php
require_once("classes/User.class.php");

if(!empty($_POST)){
    $user = new User();
    $user->setFullname($_POST['fullname']);
    $user->setUsername($_POST['username']);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['password']);
	$user->setPasswordConfirmation($_POST['password_confirmation']);
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Eindopdracht</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="" method="post">
        
		<div class="form__field">
			<label for="fullname">Full name</label>
			<input type="text" id="full_name" name="fullname">
		</div>
        <div class="form__field">
			<label for="username">Username</label>
			<input type="text" id="username" name="username">
		</div>
        <div class="form__field">
			<label for="email">Email</label>
			<input type="text" id="email" name="email">
		</div>
		<div class="form__field">
			<label for="password">Password</label>
			<input type="password" id="password" name="password">
		</div>
        <div class="form__field">
		    <label for="password_confirmation">Confirm your password</label>
			<input type="password" id="password_confirmation" name="password_confirmation">
		</div>

		<div class="form__field">
			<input type="submit" value="Registreer">
		</div>
	</form>

</body>
</html>