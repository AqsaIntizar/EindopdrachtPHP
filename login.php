<?php
require_once("classes/Db.class.php");

if(!empty($_POST)){
    $conn = Db::getInstance();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $conn->prepare("select * from users where username = :username");
    $statement->bindParam(":username", $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

	if(password_verify($password, $user['password'])){
        setcookie("loggedin", $user['password'], time() +60*60*24*30);
        header('Location: index.php');
	} else{
        $errorLogin = true;
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

        <?php if(isset($errorLogin)): ?>
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