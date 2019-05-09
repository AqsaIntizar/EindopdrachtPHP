<?php
    require_once 'bootstrap/bootstrap.php';

    if (!empty($_POST)) {
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        if ($user->login()) {
            header('Location: index.php');
        } else {
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>includeFood - Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post">
		<h2>Log in to your account</h2>

        <?php if (isset($errorLogin)): ?>
        <div class="form__error">
            <p>
                Sorry, we can't log you in with that username and password.
            </p>
        </div>
        <?php endif; ?>
				
		<label for="username">Username</label>
		<input type="text" id="username" name="username">

		<label for="password">Password</label>
		<input type="password" id="password" name="password">

		<input type="submit" value="Sign me up!" class="btn btn--primary">
	</form>
</body>
</html>