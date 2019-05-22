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
  <title>IncludeFood - Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post">
		<h2>Log in to your account</h2>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="form__error">
            <p class="error">
                <?php
                    $error = $_SESSION['error'];
                    echo $error;
                ?>
            </p>
            
        </div>
        <?php endif; ?>
		<div class="signup">
		<input type="text" id="username" name="username" placeholder="username"><br>

		<input type="password" id="password" name="password" placeholder="password"><br>

        <input type="submit" value="Sign me up!" class="btn btn--primary">
	<a href="register.php" class="registerLink">I still need a account!</a>
</div>
	
	</form>
	
</body>
</html>

<?php
    unset($_SESSION['error']);
?>